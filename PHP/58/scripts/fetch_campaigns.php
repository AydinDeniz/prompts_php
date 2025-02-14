
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM campaigns ORDER BY created_at DESC";
$stmt = $db->query($query);
$campaigns = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["campaigns" => $campaigns]);
?>
    