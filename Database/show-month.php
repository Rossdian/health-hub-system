<?php
    include ('connection.php');

    $stmt = $conn->prepare('SELECT MONTHNAME(date) AS month, COUNT(date) AS Number_of_Patients FROM incident_report WHERE date BETWEEN \'2023-09-01\' AND \'2025-08-01\' GROUP BY MONTH(date)');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();