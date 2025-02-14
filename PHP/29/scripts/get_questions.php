
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM questions ORDER BY RAND() LIMIT 5";
$stmt = $db->query($query);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($questions);
?>
    