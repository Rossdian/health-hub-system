<?php
    session_start();

    $table_name = ($_SESSION['table']);
    $full_name = $_POST['full_name'];
    $role = $_POST['role'];
    $address = $_POST['address'];
    $contact_no = $_POST['number'];
    $specialization = $_POST['specialization'];

    try {    
        $command= "INSERT INTO 
                            $table_name( fullname, role, address, contact_no, specialization)
                        VALUES 
                            ('$full_name', '$role', '$address', '$contact_no', '$specialization')";
     
        include('connection.php');
        $conn->exec($command);
        $response = [
            'success' => true,
            'message' => $full_name . ' successfully added to the system.'
        ];

    } catch (PDOException $e) {
        echo $e->getMessage();
        $response = [
            'success' => true,
            'message' => $e -> getMessage()
        ];
    }
    
    $_SESSION['response'] = $response;
    header('location: ../html/add-form-clinicstaff.php');
?>