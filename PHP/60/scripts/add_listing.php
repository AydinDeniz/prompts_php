
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->title) && !empty($data->location) && !empty($data->size) && !empty($data->price)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO listings (title, location, size, price) VALUES (:title, :location, :size, :price)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":title", $data->title);
    $stmt->bindParam(":location", $data->location);
    $stmt->bindParam(":size", $data->size);
    $stmt->bindParam(":price", $data->price);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Listing added successfully"]);
    } else {
        echo json_encode(["message" => "Failed to add listing"]);
    }
}
?>
    