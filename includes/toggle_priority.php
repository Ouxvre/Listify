<?php
session_start();
require '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];

    // Ambil priority saat ini
    $query = "SELECT priority FROM todos WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $currentPriority = $row['priority'];

    // Toggle: jika 0 jadi 1, jika 1 jadi 0
    $newPriority = $currentPriority ? 0 : 1;

    // Update
    $update = "UPDATE todos SET priority = ? WHERE id = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ii", $newPriority, $task_id);
    $stmt->execute();

    // Redirect kembali ke halaman utama
    header("Location: ../public/main.php");
    exit();
}
?>
