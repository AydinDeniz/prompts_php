
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM nfts ORDER BY created_at DESC";
$stmt = $db->query($query);
$nfts = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($nfts);
?>
    