<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Users - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'includes/config.php';
    include 'includes/header.php';
    include 'includes/nav.php';
    ?>

    <main>
        <h2>List of Users</h2>
        <?php
        $sql = "SELECT * FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['username']) . "</td>
                        <td>" . htmlspecialchars($row['role']) . "</td>
                        <td>
                            <a href='edit_user.php?id=" . urlencode($row['user_id']) . "'>Edit</a> | 
                            <a href='delete_user.php?id=" . urlencode($row['user_id']) . "'                                 
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No users found.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>

</html>