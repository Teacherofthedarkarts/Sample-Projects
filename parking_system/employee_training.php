<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Training - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php
include 'includes/config.php';
include 'includes/header.php';
include 'includes/nav.php';
?>

<body>
    <main>
        <h1>Welcome to the Training Portal</h1>
        <p>Below are instructional videos on how to perform key use cases.</p>

        <ul>
            <h2>Create a New User/Operator</h2>
            <video controls width="600">
                <source src="create_user.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <h4>Purpose: Create a new user/operator
                tasks.</h4>
            <p>Key Features:
                Register new user.
                Input fields username, password, and employee pin.
                Validate inputs before inserting into the database. Make sure all fileds are filled. Provide a
                confirmation message after a success.
            </p>
            <br>
            <h2>Update the Details of a User/Operator</h2>
            <video controls width="600">
                <source src="update_user.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <h4>Purpose: Modify user/operator information such as name, role, contact details, and assigned parking
                tasks.</h4>
            <p>Key Features:
                Search and select an existing user.
                Edit fields like username, email, phone number, and role.
                Validate changes before updating the database. Provide a confirmation message after a successful update.
            </p>
            <br>
            <h2>Delete a user/operator</h2>
            <video controls width="600">
                <source src="delete_user.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <h4>Purpose: Remove an operator from the system when they are no longer needed.</h4>
            <p>Key Features:
                Display a list of active users/operators.
                Allow search functionality for quick selection.
                Confirm deletion to prevent accidental removal.
                Update the database and log deletion activity.

            </p>
            <br>
            <h2>Check in Incoming Vehicle</h2>
            <video controls width="600">
                <source src="checkin_vehicle.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <h4>Purpose: Register a vehicle's arrival and assign a parking slot.
                tasks.</h4>
            <p>Key Features:
                Capture vehicle details (license plate, driver info, vehicle type).
                Automatically assign an available parking slot.
                Store check-in time for billing calculation.
                Print or display a parking slip for confirmation.

            </p>
            <br>
            <h2>Check-out Leaving Vehicle</h2>
            <video controls width="600">
                <source src="checkout_vehicle.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <h4>Purpose: Process vehicle exit and calculate parking fees.</h4>
            <p>Key Features:
                Retrieve vehicle entry records using the license plate or slip ID.
                Calculate total parking duration and fees.
                Apply additional charges if applicable (e.g., late fees, car wash).
                Update the parking slot status to "Available."
                Generate a receipt for the customer.
            </p>
            <br>
            <h2>Navigate Side Menu Page</h2>
            <video controls width="600">
                <source src="nav_menu.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <h4>Purpose: Serve as the main control hub for managing the parking system.</h4>
            <p>Key Features:
                Provide links to all major system functionalities (user management, check-in/out, reports, etc.).
                Display system status, including available slots and active users.
                Offer quick navigation for efficiency.
            </p>
            <br>
        </ul>

    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>