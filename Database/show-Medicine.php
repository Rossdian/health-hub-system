<?php
    include ('connection.php');

    $stmt = $conn->prepare('
        SELECT mp.*,  pi.fullname AS personal_fullname, m.name AS medicine_name, m.description , m.manufacturer, m.expiry_date
        FROM medicine_prescription mp
        JOIN incident_report ir ON mp.report_id = ir.id
        JOIN personal_info pi ON ir.personal_id = pi.id
        JOIN medicines m ON mp.medicine_id = m.id
    ');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();