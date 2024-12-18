<?php
session_start();
$error_message = '';

if ($_POST) {
    include('connection.php');

    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists in the database
    $query = 'SELECT * FROM users WHERE email = :email';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $error_message = 'Email already exists. Please try a different one.';
    } else {
        // Insert new user data into the database
        $insertQuery = 'INSERT INTO users (firstName, lastName, password, email) VALUES (:firstName, :lastName, :password, :email)';
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bindParam(':firstName', $firstName);
        $insertStmt->bindParam(':lastName', $lastName);
        $insertStmt->bindParam(':password', $password);
        $insertStmt->bindParam(':email', $email);

        if ($insertStmt->execute()) {
            $_SESSION['user'] = [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email
            ];
                $_SESSION['success_message'] = 'Registration successful! You can now log in.';
                header('Location: ../sign_up.php'); // Redirect to the sign-up page
                exit();
            } else {
                $error_message = 'Registration failed. Please try again.';
            }
    }
}
?>