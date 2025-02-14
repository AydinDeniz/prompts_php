
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->username) && !empty($data->password)) {
    $database = new Database();
    $db = $database->getConnection();

    $hashed_password = password_hash($data->password, PASSWORD_BCRYPT);
    $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $data->username);
    $stmt->bindParam(":password", $hashed_password);

    if ($stmt->execute()) {
        $block_data = json_encode(["username" => $data->username, "password_hash" => $hashed_password]);
        $block_hash = hash("sha256", $block_data);
        file_put_contents("../config/blockchain.txt", $block_hash . PHP_EOL, FILE_APPEND);

        echo json_encode(["message" => "User registered successfully", "block_hash" => $block_hash]);
    } else {
        echo json_encode(["message" => "Registration failed"]);
    }
}
?>
    