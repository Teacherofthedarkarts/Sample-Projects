<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $license_plate = $_POST['license_plate'];
    $needs_wash = isset($_POST['needs_wash']) ? 'Yes' : 'NO';
    $entry_time = date("Y-m-d H:i:s");
    $hour = (int) date("H");

    // Check if valet level has available spaces
    $query = "SELECT floor_id, available_spaces FROM floor WHERE floor_num = 1 AND available_spaces > 0 LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $floor_id = $row['floor_id'];

        // Find an available parking slot on the valet floor
        $query = "SELECT slot_id FROM parkingslot WHERE floor_id = $floor_id AND is_occupied = 'available' LIMIT 1";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $slot_id = $row['slot_id'];

            // Insert vehicle entry record
            $query = "INSERT INTO vehicle (license_plate, floor_id, slot_id) VALUES ('$license_plate', $floor_id, $slot_id)";
            if ($conn->query($query)) {
                $vehicle_id = $conn->insert_id;

                // Check if car wash is allowed
                $car_wash_fee = 'No';
                if ($needs_wash && ($hour >= 8 && $hour <= 16)) {
                    $car_wash_fee = 'yes';
                } else if ($needs_wash) {
                    echo "<script>
                alert('Car wash is only available between 8 AM and 4 PM.');             
                window.location.href='http://localhost/csc680/parking_system/valet_checkin.php';
                </script>";
                } else {

                    // Issue Parking Slip
                    $query = "INSERT INTO parkingslip (vehicle_id, entry_time, status, floor_id, slot_id, car_wash_fee) 
                                VALUES ($vehicle_id, '$entry_time', 'active', $floor_id, $slot_id, '$car_wash_fee');";
                    $conn->query($query);

                    // Update Parking Slot status
                    $query = "UPDATE parkingslot SET is_occupied = 'occupied' WHERE slot_id = $slot_id";
                    $conn->query($query);

                    // Update available spaces on the floor
                    $query = "UPDATE floor SET available_spaces = available_spaces - 1 WHERE floor_id = $floor_id";
                    $conn->query($query);

                    echo "<script>
                        alert('Check in successful');             
                        window.location.href='http://localhost/csc680/parking_system/valet_checkin.php';
                        </script>";
                }
            } else {
                echo "<script>
                        alert('Error issuing parking slip.');             
                        window.location.href='http://localhost/csc680/parking_system/valet_checkin.php';
                        </script>";
            }
        } else {
            echo "<script>
                    alert('No available parking slots on valet floor.');             
                    window.location.href='http://localhost/csc680/parking_system/valet_checkin.php';</script>";
        }
    } else {

        echo "<script>
                    alert('Valet parking is full.');             
                    window.location.href='http://localhost/csc680/parking_system/valet_checkin.php';</script>";
    }
}

$conn->close();
?>