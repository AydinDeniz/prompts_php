
<?php
include_once 'database.php';

$data = json_decode(file_get_contents("php://input"));
if(!empty($data->username) && !empty($data->password)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT id FROM users WHERE username = :username AND password = :password";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $data->username);
    $stmt->bindParam(":password", $data->password);  // Note: For demo, plain text, use hashing for production
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row) {
        echo json_encode(["message" => "Login successful"]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Login failed"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Invalid data"]);
}
?>
    