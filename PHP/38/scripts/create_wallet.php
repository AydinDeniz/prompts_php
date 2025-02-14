
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id)) {
    $database = new Database();
    $db = $database->getConnection();

    $wallet_address = hash("sha256", uniqid($data->user_id, true));
    $query = "INSERT INTO wallets (user_id, address, balance) VALUES (:user_id, :address, 0)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":user_id", $data->user_id);
    $stmt->bindParam(":address", $wallet_address);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Wallet created successfully", "address" => $wallet_address]);
    } else {
        echo json_encode(["message" => "Wallet creation failed"]);
    }
}
?>
    