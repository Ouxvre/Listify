<?php
session_start();
require '../config/konfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];

    // Hash password sebelum disimpan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss",$username, $email, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['email'] = $email;
        header("Location: ../public/login.php");
        exit();
    } else {
        echo "Gagal registrasi: " . $conn->error;
    }

    $stmt->close();
}
?>
