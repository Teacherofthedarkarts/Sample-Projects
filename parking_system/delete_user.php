<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'includes/config.php';
    include 'includes/header.php';
    include 'includes/nav.php';

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
        <h2>Delete User</h2>
        <p>Are you sure you want to delete user <b><?php echo htmlspecialchars($row['username']); ?></b>?</p>
        <form action="includes/remove_user.php" method="POST">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['user_id']); ?>">
            <input type="submit" value="Delete User">
        </form>
        <br>
        <a href="manage_users.php">Cancel</a>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>