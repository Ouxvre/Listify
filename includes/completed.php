<?php
session_start();
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'], $_SESSION['user_id'])) {
    $task_id = $_POST['task_id'];
    $user_id = $_SESSION['user_id'];

    // Ambil data task
    $stmt = $conn->prepare("SELECT * FROM todos WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();
    $stmt->close();

    if ($task && $task['status'] != 'completed') {
        // Tandai sebagai completed
        $stmt = $conn->prepare("UPDATE todos SET status = 'completed' WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $task_id, $user_id);
        $stmt->execute();
        $stmt->close();

        // Simpan ke history
        $stmt = $conn->prepare("INSERT INTO task_history (user_id, title, description, deadline, action) VALUES (?, ?, ?, ?, 'completed')");
        $stmt->bind_param("isss", $user_id, $task['title'], $task['description'], $task['deadline']);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: ../public/main.php");
    exit();
} else {
    echo "Akses tidak valid.";
}
?>
