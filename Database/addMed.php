<?php
    session_start();

    $table_name = ($_SESSION['table']);
    $name = $_POST['name'];
    $description = $_POST['description'];
    $manufacturer = $_POST['manufacturer'];
    $expiry_date = $_POST['expiry_date'];

    try {    
        $command= "INSERT INTO 
                            $table_name( name, description, manufacturer, expiry_date)
                        VALUES 
                            ( '$name', '$description', '$manufacturer', '$expiry_date')";
     
        include('connection.php');
        $conn->exec($command);
        $response = [
            'success' => true,
            'message' => $name . ' successfully added to the system.'
        ];

    } catch (PDOException $e) {
        echo $e->getMessage();
        $response = [
            'success' => true,
            'message' => $e -> getMessage()
        ];
    }
    
    $_SESSION['response'] = $response;
    header('location: ../html/add-form-med.php');
?>