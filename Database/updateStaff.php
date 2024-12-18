<?php
    $data = $_POST;
    $user_id = (int) $data['user_id'];
    $full_name = $data['f_name'];
    $role = $data['role'];
    $address = $data['address'];
    $contact_no = $data['contact_no'];
    $specialization = $data['specialization'];


    // try {    
        $sql = "UPDATE clinic_staffs SET fullname=?, role=?, address=?, contact_no=?, specialization=? WHERE id=?";
        include('connection.php');
        $conn->prepare($sql)->execute([$full_name, $role, $address, $contact_no, $specialization,$user_id]);
        
        
        echo json_encode([
            'success' => true,
            'message' => $full_name. ' successfully updated.'
        ]);
    // } catch (PDOException $e) {
        
    // }
?>