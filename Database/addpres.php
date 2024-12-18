<?php
    session_start();

    $table_name = ($_SESSION['table']);
    $name = $_POST['name'];
    $medicine = $_POST['medicine'];
    $dosage = $_POST['dosage'];
    $frequency = $_POST['frequency'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    try {    
        $command= "INSERT INTO 
                            $table_name( report_id, medicine_id, dosage, frequency, start_date, end_date)
                        VALUES 
                            ('$name', '$medicine', '$dosage', '$frequency', '$start_date', '$end_date')";
     
        include('connection.php');
        $conn->exec($command);
        $response = [
            'success' => true,
            'message' => 'Prescription successfully added to the system.'
        ];

    } catch (PDOException $e) {
        echo $e->getMessage();
        $response = [
            'success' => true,
            'message' => $e -> getMessage()
        ];
    }
    
    $_SESSION['response'] = $response;
    header('location: ../html/add-form-pres.php');
?>