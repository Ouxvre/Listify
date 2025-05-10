<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listify</title>
    <link rel="stylesheet" href="assets/css/main.css">

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
            <a href="#" class="nav-item"><i class="fas fa-home"></i> Home</a>
            <a href="#" class="nav-item"><i class="fas fa-clock-rotate-left"></i> History</a>
            <a href="#" class="nav-item"><i class="fas fa-box-archive"></i> Archive</a>
        </nav>

        <a href="../auth/logout.php">Logout</a>
        <hr class="garis-putih-profile">
        </hr>

        <!--  profile -->
        <div class="user-section" onclick="toggleDropdown()">
            <img src="assets/image/default.jpeg" alt="User">

            <div class="user-info">
                <div class="nameDropdown"><?= htmlspecialchars($username) ?></div>
                <div class="emailDropdown"><?= htmlspecialchars($email) ?></div>
            </div>


            <div class="dropdown">

                <!-- <div id="dropdownMenu" class="dropdown-menu">
                <a href="profile.php">Profile</a>
                <a href="setting.php">Settings</a>
                <a href="../auth/logout.php">Logout</a>
            </div> -->

            </div>
        </div>

    </div>

    <!-- main content -->
    <div class="main-content">

        <form action="../includes/add_task.php" method="POST">
            <div class="add-task-section">
                <h2>Add Task</h2>
                <div class="task-inputs">
                    <input type="text" name="title" id="title-input" placeholder="Add Title..." required>
                    <input type="text" name="task" id="task-input" placeholder="Add new task..." required>
                    <input type="datetime-local" name="deadline" id="date-input" placeholder="Due Date" required>
                    <button type="submit" class="add-btn" id="add-task">Add Task</button>
                </div>

            </div>
        </form>

        <hr class="garis-putih">
        </hr>

        <div class="task-section">
            <div class="task-header">
                <h2>My Task</h2>
            </div>
            <div class="task-container">
                <!-- Tempat tugas akan ditampilkan -->

                <?php
                include '../config/config.php';

                $result = $conn->query("SELECT * FROM todos ORDER BY deadline ASC");
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='task-box'>";
                    echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<small>Due: " . htmlspecialchars($row['due_date']) . "</small>";
                    echo "</div>";
                }
                ?>
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