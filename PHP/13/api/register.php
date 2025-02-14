
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->email) && !empty($data->password) && !empty($data->role)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO users (email, password, role) VALUES (:email, :password, :role)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":email", $data->email);
    $password_hash = password_hash($data->password, PASSWORD_BCRYPT);
    $stmt->bindParam(":password", $password_hash);
    $stmt->bindParam(":role", $data->role);

    if($stmt->execute()) {
        http_response_code(201);
        echo json_encode(["message" => "User created successfully."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Unable to create user."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Incomplete data."]);
}
?>
    