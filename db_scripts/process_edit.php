<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['PET_ID'];
    $name = $_POST['NAME'];
    $type = $_POST['TYPE'];
    $breed = $_POST['BREED'];
    $license_fee = $_POST['LICENSE_FEE'];
    $arrival_date = $_POST['ARRIVAL_DATE'];

    // Update pet record
    $stmt = $conn->prepare("UPDATE PETS SET NAME=:NAME, TYPE=:TYPE, BREED=:BREED, LICENSE_FEE=:LICENSE_FEE, ARRIVAL_DATE=:ARRIVAL_DATE WHERE PET_ID=:PET_ID");
    $stmt->bindParam(':PET_ID', $id, PDO::PARAM_INT);
    $stmt->bindParam(':NAME', $name, PDO::PARAM_STR);
    $stmt->bindParam(':TYPE', $type, PDO::PARAM_STR);
    $stmt->bindParam(':BREED', $breed, PDO::PARAM_STR);
    $stmt->bindParam(':LICENSE_FEE', $license_fee, PDO::PARAM_STR);
    $stmt->bindParam(':ARRIVAL_DATE', $arrival_date, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header("Location: manage_pets.php?success=updated");
        exit();
    } else {
        echo "Error updating pet.";
    }
}
?>