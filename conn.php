<?php
$host = "localhost";
$dbname = "onlineventure";
$username = "root";
$password = "";

$dsn = "mysql:host=$host;dbname=$dbname;";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}