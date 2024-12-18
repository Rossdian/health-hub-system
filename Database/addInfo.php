<?php
    session_start();

    $table_name = ($_SESSION['table']);
    $role = $_POST['role'];
    $fullname = $_POST['full_name'];
    $status = $_POST['status'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $yr_level = $_POST['year'];
    $department = $_POST['department'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_no'];
    $emergency_number = $_POST['emergency_no'];
    $emergency_contact = $_POST['emergency_contact'];
    $height_cm = $_POST['height'];
    $weight_kg = $_POST['weight'];

    try {    
        $command= "INSERT INTO 
                            $table_name( role, fullname, status, gender, course, yr_level, department, birthdate, address, email, contact_number, emergency_number, emergency_contact, height_cm, weight_kg)
                        VALUES 
                            ( '$role', '$fullname', '$status', '$gender', '$course', '$yr_level', '$department', '$birthdate', '$address', '$email', '$contact_number', '$emergency_number', '$emergency_contact', '$height_cm', '$weight_kg')";
     
        include('connection.php');
        $conn->exec($command);
        $response = [
            'success' => true,
            'message' => $fullname . ' successfully added to the system.'
        ];

    } catch (PDOException $e) {
        echo $e->getMessage();
        $response = [
            'success' => true,
            'message' => $e -> getMessage()
        ];
    }
    
    $_SESSION['response'] = $response;
    header('location: ../html/add-form-info.php');
?>