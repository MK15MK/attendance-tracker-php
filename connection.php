<?php
error_reporting(0);

$configFile = __DIR__ . '/db_config.php';
if (!file_exists($configFile)) {
    die("Missing db_config.php. Copy db_config.example.php to db_config.php and fill in your local values.");
}
$dbConfig = require $configFile;

$servername = $dbConfig["servername"];
$username = $dbConfig["username"];
$password = $dbConfig["password"];
$dbname = $dbConfig["dbname"];

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
