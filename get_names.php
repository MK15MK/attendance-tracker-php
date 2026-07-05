<?php
include("connection.php");
session_start();

$stmt = $pdo->query("SELECT name FROM details");
$names = $stmt->fetchAll(PDO::FETCH_COLUMN);

$response = array("names" => $names);
header('Content-Type: application/json');
echo json_encode($response);
?>
