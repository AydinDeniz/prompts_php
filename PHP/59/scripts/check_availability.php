
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM parking_slots WHERE status = 'available' ORDER BY id ASC";
$stmt = $db->query($query);
$slots = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["available_slots" => $slots]);
?>
    