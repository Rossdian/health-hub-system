<?php
    include ('connection.php');

    $stmt = $conn->prepare('
        SELECT ir.date, pi.fullname,  pi.role, ir.complaint, ir.treatment, m.name, mp.frequency
        FROM medicine_prescription mp
        JOIN incident_report ir ON mp.report_id = ir.id
        JOIN personal_info pi ON ir.personal_id = pi.id
        JOIN medicines m ON mp.medicine_id = m.id
    ');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();