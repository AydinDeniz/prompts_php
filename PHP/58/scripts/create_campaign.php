
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->title) && !empty($data->description) && !empty($data->goal_amount)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO campaigns (title, description, goal_amount, raised_amount) VALUES (:title, :description, :goal_amount, 0)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":title", $data->title);
    $stmt->bindParam(":description", $data->description);
    $stmt->bindParam(":goal_amount", $data->goal_amount);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Campaign created successfully"]);
    } else {
        echo json_encode(["message" => "Failed to create campaign"]);
    }
}
?>
    