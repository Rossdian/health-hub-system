<?php
    session_start();

    $table_name = ($_SESSION['table']);
    $personal_id = $_POST['personal_id'];
    $staff_id = $_POST['staff_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $bp_mmhg = $_POST['bp_mmhg'];
    $pr_bpm = $_POST['pr_bpm'];
    $temp_celcious = $_POST['temp_celcious'];
    $oxygen_saturation = $_POST['oxygen_saturation'];
    $complaint = $_POST['complaint'];
    $treatment = $_POST['treatment'];

    try {    
        $command= "INSERT INTO 
                            $table_name( personal_id, staff_id, date, time, bp_mmhg, pr_bpm, temp_celcious, oxygen_saturation, complaint, treatment)
                        VALUES 
                            ('$personal_id', '$staff_id', '$date', '$time', '$bp_mmhg', '$pr_bpm', '$temp_celcious', '$oxygen_saturation', '$complaint', '$treatment')";
     
        include('connection.php');
        $conn->exec($command);
        $response = [
            'success' => true,
            'message' => 'Report successfully added to the system.'
        ];

    } catch (PDOException $e) {
        echo $e->getMessage();
        $response = [
            'success' => true,
            'message' => $e -> getMessage()
        ];
    }
    
    $_SESSION['response'] = $response;
    header('location: ../html/add-form-report.php');
?>