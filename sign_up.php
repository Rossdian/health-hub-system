<?php

// Start the session
session_start();
$error_message = '';
$success_message = '';

// Check if a success message is set in the session (from the registration process)
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Remove it to avoid showing it on refresh
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Health Hub Clinic - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/HealthHub.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <header>
        <!-- Add any header content here if needed -->
    </header>

    <div class="container">
        <h2>Register for Health Hub Clinic</h2>

        <form action="database/register.php" method="POST" id="registerForm">
            <div class="input-container">
                <input type="text" name="firstName" id="firstName" placeholder="Enter your first name" required>
            </div>
            <div class="input-container">
                <input type="text" name="lastName" id="lastName" placeholder="Enter your last name" required>
            </div>
            <div class="input-container">
                <input type="text" name="email" id="email" placeholder="Enter your email address" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" id="password" placeholder="Create a password" required>
            </div>

            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
                
            <?php if (!empty($success_message)): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php endif; ?>
            
            <div class="input-container">
                <button type="submit">Register</button>
            </div>
        </form>

        <p>Already have an account? <a href="log_in.php">Login here</a></p>
    </div>

</body>

</html>
<style>
    /* Error message style */
.error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}

/* Success message style */
.success-message {
    color: green;
    font-size: 14px;
    margin-top: 5px;
}

</style>