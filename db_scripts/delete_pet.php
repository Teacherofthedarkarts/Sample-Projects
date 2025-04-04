<?php
include 'db.php';

if (isset($_GET['PET_ID'])) {
    $pet_id = $_GET['PET_ID'];

    // Delete pet record
    $stmt = $conn->prepare("DELETE FROM PETS WHERE PET_ID = :PET_ID");
    $stmt->bindParam(':PET_ID', $pet_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: manage_pets.php?success=deleted");
        exit();
    } else {
        echo "Error deleting pet.";
    }
}
?>