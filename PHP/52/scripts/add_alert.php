
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->latitude) && !empty($data->longitude) && !empty($data->type) && !empty($data->description)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO alerts (latitude, longitude, type, description) VALUES (:latitude, :longitude, :type, :description)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":latitude", $data->latitude);
    $stmt->bindParam(":longitude", $data->longitude);
    $stmt->bindParam(":type", $data->type);
    $stmt->bindParam(":description", $data->description);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Alert added successfully"]);
    } else {
        echo json_encode(["message" => "Failed to add alert"]);
    }
}
?>
    