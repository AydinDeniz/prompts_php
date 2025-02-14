
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->latitude) && !empty($data->longitude)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM alerts WHERE (ABS(latitude - :latitude) <= 1) AND (ABS(longitude - :longitude) <= 1) ORDER BY timestamp DESC LIMIT 5";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":latitude", $data->latitude);
    $stmt->bindParam(":longitude", $data->longitude);
    $stmt->execute();

    $alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["alerts" => $alerts]);
}
?>
    