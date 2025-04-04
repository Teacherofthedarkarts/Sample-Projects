<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valet Vechicle Check-out - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'includes/config.php';
    include 'includes/header.php';
    include 'includes/nav.php';
    ?>

    <main>
        <h2>Valet Check-out</h2>
        <form method="POST" action="includes/valet_process_checkout.php">
            <label>Enter Vehicle License Plate:</label>
            <input type="text" name="license_plate" required>

            <label>Car Wash Completed?
                <input type="radio" name="wash_completed" value="1">Yes
                <input type="radio" name="wash_completed" value="0" checked>No
            </label>

            <button type="submit">🚘 Checkout Vehicle</button>
        </form>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>