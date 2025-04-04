<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'includes/config.php';
    include 'includes/header.php';
    include 'includes/nav.php';
    ?>

    <main>
        <h2>Manage Users</h2>
        <a href="create_user.php" class="btn">➕ Create New User</a>

        <table>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT user_id, username, role FROM users";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>{$row['username']}</td>
                <td>{$row['role']}</td>
                <td>
                    <a href='edit_user.php?id={$row['user_id']}' class='edit-btn'>✏️ Edit</a> | 
                    <a href='remove_user.php?id={$row['user_id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete {$row['username']}?\")'>🗑 Delete</a>
                </td>
            </tr>";
            }
            $conn->close();
            ?>
        </table>
    </main>


</body>
<?php include 'includes/footer.php'; ?>

</html>