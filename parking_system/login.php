<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="header">
        <div>
            <h1>ACME Parking</h1>
        </div>
    </header>
    <!-- Main Content -->
    <main>
        <h2>Login</h2>
        <!-- Display error message if exists -->
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <!-- Login Form -->
        <form action="includes/authenticate.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <br>
        <br>
        <br>
        <a href="register_new_employee.php" class="btn">New Empolyee Registion</a>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>