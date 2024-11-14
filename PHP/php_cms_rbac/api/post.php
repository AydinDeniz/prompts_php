
<?php
include_once '../config/database.php';
include_once '../jwt/jwt_utils.php';

$headers = apache_request_headers();
$jwt = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;
$user_data = JWTUtils::decode($jwt);

$action = $_GET['action'] ?? '';

$database = new Database();
$db = $database->getConnection();

switch ($action) {
    case 'create':
        if ($user_data && $user_data->role == 'admin') {
            $data = json_decode(file_get_contents("php://input"));
            $query = "INSERT INTO posts (title, content) VALUES (:title, :content)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":title", $data->title);
            $stmt->bindParam(":content", $data->content);
            $stmt->execute();
            echo json_encode(["message" => "Post created"]);
        } else {
            http_response_code(403);
            echo json_encode(["message" => "Access denied"]);
        }
        break;

    case 'read':
        $query = "SELECT * FROM posts";
        $stmt = $db->query($query);
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($posts);
        break;

    case 'update':
        if ($user_data && $user_data->role == 'admin') {
            $data = json_decode(file_get_contents("php://input"));
            $query = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":title", $data->title);
            $stmt->bindParam(":content", $data->content);
            $stmt->bindParam(":id", $data->id);
            $stmt->execute();
            echo json_encode(["message" => "Post updated"]);
        } else {
            http_response_code(403);
            echo json_encode(["message" => "Access denied"]);
        }
        break;

    case 'delete':
        if ($user_data && $user_data->role == 'admin') {
            $data = json_decode(file_get_contents("php://input"));
            $query = "DELETE FROM posts WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":id", $data->id);
            $stmt->execute();
            echo json_encode(["message" => "Post deleted"]);
        } else {
            http_response_code(403);
            echo json_encode(["message" => "Access denied"]);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Invalid action"]);
        break;
}
?>
    