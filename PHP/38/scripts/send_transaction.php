
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->from_address) && !empty($data->to_address) && !empty($data->amount)) {
    $database = new Database();
    $db = $database->getConnection();

    // Check sender balance
    $query = "SELECT balance FROM wallets WHERE address = :from_address";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":from_address", $data->from_address);
    $stmt->execute();
    $sender = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sender || $sender['balance'] < $data->amount) {
        echo json_encode(["message" => "Insufficient balance"]);
        exit;
    }

    // Deduct from sender
    $query = "UPDATE wallets SET balance = balance - :amount WHERE address = :from_address";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":amount", $data->amount);
    $stmt->bindParam(":from_address", $data->from_address);
    $stmt->execute();

    // Add to recipient
    $query = "UPDATE wallets SET balance = balance + :amount WHERE address = :to_address";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":amount", $data->amount);
    $stmt->bindParam(":to_address", $data->to_address);
    $stmt->execute();

    echo json_encode(["message" => "Transaction successful"]);
}
?>
    