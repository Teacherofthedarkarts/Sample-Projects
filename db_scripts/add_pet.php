<?php
require 'db.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pet_id = $_POST['PET_ID'];
    $name = $_POST['NAME'];
    $type = $_POST['TYPE'];
    $breed = $_POST['BREED'];
    $arrival_date = $_POST['ARRIVAL_DATE'];
    $license_fee = 95.00; // Default value

    // Basic validation
    if (!empty($pet_id) && !empty($name) && !empty($type) && !empty($breed) && !empty($arrival_date)) {
        $stmt = $conn->prepare("INSERT INTO pets (PET_ID, NAME, TYPE, BREED, LICENSE_FEE, ARRIVAL_DATE) 
                        VALUES (:pet_id, :name, :type, :breed, :license_fee, :arrival_date)");

        $stmt->bindParam(':pet_id', $pet_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':breed', $breed, PDO::PARAM_STR);
        $stmt->bindParam(':license_fee', $license_fee, PDO::PARAM_STR);
        $stmt->bindParam(':arrival_date', $arrival_date, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: manage_pets.php?success=added");
            exit();
        } else {
            echo "Error processing adding pet.";
        }


    } else {
        echo "<p>All fields are required.</p>";
    }
}
?>


<head>
    <title>Add Pet</title>
</head>
<header>
    <?php include 'header.php'; ?>
</header>
<main>
    <h2>Add a New Pet</h2>
    <form method="POST" action="add_pet.php">
        <label for="pet_id">Pet ID:</label>
        <input type="text" name="pet_id" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="type">Type:</label>
        <input type="text" name="type" required><br>

        <label for="breed">Breed:</label>
        <input type="text" name="breed" required><br>

        <label for="arrival_date">Arrival Date:</label>
        <input type="date" name="arrival_date" required><br>

        <button type="submit">Add Pet</button>
    </form>
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