<?php
session_start();

$conn = new mysqli("localhost", "root", "", "parking_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set("America/Los_Angeles"); // Ensure correct timezone

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $license_plate = $_POST['license_plate'];
    $entry_time = date("Y-m-d H:i:s"); // Fixed time format

    // Fetch vehicle details
    $query = "SELECT * FROM vehicle WHERE license_plate = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $license_plate);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo json_encode(["success" => false, "message" => "Vehicle not found."]);
        exit;
    }

    $row = $result->fetch_assoc();
    $vehicle_id = $row['vehicle_id'];
    $slot_id = $row['slot_id'];
    $floor_id = $row['floor_id'];

    // Fetch parking slip details
    $query = "SELECT * FROM parkingslip WHERE slot_id = ? AND status = 'ACTIVE'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $slot_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $slip = $result->fetch_assoc();
        $entry_time = new DateTime($slip['entry_time']);
        $exit_time = new DateTime(); // Current time
        $exit_time_formatted = $exit_time->format("Y-m-d H:i:s"); // Convert to string format

        // Calculate duration and total fee
        $duration = $entry_time->diff($exit_time)->h; // Hours only
        $rate_per_hour = 1.00; // Parking rate per hour
        $total_fee = $duration * $rate_per_hour;

        // Update parking slip status and exit time
        $update_slip = "UPDATE parkingslip SET status = 'completed', exit_time = ?, total_fee = ? WHERE slip_id = ?";
        $stmt = $conn->prepare($update_slip);
        $stmt->bind_param("sdi", $exit_time_formatted, $total_fee, $slip['slip_id']);
        $stmt->execute();

        // Mark the parking slot as available
        $update_slot = "UPDATE parkingslot SET status = 'available' WHERE slot_id = ?";
        $stmt = $conn->prepare($update_slot);
        $stmt->bind_param("i", $slot_id);
        $stmt->execute();
        // Update available spaces on the floor
        $query = "UPDATE floor SET available_spaces = available_spaces +1 WHERE floor_id = $floor_id";
        $conn->query($query);


        echo "<script>
            alert('Checkout successful');             
            window.location.href='http://localhost/csc680/parking_system/checkout_vehicle.php';</script>";
        exit;
    } else {
        echo "<script>
            alert('Invalid parking slip ID or already checked out.');
            window.location.href = window.location.href='http://localhost/csc680/parking_system/checkout_vehicle.php';</script>";
        exit;
        // echo "<script> alert('Invalid parking slip ID or already checked out.'); window.location.href = 'C:\xampp\htdocs\CSC680\parking_system\checkout_vehicle.php'; </script>";
    }
} else {

    echo "<script>
        alert(Invalid request method.);
            window.location.href = window.location.href='http://localhost/csc680/parking_system/checkout_vehicle.php';</script>";
    exit;
}
?>