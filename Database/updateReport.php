<?php
$data = $_POST;
$user_id = (int) $data['user_id'];
$personal = $data['personal_id'];
$staff = $data['staff_id'];
$dateReport = $data['dateReport'];
$timeReport = $data['timeReport'];
$bp_mmhg = $data['bp_mmhg'];
$pr_bpm = $data['pr_bpm'];
$temp_celcious = $data['temp_celcious'];
$oxygen_saturation = $data['oxygen_saturation'];
$complaint = $data['complaint'];
$treatment = $data['treatment'];

try {    
    $sql = "UPDATE incident_report SET personal_id=?, staff_id=?, date=?, time=?, bp_mmhg=?, pr_bpm=?, temp_celcious=?, oxygen_saturation=?, complaint=?, treatment=? WHERE id=?";
    include('connection.php'); 
    $stmt = $conn->prepare($sql);
    $stmt->execute([$personal, $staff, $dateReport, $timeReport, $bp_mmhg, $pr_bpm, $temp_celcious, $oxygen_saturation, $complaint, $treatment, $user_id]);
    
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