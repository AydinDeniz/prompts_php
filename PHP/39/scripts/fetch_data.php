
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM sensor_data ORDER BY timestamp DESC LIMIT 10";
$stmt = $db->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($data);
?>
    