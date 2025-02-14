
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->event_id) && !empty($data->name) && !empty($data->email)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO bookings (event_id, name, email) VALUES (:event_id, :name, :email)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":event_id", $data->event_id);
    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":email", $data->email);

    if($stmt->execute()) {
        http_response_code(201);
        echo json_encode(["message" => "Ticket booked successfully."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Unable to book ticket."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Invalid data."]);
}
?>
    