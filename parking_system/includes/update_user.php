<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['user_id'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET username=?, role=? WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $role, $id);

    if ($stmt->execute()) {       
        echo "<script>alert('User updated successfully!'); window.location.href='http://localhost/csc680/parking_system/manage_users.php';</script>";
    } else {
        echo "<script>alert('Error updating user!'); window.history.back();</script>";
    }
    $stmt->close();
}

$conn->close();
?>