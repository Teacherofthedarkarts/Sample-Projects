<?php include 'db.php'; ?>

<header>
    <?php include 'header.php'; ?>
</header>

<div class="table-container">
    <h2>Manage Pets</h2>
    <table id="pet-adoption-table">
        <thead>
            <tr>
                <th>Edit</th>
                <th>Delete</th>
                <th>Adopt</th>
                <th>Name</th>
                <th>Type</th>
                <th>Breed</th>
                <th>License Fee</th>
                <th>Arrival Date</th>
                <th>Owner Full Name</th>
                <th>Adoption Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->prepare("SELECT p.PET_ID, p.NAME, p.TYPE, p.BREED, p.LICENSE_FEE, p.ARRIVAL_DATE, 
                                    a.OWNER_FIRST_NAME, a.OWNER_LAST_NAME, a.OWNER_MIDDLE_NAME, a.ADOPTION_DATE 
                                    FROM PETS p 
                                    LEFT JOIN PET_ADOPTIONS a ON p.PET_ID = a.ID");
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td><a href='edit_pet.php?PET_ID={$row['PET_ID']}'>Edit</a></td>
                        <td><a href='delete_pet.php?PET_ID={$row['PET_ID']}' onclick='return confirm(\"Are you sure?\");'>Delete</a></td>
                        <td><a href='adopt_pet.php?PET_ID={$row['PET_ID']}'>Adopt</a></td>
                        <td>{$row['NAME']}</td>
                        <td>{$row['TYPE']}</td>
                        <td>{$row['BREED']}</td>
                        <td>$" . number_format($row['LICENSE_FEE'], 2) . "</td>
                        <td>{$row['ARRIVAL_DATE']}</td>
                        <td>{$row['OWNER_FIRST_NAME']} {$row['OWNER_LAST_NAME']} {$row['OWNER_MIDDLE_NAME']}</td>
                        <td>{$row['ADOPTION_DATE']}</td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
    <div class="table-footer">
        <a href="add_pet.php" class="add-pet-btn">Add Pet</a>
    </div>
</div>


<div class="navbar">
    <ul>
        <li><a href="index.php">Home Page</a></li>
    </ul>

    <img src="PET_SIDE_BAR.JPG" alt="Pet Side Bar" style="position: fixed; bottom: 100px; left: 10px; width: 150px;">

</div>
</main>
<footer>
    <?php include 'footer.php'; ?>
</footer>