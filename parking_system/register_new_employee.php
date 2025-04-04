<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Employee - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <div>
            <h1>ACME Parking</h1>
        </div>
    </header>
    <main>
        <h2>New Employee Registration</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <form action="includes/register_employee.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <label for="employee_pin">Employee Pin</label>
            <input type="text" id="employee_pin" name="employee_pin" requried>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="http://localhost/csc680/parking_system/login.php">Login here</a></p>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>