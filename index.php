<?php
require_once 'connection.php';

function clean_input($data)
{
    return trim($data);
}

// Start or resume the session
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = clean_input($_POST['username']);
    $inputPassword = clean_input($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$inputUsername, $inputPassword]);
    $user = $stmt->fetch();

    if ($user) {
        // Store user information in the session
        $_SESSION['username'] = $inputUsername;

        // Redirect to the home page
        header('Location: home.php');
        exit();
    } else {
        header('Location: index.html?error=1');
        exit();
    }
} else {
    // Check if the user is already logged in
    if (isset($_SESSION['username'])) {
        // User is already authenticated, allow access to home.html
        header('Location: home.php');
        exit();
    }
}
?>
