
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->voter_id)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT vote_hash FROM votes WHERE voter_id = :voter_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":voter_id", $data->voter_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $vote_hash = $row['vote_hash'];

        $blockchain = file("../blockchain/ledger.txt", FILE_IGNORE_NEW_LINES);
        if (in_array($vote_hash, $blockchain)) {
            echo json_encode(["message" => "Vote verified successfully", "verified" => true]);
        } else {
            echo json_encode(["message" => "Blockchain verification failed", "verified" => false]);
        }
    } else {
        echo json_encode(["message" => "Vote not found"]);
    }
}
?>
    