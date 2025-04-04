<div class="sidebar">
    <h2 style="color: white;">Menu</h2>
    <ul class="ul">
        <?php if ($_SESSION['role'] == 'admin') { ?>
            <title>Admin</title>
            <li><a href="http://localhost/csc680/parking_system/manage_users.php" class="btn">📌 Manage Users</a></li>
            <title>Operator</title>
            <li><a href="http://localhost/csc680/parking_system/dashboard.php" class="btn">🏠Dashboard</a></li>
            <li><a href="view_parking.php" class="btn">📊 View Parkinglot metrics</a></li>
            <li><a href="Checkin_vehicle.php" class="btn">🚗 Checkin Vehicles</a></li>
            <li><a href="checkout_vehicle.php" class="btn">🚘 Checkout Vehicle</a></li>
            <title>Valet</title>
            <li><a href="http://localhost/csc680/parking_system/valet_checkin.php" class="btn">📌 Valet Check In</a></li>
            <li><a href="http://localhost/csc680/parking_system/valet_checkout.php" class="btn">📌 Valet Check Out</a></li>
            <br>
            <li><a href="http://localhost/csc680/parking_system/employee_training.php" class="btn">Training Videos</a></li>
            <li><a href="http://localhost/csc680/parking_system/includes/logout.php" class="btn">🚪 Logout</a></li>
        <?php } ?>
        <?php if ($_SESSION['role'] == 'operator') { ?>
            <li><a href="http://localhost/csc680/parking_system/dashboard.php" class="btn">🏠Dashboard</a></li>
            <li><a href="view_parking.php" class="btn">📊 View Parkinglot metrics</a></li>
            <li><a href="checkin_vehicle.php" class="btn">🚗 Checkin Vehicles</a></li>
            <li><a href="checkout_vehicle.php" class="btn">🚘 Checkout Vehicle</a></li>
            <li><a href="http://localhost/csc680/parking_system/employee_training.php" class="btn">Training Videos</a></li>
            <br>
            <li><a href="http://localhost/csc680/parking_system/includes/logout.php" class="btn">🚪 Logout</a></li>
        <?php } ?>
    </ul>
    <ul class="ul">
        <?php if ($_SESSION['role'] == 'valet') { ?>
            <li><a href="http://localhost/csc680/parking_system/dashboard.php" class="btn">🏠Dashboard</a></li>
            <li><a href="http://localhost/csc680/parking_system/valet_checkin.php" class="btn">📌 Valet Check In</a></li>
            <li><a href="http://localhost/csc680/parking_system/valet_checkout.php" class="btn">📌 Valet Check Out</a></li>
            <li><a href="http://localhost/csc680/parking_system/employee_training.php" class="btn">Training Videos</a></li>
            <br>
            <li><a href="http://localhost/csc680/parking_system/includes/logout.php" class="btn">🚪 Logout</a></li>
        <?php } ?>
</div>