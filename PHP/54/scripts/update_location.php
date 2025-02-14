
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->vehicle_id) && !empty($data->latitude) && !empty($data->longitude)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO locations (vehicle_id, latitude, longitude, timestamp) VALUES (:vehicle_id, :latitude, :longitude, NOW())";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":vehicle_id", $data->vehicle_id);
    $stmt->bindParam(":latitude", $data->latitude);
    $stmt->bindParam(":longitude", $data->longitude);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Location updated successfully"]);
    } else {
        echo json_encode(["message" => "Failed to update location"]);
    }
}
?>
    