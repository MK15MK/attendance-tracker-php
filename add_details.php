<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $dob = trim($_POST['dob'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $institution = trim($_POST['institution'] ?? '');
    $status = trim($_POST['status'] ?? '');
    $role = trim($_POST['role'] ?? '');

    $stmt = $pdo->prepare("INSERT INTO details (name, dob, phone, email, institution, status, role) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt->execute([$name, $dob, $phone, $email, $institution, $status, $role])) {
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'details.html'));
        exit;
    } else {
        http_response_code(500);
        echo "Error recording details";
    }
}
?>
