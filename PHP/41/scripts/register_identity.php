
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->name) && !empty($data->email)) {
    $database = new Database();
    $db = $database->getConnection();

    $identity_hash = hash("sha256", $data->name . $data->email . time());

    $query = "INSERT INTO identities (name, email, identity_hash) VALUES (:name, :email, :identity_hash)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":name", $data->name);
    $stmt->bindParam(":email", $data->email);
    $stmt->bindParam(":identity_hash", $identity_hash);

    if ($stmt->execute()) {
        file_put_contents("../blockchain/ledger.txt", $identity_hash . PHP_EOL, FILE_APPEND);
        echo json_encode(["message" => "Identity registered successfully", "hash" => $identity_hash]);
    } else {
        echo json_encode(["message" => "Registration failed"]);
    }
}
?>
    