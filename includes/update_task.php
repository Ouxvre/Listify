<?php
session_start();
require '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Not authenticated']);
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $task_id = $_POST['task_id'] ?? null;
    $status = $_POST['status'] ?? null;

    if (!$task_id || !in_array($status, ['pending', 'completed'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input']);
        exit();
    }

    if ($status === 'completed') {
        $stmt = $conn->prepare("UPDATE todos SET status = ?, completed_at = NOW() WHERE id = ? AND user_id = ?");
    } else {
        $stmt = $conn->prepare("UPDATE todos SET status = ?, completed_at = NULL WHERE id = ? AND user_id = ?");
    }

    $stmt->bind_param("sii", $status, $task_id, $user_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Database error']);
    }

    $stmt->close();
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method']);
}
?>
