<?php
include("connection.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $pdo->prepare("SELECT * FROM details WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $result = $stmt->fetch();

    if ($result) {
        echo json_encode($result);
    } else {
        echo "";
    }
}
?>
