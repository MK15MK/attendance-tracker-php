<?php
include("connection.php");
session_start();

$stmt = $pdo->query("SELECT * FROM attendance ORDER BY time DESC");
$rows = $stmt->fetchAll();

$attendance = array();
foreach ($rows as $row) {
    $attendance[] = array(
        "name" => $row["name"],
        "date" => $row["date"],
        "time" => $row["time"],
        "attendance" => $row["attendance"]
    );
}

$response = array("attendance" => $attendance);
header('Content-Type: application/json');
echo json_encode($response);
?>
