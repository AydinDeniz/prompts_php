
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM appointments ORDER BY appointment_date ASC";
$stmt = $db->query($query);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["appointments" => $appointments]);
?>
    