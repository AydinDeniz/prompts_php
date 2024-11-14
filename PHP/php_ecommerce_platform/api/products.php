
<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $data = json_decode(file_get_contents("php://input"));
        $query = "INSERT INTO products (name, price) VALUES (:name, :price)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":name", $data->name);
        $stmt->bindParam(":price", $data->price);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Product added"]);
        }
        break;

    case 'view':
        $query = "SELECT * FROM products";
        $stmt = $db->query($query);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
        break;

    case 'delete':
        $data = json_decode(file_get_contents("php://input"));
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $data->id);
        if ($stmt->execute()) {
            echo json_encode(["message" => "Product deleted"]);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Invalid action"]);
        break;
}
?>
    