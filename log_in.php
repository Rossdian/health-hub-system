<?php
// Start the session
session_start();

$error_message = '';

if ($_POST) {
    include('database/connection.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query to fetch user data based on email
    $query = 'SELECT * FROM users WHERE email = :email';
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct
            $_SESSION['user'] = $user;
            header('Location: html/home.php');
        } else {
            // Incorrect password
            $error_message = 'Password is Incorrect';
        }
    } else {
        // User not found
        $error_message = 'Email not found';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Health Hub Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/HealthHub.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <header>
    
</header>
    

    <div class="container">
        <h2>Welcome to Health Hub</h2>
        <p>Our clinic is dedicated to providing quality healthcare services.</p>

        <form action="log_in.php" method="POST" id="form" class="form">
            <div class="input-container">
                <input type="text" id="email" placeholder="Email" name="email" required>
            </div>

            <div class="input-container">
                <input type="password" id="password" placeholder="Password" name="password" required>
            </div>
            <div class="error">
            <?php
                if(!empty($error_message)) { ?>
                    <div>
                        <p><?= $error_message ?> </p>
                    </div>
                    <?php } ?>
            </div>

            <button type="submit">Log in</button>

        </form>
        
        <p>No account yet? <a href="sign_up.php" id="signUpLink">Sign up</a></p>

    </div>


    <footer>
        <p>&copy; 2024 Health Hub Clinic. All rights reserved.</p>
    </footer>
    
</body>

</html>