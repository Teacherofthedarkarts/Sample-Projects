<?php include 'db.php'; ?>
<?php
// Get pet ID from URL
if (isset($_GET['PET_ID'])) {
    $pet_id = $_GET['PET_ID'];

    // Fetch pet details
    $stmt = $conn->prepare("SELECT * FROM PETS WHERE PET_ID = :PET_ID");
    $stmt->bindParam(':PET_ID', $pet_id, PDO::PARAM_INT);
    $stmt->execute();
    $pet = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pet) {
        die("Pet not found.");
    }
} else {
    die("Invalid request.");
}
?>
<header>
    <?php include 'header.php'; ?>
</header>
<main>
    <div class="content">
        <h2>Edit Pet</h2>
        <form action="process_edit.php" method="post">
            <input type="hidden" name="PET_ID" value="<?= $pet['PET_ID'] ?>">
            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($pet['NAME']) ?>" required>

            <label>Type:</label>
            <select name="Type">
                <option value="Dog" <?= $pet['TYPE'] == 'Dog' ? 'selected' : '' ?>>Dog</option>
                <option value="Cat" <?= $pet['TYPE'] == 'Cat' ? 'selected' : '' ?>>Cat</option>
            </select>

            <label>Breed:</label>
            <input type="text" name="Breed" value="<?= htmlspecialchars($pet['BREED']) ?>" required>

            <label>License Fee:</label>
            <input type="number" name="LICENSE_FEE" value="<?= $pet['LICENSE_FEE'] ?>" step="0.01" required>

            <label>Arrival Date:</label>
            <input type="date" name="ARRIVAL_DATE" value="<?= $pet['ARRIVAL_DATE'] ?>" required>

            <button type="submit">Update Pet</button>
        </form>
    </div>
</main>
<div class="navbar">
    <ul>
        <li><a href="index.php">Home Page</a></li>
        <li><a href="manage_pets.php">Manage Pets</a></li>
    </ul>
    <img src="PET_SIDE_BAR.JPG" alt="Pet Side Bar" style="position: fixed; bottom: 100px; left: 10px; width: 150px;">
</div>
<footer>
    <?php include 'footer.php'; ?>
</footer>