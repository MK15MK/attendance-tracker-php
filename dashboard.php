<?php
include("connection.php");
session_start();

$totalCandidates = $pdo->query("SELECT COUNT(*) AS total_count FROM details")->fetch()['total_count'];
$present = $pdo->query("SELECT COUNT(*) AS present_count FROM attendance WHERE attendance = 'Present'")->fetch()['present_count'];
$absent = $pdo->query("SELECT COUNT(*) AS absent_count FROM attendance WHERE attendance = 'Absent'")->fetch()['absent_count'];

$data = [
    'totalCandidates' => $totalCandidates,
    'present' => $present,
    'absent' => $absent
];

echo json_encode($data);
?>
