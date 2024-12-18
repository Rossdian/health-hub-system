<?php
    include ('connection.php');

    $stmt = $conn->prepare('
       SELECT ir.id AS report_id, pi.fullname 
       FROM incident_report ir 
       INNER JOIN personal_info pi ON ir.personal_id = pi.id
    ');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();