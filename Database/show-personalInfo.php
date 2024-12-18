<?php
    include ('connection.php');

    $stmt = $conn->prepare('SELECT * FROM personal_info');
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();