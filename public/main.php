<?php
session_start();
include '../config/config.php';

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

        <form id="task-form">
            <div class="add-task-section">
                <h2>Add Task</h2>
                <div class="task-inputs">
                    <input type="text" name="title" id="title-input" placeholder="Add Title..." required>
                    <input type="text" name="task" id="task-input" placeholder="Add new task..." required>
                    <input type="datetime-local" name="deadline" id="date-input" placeholder="Deadline..." required>
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
                $user_id = $_SESSION['user_id'];

                $query = "SELECT * FROM todos WHERE user_id = ? ORDER BY priority DESC, deadline ASC";

                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Cek jika ada task
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Letakkan HTML task di sini
                        $status = $row['status'];
                        $priority = $row['priority'];
                        $deadline = date("Y-m-d H:i", strtotime($row['deadline']));

                        $color = '';
                        if ($status == 'completed') {
                            $color = 'green';
                        } else {
                            $now = new DateTime();
                            $due = new DateTime($row['deadline']);
                            $diff = $now->diff($due)->days;

                            if ($due < $now) {
                                $color = 'red';
                            } elseif ($diff <= 1) {
                                $color = 'red';
                            } else {
                                $color = 'yellow';
                            }
                        }

                        echo "<div class='task-box'>";
                        echo "<div class='task-bar $color'></div>";
                        echo "<div class='task-content'>";
                        echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
                        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                        echo "<small>$deadline</small>";
                        echo "</div>";
                        echo "<div class='task-actions'>";

                        // Tombol favorit (opsional, belum ditangani di backend)
                        echo "<form method='POST' action='includes/toggle_priority.php' style='display:inline;'>";
                        echo "<input type='hidden' name='task_id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' class='star-btn'>" . ($priority ? '⭐' : '☆') . "</button>";
                        echo "</form>";


                        // Checkbox untuk completed
                        echo "<form method='POST' action='includes/completed.php' style='display:inline;'>";
                        echo "<input type='hidden' name='task_id' value='" . $row['id'] . "'>";
                        echo "<input type='checkbox' name='complete_task' onchange='this.form.submit()' " . ($status == 'completed' ? 'checked' : '') . ">";
                        echo "</form>";

                        // Tombol delete
                        echo "<form method='POST' action='includes/delete.php' style='display:inline;'>";
                        echo "<input type='hidden' name='task_id' value='" . $row['id'] . "'>";
                        echo "<button type='button' class='delete-btn' data-id='" . $row['id'] . "'>❌</button>";
                        echo "</form>";


                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p style='color: white;'>There are no tasks yet...</p>";
                }

                $stmt->close();
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