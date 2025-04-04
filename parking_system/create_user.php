<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Employee Registion - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/config.php'; ?>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/nav.php'; ?>

    <main class="main">
        <h2>Create New Operator</h2>

        <?php if (isset($_GET['success']) && $_GET['success'] == "true"): ?>
            <p class="success">User created successfully!</p>
        <?php elseif (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form action="includes/insert_user.php" method="POST" onsubmit="return validateForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="admin">Admin</option>
                <option value="operator">Operator</option>
                <option value="valet">Valet</option>
            </select><br>

            <input type="submit" value="Create User">
        </form>
    </main>

    <script>
        function validateForm() {
            var username = document.getElementById("username").value.trim();
            var password = document.getElementById("password").value.trim();

            if (username === "" || password === "") {
                alert("Username and password cannot be empty.");
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }

            return true;
        }
    </script>

    <?php include 'includes/footer.php'; ?>
</body>

</html>