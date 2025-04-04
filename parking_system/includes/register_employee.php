<?php


// Include database connection
include_once 'config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $employee_pin = trim($_POST['employee_pin']);
    $role = 'operator';
    // Basic validation
    if (empty($username) || empty($password) || empty($confirm_password) || empty($employee_pin)) {
        $_SESSION['error'] = 'All fields are required.';
        header('Location: ../register_new_employee.php');
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match.';
        header('Location: ../register_new_employee.php');
        exit();
    }

    if ($employee_pin !== '36548') {
        $_SESSION['error'] = 'Only Employees can register';
        header('Location: ../login.php');
        exit();
    }

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'Username already taken.';
        header('Location: ../register_new_employee.php');
        exit();
    }

    // Insert the new employee into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $username, $password, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = 'Employee registered successfully!';
        header('Location: ../login.php');
    } else {
        $_SESSION['error'] = 'Registration failed. Please try again.';
        header('Location: ../register_new_employee.php');
    }

    $stmt->close();
    $conn->close();
}
?>