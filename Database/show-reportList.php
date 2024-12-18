<?php
    include ('connection.php');

    $stmt = $conn->prepare('
        SELECT ir.*, pi.fullname AS personal_fullname, cs.fullname AS clinic_staff_fullname
        FROM incident_report ir
        INNER JOIN personal_info pi ON ir.personal_id = pi.id
        INNER JOIN clinic_staffs cs ON ir.staff_id = cs.id
    ');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();