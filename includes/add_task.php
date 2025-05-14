<?php
session_start();
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $title = $_POST["title"];
    $description = $_POST["task"];
    $deadline = $_POST["deadline"];

    if ($title && $description && $deadline) {
        $stmt = $conn->prepare("INSERT INTO todos (user_id, title, description, deadline) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $title, $description, $deadline);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: ../public/main.php"); // arahkan kembali ke halaman utama setelah submit
    exit();
}
?>
