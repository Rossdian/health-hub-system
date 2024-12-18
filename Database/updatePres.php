<?php
$data = $_POST;
$user_id = (int) $data['user_id'];
$fname = $data['f_name'];
$medicine_id = $data['medicine_name'];
$dosage = $data['dosage'];
$frequency = $data['frequency'];
$start_date = $data['start_date'];
$end_date = $data['end_date'];

try {    
    $sql = "UPDATE medicine_prescription SET report_id=?, medicine_id=?, dosage=?, frequency=?, start_date=?, end_date=? WHERE id=?";
    include('connection.php'); 
    $stmt = $conn->prepare($sql);
    $stmt->execute([$fname, $medicine_id, $dosage, $frequency, $start_date, $end_date, $user_id]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Report successfully updated.'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error updating report: ' . $e->getMessage()
    ]);
}
?>