<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'bunnotes';

// Connect to MySQL
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "DROP DATABASE IF EXISTS `$db_name`";
if ($mysqli->query($sql) === TRUE) {
    echo "Database `$db_name` dropped successfully.<br>";
} else {
    echo "Error dropping database `$db_name`: " . $mysqli->error . "<br>";
}


$mysqli->close();
echo "<h1>Uninstallation complete.</h1>";
?>
