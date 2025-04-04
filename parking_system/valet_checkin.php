<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valet Vehicle Check-In Portal - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'includes/config.php';
    include 'includes/header.php';
    include 'includes/nav.php';
    ?>

    <main>
        <h2>Valet Check-In</h2>
        <form method="POST" action="includes/valet_process_checkin.php">
            <label>Car Wash?
                <input type="radio" name="needs_wash" value="1">Yes
                <input type="radio" name="needs_wash" value="0" checked>No
            </label>

            <label>Enter Vehicle License Plate:</label>
            <input type="text" name="license_plate" required>
            <button type="submit">🚗 Register Entry</button>
        </form>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>