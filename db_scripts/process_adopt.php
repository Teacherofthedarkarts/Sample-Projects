<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pet_id = $_POST['PET_ID'];
    $owner_first_name = $_POST['owner_first_name'];
    $owner_last_name = $_POST['owner_last_name'];
    $owner_middle_name = $_POST['owner_middle_name'];
    $adoption_date = $_POST['adoption_date'];

    // Insert adoption record
    $stmt = $conn->prepare("INSERT INTO PET_ADOPTIONS (PET_ID, OWNER_FIRST_NAME, OWNER_LAST_NAME, OWNER_MIDDLE_NAME, ADOPTION_DATE) 
                            VALUES (:pet_id, :first_name, :last_name, :middle_name, :adoption_date)");
    $stmt->bindParam(':pet_id', $pet_id, PDO::PARAM_INT);
    $stmt->bindParam(':first_name', $owner_first_name, PDO::PARAM_STR);
    $stmt->bindParam(':last_name', $owner_last_name, PDO::PARAM_STR);
    $stmt->bindParam(':middle_name', $owner_middle_name, PDO::PARAM_STR);
    $stmt->bindParam(':adoption_date', $adoption_date, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header("Location: manage_pets.php?success=adopted");
        exit();
    } else {
        echo "Error processing adoption.";
    }
}
?>