<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '../config/config.php'; // Pastikan koneksi DB di sini (atau sesuaikan path)

    $title = $_POST['title'];
    $task = $_POST['task'];
    $due_date = $_POST['due_date'];

    $stmt = $conn->prepare("INSERT INTO todos (title, description, deadline) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $task, $due_date);
    $stmt->execute();
    $stmt->close();

    // Redirect kembali ke main.php setelah input
    header("Location: ../public/main.php");
    exit();
}
?>
