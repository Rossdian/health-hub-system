<?php
    $data = $_POST;
    $user_id = (int) $data['user_id'];
    $full_name = $data['f_name'];

    try {    
        $command= "DELETE FROM medicines WHERE id=($user_id)";
        include('connection.php');
        $conn->exec($command);

        echo json_encode([
            'success' => true,
            'message' => $full_name. ' successfully deleted.'
        ]);
        
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error processing your request.'
        ]);
    }
?>