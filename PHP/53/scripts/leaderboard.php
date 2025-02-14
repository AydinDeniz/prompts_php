
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT users.name, SUM(enrollments.points) as total_points FROM enrollments 
          JOIN users ON enrollments.user_id = users.id GROUP BY users.id ORDER BY total_points DESC";
$stmt = $db->query($query);
$leaderboard = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["leaderboard" => $leaderboard]);
?>
    