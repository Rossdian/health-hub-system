<?php
// Establish database connection
$host = 'localhost';
$dbname = 'inventory';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
?>