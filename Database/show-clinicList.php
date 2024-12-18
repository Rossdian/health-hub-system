<?php
    include ('connection.php');

    $stmt = $conn->prepare('SELECT * FROM clinic_staffs');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();