<?php
session_start();
include '../config/config.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $title = $_POST["title"];
    $description = $_POST["task"];
    $deadline = $_POST["deadline"];

    if ($title && $description && $deadline) {
        $stmt = $conn->prepare("INSERT INTO todos (user_id, title, description, deadline) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $title, $description, $deadline);

        if ($stmt->execute()) {
            $last_id = $stmt->insert_id;
            echo json_encode([
                'success' => true,
                'id' => $last_id,
                'title' => $title,
                'task' => $description,
                'deadline' => $deadline
            ]);
        } else {
            echo json_encode(['success' => false]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
