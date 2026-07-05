<?php
include("connection.php");
session_start();

$name = trim($_POST['name'] ?? '');
$date = trim($_POST['date'] ?? '');
$time = trim($_POST['time'] ?? '');
$attendance = trim($_POST['attendance'] ?? '');

$validDate = DateTime::createFromFormat('Y-m-d', $date);
if (!$validDate) {
    http_response_code(400);
    die("Invalid date format");
}

$stmt = $pdo->prepare("INSERT INTO attendance (name, date, time, attendance) VALUES (?, ?, ?, ?)");

if ($stmt->execute([$name, $date, $time, $attendance])) {
    echo "Attendance recorded successfully";
} else {
    http_response_code(500);
    echo "Error recording attendance";
}
?>
