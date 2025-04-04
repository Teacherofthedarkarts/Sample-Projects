<?php
$conn = new mysqli("localhost", "root", "", "parking_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $license_plate = $_POST['license_plate'];
    $entry_time = date("Y-m-d H:i:s");

    // Find a random available floor
    $query = "SELECT floor_id FROM floor WHERE floor_num > 1 and available_spaces > 0 ORDER BY RAND() LIMIT 1";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $floor_id = $row['floor_id'];

        // Find an available parking slot on that floor
        $query = "SELECT slot_id FROM parkingslot WHERE floor_id = $floor_id AND is_occupied = 'available' LIMIT 1";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $slot_id = $row['slot_id'];

            // Insert vehicle entry record
            $query = "INSERT INTO vehicle (license_plate, floor_id, slot_id) VALUES ('$license_plate', $floor_id, $slot_id)";
            $result = $conn->query($query);
            if ($result) {
                $str = "Select vehicle_id FROM vehicle WHERE license_plate = '$license_plate'";
                $query = $str;
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                $vehicle_id = $row['vehicle_id'];

                // Issue Parking Slip
                $query = "INSERT INTO parkingslip (vehicle_id, entry_time, status, floor_id, slot_id) VALUES ($vehicle_id, '$entry_time', 'active', $floor_id, $slot_id)";
                $conn->query($query);

                // Update Parking Slot status
                $query = "UPDATE parkingslot SET is_occupied = 'occupied' WHERE slot_id = $slot_id";
                $conn->query($query);

                // Update available spaces on the floor
                $query = "UPDATE floor SET available_spaces = available_spaces - 1 WHERE floor_id = $floor_id";
                $conn->query($query);

                echo "<script>alert('Vehicle parked successfully. Parking Slip Issued.'); window.location.href='http://localhost/csc680/parking_system/checkin_vehicle.php';</script>";
            } else {
                echo json_encode(["success" => false, "message" => "Invalid parking slip ID or already checked out."]);
            }
        } else {
            echo "<p>No available parking slots.</p>";
        }
    } else {
        echo "<p>Parking lot is full.</p>";
    }
}

$conn->close();
?>