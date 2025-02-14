
<?php
include_once '../config/database.php';
include_once '../jwt/jwt_utils.php';

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->email) && !empty($data->password)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT id, password, role FROM users WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row && password_verify($data->password, $row['password'])) {
        $token = JWTUtils::encode(['id' => $row['id'], 'role' => $row['role']]);
        http_response_code(200);
        echo json_encode(["token" => $token]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Login failed."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Incomplete data."]);
}
?>
    