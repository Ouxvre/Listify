<?php
session_start();
include '../config/config.php';

if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];

// Ambil user_id dari database
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$user_id = $user['id'];

// Ambil data task history
$stmt = $conn->prepare("SELECT * FROM task_history WHERE user_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$histories = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listify</title>
    <link rel="stylesheet" href="assets/css/history.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
</head>

<body>

    <div class="sidebar">
        <div class="logo">LISTIFY</div>

        <hr class="garis-putih-sidebar">
        </hr>

        <nav class="nav-menu">
            <span class="menu-title">- Main Menu</span>
            <a href="main.php" class="nav-item"><i class="fas fa-home"></i> Home</a>
            <a href="history.php" class="nav-item"><i class="fas fa-clock-rotate-left"></i> History</a>
            <a href="../auth/logout.php" class="nav-item"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                Logout</a>
        </nav>

        <hr class="garis-putih-profile">
        </hr>

        <!--  profile -->
        <div class="user-section" onclick="toggleDropdown()">
            <img src="assets/image/default.jpeg" alt="User">

            <div class="user-info">
                <div class="nameDropdown">
                    <?php echo htmlspecialchars($username) ?>
                </div>
                <div class="emailDropdown">
                    <?php echo htmlspecialchars($email) ?>
                </div>
            </div>


        </div>

    </div>

    <!-- task history -->
    <div class="history-section">
        <h2>TASK HISTORY</h2>
        <div class="history-content">
            <?php if (!empty($histories)): ?>
                <?php foreach ($histories as $task): ?>
                    <div class="task-box">
                        <span class="task-title"><?= htmlspecialchars($task['title']) ?> (due:
                            <?= date('d/m/y', strtotime($task['deadline'])) ?>)</span>
                        <span class="status <?= $task['action'] === 'completed' ? 'completed' : 'deleted' ?>">
                            <?= $task['action'] ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="text-align:center; color:white;">Belum ada riwayat tugas.</p>
            <?php endif; ?>
        </div>

    </div>

    <button id="toggle-theme" class="theme-toggle">
        <i class="fas fa-sun"></i>
    </button>

    </div>

    <div class="footer"></div>

</body>
<script src="js/main.js"></script>

</html>