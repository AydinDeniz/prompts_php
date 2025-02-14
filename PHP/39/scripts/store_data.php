
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->device_id) && isset($data->temperature) && isset($data->humidity)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO sensor_data (device_id, temperature, humidity) VALUES (:device_id, :temperature, :humidity)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":device_id", $data->device_id);
    $stmt->bindParam(":temperature", $data->temperature);
    $stmt->bindParam(":humidity", $data->humidity);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Data stored successfully"]);
    } else {
        echo json_encode(["message" => "Failed to store data"]);
    }
}
?>
    