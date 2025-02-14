
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_name) && !empty($data->slot_id)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "UPDATE parking_slots SET status = 'reserved', user_name = :user_name WHERE id = :slot_id AND status = 'available'";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":user_name", $data->user_name);
    $stmt->bindParam(":slot_id", $data->slot_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Parking reserved successfully"]);
    } else {
        echo json_encode(["message" => "Failed to reserve parking slot"]);
    }
}
?>
    