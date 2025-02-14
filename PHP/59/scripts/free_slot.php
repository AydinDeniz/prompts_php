
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->slot_id)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "UPDATE parking_slots SET status = 'available', user_name = NULL WHERE id = :slot_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":slot_id", $data->slot_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Parking slot is now available"]);
    } else {
        echo json_encode(["message" => "Failed to free the parking slot"]);
    }
}
?>
    