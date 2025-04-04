<?php
session_start();
include 'config.php'; // Ensure this file connects to your MySQL database
// Gets user inputs
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $wash_completed = isset($_POST['wash_completed']) ? (int) $_POST['wash_completed'] : 0;
  $license_plate = $_POST['license_plate'];

  // Sets time zone
  date_default_timezone_set("America/Los_Angeles");

  // Formats datetime(timezone year-month-day hour:minute:second) 
  $entry_time = date("Y-m-d H:i:s");

  // Fetch vehicle details from database
  $query = "SELECT * FROM vehicle WHERE license_plate = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $license_plate);
  $stmt->execute();
  $result = $stmt->get_result();

  // Checks SQL result
  if ($result->num_rows == 0) {
    echo "<script>
                alert('Vehicle not found');
                window.location.href='http://localhost/csc680/parking_system/valet_checkout.php'
              </script>";
  }

  // Stores SQL query into variables 
  $row = $result->fetch_assoc();
  $vehicle_id = $row['vehicle_id'];
  $slot_id = $row['slot_id'];
  $floor_id = $row['floor_id'];

  // Processes valet check out
  if ($result->num_rows == 1) {
    $slip = $result->fetch_assoc();
    $entry_time = new DateTime($slip['entry_time']);
    $exit_time = new DateTime("now", new DateTimeZone("America/Los_Angeles")); // Ensure proper timezone
    $duration = $entry_time->diff($exit_time)->h; // Get hours only
    $rate_per_hour = 1.00; // Parking Lot Rate per hour
    $total_fee = ($duration * $rate_per_hour) + ($wash_completed ? 30.00 : 0.00); // Include wash fee
    $formatted_exit_time = $exit_time->format("Y-m-d H:i:s");

    // Update parking slip status and exit time
    $update_slip = "UPDATE parkingslip SET status = 'completed', exit_time = ?, total_fee = ? WHERE id = ?";
    $stmt = $conn->prepare($update_slip);
    $stmt->bind_param("sdi", $formatted_exit_time, $total_fee, $slip_id);
    $stmt->execute();

    // Mark the parking slot as available
    $update_slot = "UPDATE parkingslot SET is_occupied = 0 WHERE slot_id = ?";
    $stmt = $conn->prepare($update_slot);
    $stmt->bind_param("i", $slip['slot_id']);
    $stmt->execute();

    // Update available spaces on the floor
    $query = "UPDATE floor SET available_spaces = available_spaces - 1 WHERE floor_id = $floor_id";
    $conn->query($query);
    //Successful checkout
    echo "<script>
                alert('Checkout successful. Total Fee: $$total_fee');
                window.location.href='http://localhost/csc680/parking_system/valet_checkout.php'
              </script>";
  } else {
    echo "<script>
                alert('Invalid parking slip ID or already checked out.');
                window.location.href='http://localhost/csc680/parking_system/valet_checkout.php'
              </script>";
  }
} else {
  echo "<script>
            alert('Something important did not work!');
            window.location.href = 'http://localhost/csc680/parking_system/valet_checkout.php';
          </script>";
}
?>