<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<header class="header">
    <div>
        <h1>ACME Parking</h1>
    </div>
</header>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main>
        <h2>Welcome to ACME Parking</h2>
        <p>Your parking solution at your fingertips.</p>
        <a href="login.php" class="btn">Login</a>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>