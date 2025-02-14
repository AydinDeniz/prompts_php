
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'create':
        $data = json_decode(file_get_contents("php://input"));
        $query = "INSERT INTO items (name, description) VALUES (:name, :description)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":name", $data->name);
        $stmt->bindParam(":description", $data->description);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Item created successfully"]);
        }
        break;

    case 'read':
        $query = "SELECT * FROM items";
        $stmt = $db->query($query);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($items);
        break;

    case 'update':
        $data = json_decode(file_get_contents("php://input"));
        $query = "UPDATE items SET name = :name, description = :description WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":name", $data->name);
        $stmt->bindParam(":description", $data->description);
        $stmt->bindParam(":id", $data->id);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Item updated successfully"]);
        }
        break;

    case 'delete':
        $data = json_decode(file_get_contents("php://input"));
        $query = "DELETE FROM items WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $data->id);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Item deleted successfully"]);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Invalid action"]);
        break;
}
?>
    