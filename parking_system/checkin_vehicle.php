<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Vehicle Check-In - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'includes/config.php';
    include 'includes/header.php';
    include 'includes/nav.php';
    ?>

    <main>
        <h2>Check-In Vehicle</h2>
        <form method="POST" action="includes/process_entry.php">
            <label>Enter Vehicle License Plate:</label>
            <input type="text" name="license_plate" required>
            <button type="submit">🚗 Register</button>
        </form>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>