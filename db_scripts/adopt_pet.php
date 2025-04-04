<?php include 'db.php'; ?>

<?php
if (isset($_GET['PET_ID'])) {
    $pet_id = $_GET['PET_ID'];
} else {
    die("Invalid request.");
}
?>
<header>
    <?php include 'header.php'; ?>
</header>
<main>
    <div>
        <h2>Adopt Pet</h2>
        <form action="process_adopt.php" method="post">
            <input type="hidden" name="PET_ID" value="<?= $pet_id ?>">

            <label>Owner First Name:</label>
            <input type="text" name="OWNER_FIRST_NAME" required>

            <label>Owner Middle Name:</label>
            <input type="text" name="OWNER_MIDDLE_NAME" required>

            <label>Owner Last Name:</label>
            <input type="text" name="OWNER_LAST_NAME">

            <label>Adoption Date:</label>
            <input type="date" name="ADOPTION_DATE" required>

            <button type="submit">Adopt</button>
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