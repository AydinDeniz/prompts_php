
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM listings ORDER BY created_at DESC";
$stmt = $db->query($query);
$listings = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["listings" => $listings]);
?>
    