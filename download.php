<?php
include("connection.php");
session_start();

$allowedTables = ['attendance', 'details', 'users'];
$tableName = $_POST['table_name'] ?? '';

if (!in_array($tableName, $allowedTables, true)) {
    http_response_code(400);
    die("Invalid table name.");
}

try {
    $stmt = $pdo->prepare("SELECT * FROM $tableName");
    $stmt->execute();

    $rows = $stmt->fetchAll();

    if (empty($rows)) {
        http_response_code(404);
        die("No data to export.");
    }

    $columnNames = array_keys($rows[0]);

    $filename = $tableName . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $file = fopen('php://output', 'w');

    fputcsv($file, $columnNames);

    foreach ($rows as $row) {
        fputcsv($file, $row);
    }
    fclose($file);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
