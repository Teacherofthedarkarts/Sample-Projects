<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Parking - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    include 'includes/config.php';
    include 'includes/header.php';
    include 'includes/nav.php';
    ?>

    <main>
        <h2>Parking Garage Occupancy</h2>
        <table border="1">
            <tr>
                <th>Level</th>
                <th>Total Spaces</th>
                <th>Available Spaces</th>
            </tr>

            <?php
            $sql = "SELECT floor_num, total_spaces, available_spaces FROM floor";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['floor_num']}</td>
                    <td>{$row['total_spaces']}</td>
                    <td>{$row['available_spaces']}</td>
                </tr>";
            }
            $conn->close();
            ?>
        </table>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>