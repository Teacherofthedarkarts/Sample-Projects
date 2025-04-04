<?php
include 'includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "Get") {
    $id = $_POST['user_id'];

    $sql = "DELETE FROM users WHERE user_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully!'); window.location.href='http://localhost/csc680/parking_system/manage_users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user!'); window.history.back();</script>";
    }
    $stmt->close();
}

$conn->close();
?>