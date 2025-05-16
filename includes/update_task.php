<?php
session_start();
require '../config/database.php'; // Sesuaikan path jika beda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];
    $user_id = $_SESSION['user_id'];

    // Jika tombol delete ditekan
    if (isset($_POST['delete_task'])) {
        $stmt = $conn->prepare("UPDATE todos SET status = 'deleted' WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $task_id, $user_id);
        $stmt->execute();
    }

    // Jika checkbox centang ditekan
    if (isset($_POST['complete_task'])) {
        $stmt = $conn->prepare("UPDATE todos SET status = 'completed' WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $task_id, $user_id);
        $stmt->execute();
    }

    header("Location: ../public/main.php");
    exit;
}
