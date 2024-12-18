<?php
    $data = $_POST;
    $user_id = (int) $data['user_id'];
    $fname = $data['f_name'];
    $description = $data['description'];
    $manufacturer = $data['manufacturer'];
    $expiry_date = $data['expiry_date'];


    // try {    
        $sql = "UPDATE medicines SET name=?, description=?, manufacturer=?, expiry_date=? WHERE id=?";
        include('connection.php');
        $conn->prepare($sql)->execute([$fname, $description, $manufacturer, $expiry_date, $user_id]);
        
        
        echo json_encode([
            'success' => true,
            'message' => $fname. ' successfully updated.'
        ]);
    // } catch (PDOException $e) {
        
    // }
?>