
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->username) && !empty($data->password)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT password FROM users WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $data->username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($data->password, $row['password'])) {
            $block_data = json_encode(["username" => $data->username, "password_hash" => $row['password']]);
            $block_hash = hash("sha256", $block_data);

            $blockchain = file("../config/blockchain.txt", FILE_IGNORE_NEW_LINES);
            if (in_array($block_hash, $blockchain)) {
                echo json_encode(["message" => "Login successful", "block_verified" => true]);
            } else {
                echo json_encode(["message" => "Blockchain verification failed", "block_verified" => false]);
            }
        } else {
            echo json_encode(["message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["message" => "User not found"]);
    }
}
?>
    