<?php
include("connection.php");
session_start();

$stmt = $pdo->query("SELECT * FROM details");
$rows = $stmt->fetchAll();

foreach ($rows as $row) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["dob"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["institution"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
    echo "<td>" . htmlspecialchars($row["role"]) . "</td>";
    echo "</tr>";
}
?>
