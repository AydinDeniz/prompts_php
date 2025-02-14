
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM locations ORDER BY timestamp DESC LIMIT 10";
$stmt = $db->query($query);
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["locations" => $locations]);
?>
    