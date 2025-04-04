<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'includes/config.php';
    include 'includes/header.php';
    include 'includes/nav.php';

    // Check if user ID is provided
    if (isset($_GET['id'])) {
        $user_id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if (!$row) {
            echo "<script>alert('User not found!'); window.location.href='manage_users.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('No user ID provided!'); window.location.href='manage_users.php';</script>";
        exit();
    }
    ?>

    <main>
        <h2>Edit User</h2>
        <form action="includes/update_user.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['user_id']); ?>">
            Username: <input type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>"
                required><br>
            Role:
            <select name="role">
                <option value="admin" <?php if ($row['role'] == 'admin')
                    echo 'selected'; ?>>Admin</option>
                <option value="operator" <?php if ($row['role'] == 'operator')
                    echo 'selected'; ?>>Operator</option>
                <option value="valet" <?php if ($row['role'] == 'valet')
                    echo 'selected'; ?>>Valet</option>
            </select><br>
            <input type="submit" value="Update User">
        </form>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>