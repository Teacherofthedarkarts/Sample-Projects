<?php
include 'db.php';

try {
    // Prepare and execute the SQL query
    $sql = "SELECT 
                p.PET_ID, 
                p.NAME AS pet_name, 
                t.NAME AS pet_type, 
                b.NAME AS pet_breed, 
                p.ARRIVAL_DATE,
                a.OWNER_FIRST_NAME, 
                a.OWNER_MIDDLE_NAME, 
                a.OWNER_LAST_NAME, 
                a.ADOPTION_DATE
            FROM pets p
            INNER JOIN pet_types t ON t.TYPE_ID = p.type
            INNER JOIN pet_breeds b ON b.BREED_ID = p.breed
            LEFT JOIN pet_adoptions a ON a.ID = p.PET_ID
            ORDER BY t.NAME, b.NAME";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<header>
    <?php include 'header.php'; ?>
</header>
<main>
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            width: 280px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            background-color: #f9f9f9;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 1.2em;
            color: #333;
        }

        .card p {
            margin: 5px 0;
            font-size: 0.9em;
        }

        .card .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .card a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9em;
            color: #fff;
        }

        .edit-btn {
            background-color: #007bff;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn:hover {
            background-color: #a71d2a;
        }
    </style>

    <div class="card-container">
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($row['pet_name']); ?></h3>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($row['pet_type']); ?></p>
                <p><strong>Breed:</strong> <?php echo htmlspecialchars($row['pet_breed']); ?></p>
                <p><strong>Arrival Date:</strong> <?php echo htmlspecialchars($row['ARRIVAL_DATE']); ?></p>
                <p><strong>Owner:</strong>
                    <?php
                    echo $row['OWNER_FIRST_NAME']
                        ? htmlspecialchars(trim($row['OWNER_FIRST_NAME'] . ' ' . $row['OWNER_MIDDLE_NAME'] . ' ' . $row['OWNER_LAST_NAME']))
                        : 'N/A';
                    ?>
                </p>
                <p><strong>Adoption Date:</strong>
                    <?php echo $row['ADOPTION_DATE'] ? htmlspecialchars($row['ADOPTION_DATE']) : 'N/A'; ?>
                </p>
                <div class="buttons">
                    <a href="edit_pet.php?PET_ID=<?php echo $row['PET_ID']; ?>" class="edit-btn">Edit</a>
                    <a href="delete_pet.php?PET_ID=<?php echo $row['PET_ID']; ?>" class="delete-btn"
                        onclick="return confirm('Are you sure?');">Delete</a>
                </div>
            </div>
        <?php } ?>
    </div>

    </table>
    <div class="navbar">
        <ul>
            <li><a href="manage_pets.php">Manage Pets</a></li>
        </ul>
    </div>
</main>

<footer>
    <?php include 'footer.php'; ?>
</footer>

<?php $conn = null; ?>