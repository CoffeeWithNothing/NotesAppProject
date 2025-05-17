<?php
// db_connection.php

$host = 'localhost';            // MySQL host
$db   = 'bunnotes';             // database name
$user = 'root';         // database username
$pass = '';     // database password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch associative arrays
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo "Error de conexión a la base de datos.";
    error_log($e->getMessage());
    exit();
}
?>
