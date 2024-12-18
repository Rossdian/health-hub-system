<?php
    $data = $_POST;
    $user_id = (int) $data['user_id'];
    $role = $data['role'];
    $fname = $data['f_name'];
    $status = $data['status'];
    $gender = $data['gender'];
    $course = $data['course'];
    $yr_level = $data['year'];
    $department = $data['department'];
    $birthdate = $data['birthdate'];
    $address = $data['address'];
    $email1 = $data['email1'];
    $contact_no = $data['contact_no'];
    $emergency_no = $data['emergency_number'];
    $emergency_contact = $data['emergency_contact'];
    $height = $data['height'];
    $weight = $data['weight'];


    // try {    
        $sql = "UPDATE personal_info SET role=?, fullname=?, status=?, gender=?, course=?, yr_level=?, department=?, birthdate=?, address=?, email=?, contact_number=?, emergency_number=?, emergency_contact=?, height_cm=?, weight_kg=? WHERE id=?";
        include('connection.php');
        $conn->prepare($sql)->execute([$role, $fname, $status, $gender, $course, $yr_level, $department, $birthdate, $address, $email1, $contact_no, $emergency_no, $emergency_contact, $height, $weight, $user_id]);
        
        
        echo json_encode([
            'success' => true,
            'message' => $fname. ' successfully updated.'
        ]);
    // } catch (PDOException $e) {
        
    // }
?>