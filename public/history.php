    <?php
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM task_history WHERE user_id = ? ORDER BY action_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<div class='history-item'>";
    echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
    echo "<small>" . htmlspecialchars($row['deadline']) . "</small>";
    echo "<span class='tag'>" . strtoupper($row['action']) . "</span>";
    echo "<span class='date'>" . $row['action_date'] . "</span>";
    echo "</div>";
}
$stmt->close();
?>
