<?php

$host = 'localhost'; // Host name
$username = 'root'; // Mysql username
$password = ''; // Mysql password
$dbname = 'RefletsBleus'; // Database name

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname" , $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "-" . (int)$e->getCode();
}

