<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valet Parking - ACME Parking</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php
    include 'includes/config.php';
    include 'includes/header.php';
    include 'includes/nav.php';

    // Fetch parking data
    $sql = "SELECT floor_num, total_spaces, available_spaces FROM floor";
    $result = $conn->query($sql);

    $levels = [];
    $total_spaces = [];
    $available_spaces = [];

    while ($row = $result->fetch_assoc()) {
        $levels[] = ($row['floor_num'] == 1) ? 'Valet' : 'Floor ' . $row['floor_num'];
        $total_spaces[] = $row['total_spaces'];
        $available_spaces[] = $row['available_spaces'];
    }

    $conn->close();
    ?>

    <main>
        <h2>Valet Parking Management</h2>
        <canvas id="valetChart" width="30" height="10"></canvas>

        <script>
            var ctx = document.getElementById('valetChart').getContext('2d');
            var valetChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($levels); ?>,
                    datasets: [
                        {
                            label: 'Available Spaces',
                            data: <?php echo json_encode($available_spaces); ?>,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Total Spaces',
                            data: <?php echo json_encode($total_spaces); ?>,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <?php
        include 'includes/config.php';

        $query = "SELECT v.license_plate, p.car_wash_fee 
              FROM vehicle v 
              JOIN parkingslip p ON v.vehicle_id = p.vehicle_id";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>

        <h3>Car Wash Log</h3>
        <table border="1">
            <tr>
                <th>License Plate</th>
                <th>Car Wash</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['license_plate']); ?></td>
                    <td><?php echo ($row['car_wash_fee'] > 0) ? 'Yes' : 'No'; ?></td>
                </tr>
            <?php } ?>
        </table>

        <?php
        $stmt->close();
        $conn->close();
        ?>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>