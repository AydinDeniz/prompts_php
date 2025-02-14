
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT identity_hash FROM identities WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $identity_hash = $row['identity_hash'];

        $blockchain = file("../blockchain/ledger.txt", FILE_IGNORE_NEW_LINES);
        if (in_array($identity_hash, $blockchain)) {
            echo json_encode(["message" => "Identity verified successfully", "verified" => true]);
        } else {
            echo json_encode(["message" => "Blockchain verification failed", "verified" => false]);
        }
    } else {
        echo json_encode(["message" => "Identity not found"]);
    }
}
?>
    