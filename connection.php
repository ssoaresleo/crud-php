<?php
$host = '127.0.0.1';
$db   = 'mydb';
$user = 'root';
$pass = 'root';

$dsn = "mysql:host=$host;dbname=$db";

try {
    $conn = new PDO($dsn, $user, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
