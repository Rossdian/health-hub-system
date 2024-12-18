<?php
    $data = $_POST;
    $user_id = (int) $data['user_id'];

    try {    
        $command= "DELETE FROM incident_report WHERE id=($user_id)";
        include('connection.php');
        $conn->exec($command);

        echo json_encode([
            'success' => true,
            'message' => 'Report successfully deleted.'
        ]);
        
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error processing your request.'
        ]);
    }
?>