
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->product_id) && isset($data->quantity)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "UPDATE inventory SET quantity = :quantity WHERE product_id = :product_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":quantity", $data->quantity);
    $stmt->bindParam(":product_id", $data->product_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Inventory updated successfully"]);
    } else {
        echo json_encode(["message" => "Failed to update inventory"]);
    }
}
?>
    