
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM inventory ORDER BY product_id ASC";
$stmt = $db->query($query);
$inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["inventory" => $inventory]);
?>
    