<?php
session_start();
include 'config.php'; // Database connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username and password are required.";
        header("Location: http://localhost/csc680/parking_system/login.php");
        exit();
    }

    // Check credentials in database
    $sql = "SELECT user_id, username, password, role FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify password
        if ($password == $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role']; // Role-based access control

            header("Location: http://localhost/csc680/parking_system/dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password.";
        }
    } else {
        $_SESSION['error'] = "User not found.";
    }
    header("Location: http://localhost/csc680/parking_system/login.php");
    exit();
} else {
    header("Location: http://localhost/csc680/parking_system/login.php");
    exit();
}
?>