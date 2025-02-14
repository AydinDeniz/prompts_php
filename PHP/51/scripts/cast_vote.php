
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->voter_id) && !empty($data->candidate)) {
    $database = new Database();
    $db = $database->getConnection();

    $vote_hash = hash("sha256", $data->voter_id . $data->candidate . time());

    $query = "INSERT INTO votes (voter_id, candidate, vote_hash) VALUES (:voter_id, :candidate, :vote_hash)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":voter_id", $data->voter_id);
    $stmt->bindParam(":candidate", $data->candidate);
    $stmt->bindParam(":vote_hash", $vote_hash);

    if ($stmt->execute()) {
        file_put_contents("../blockchain/ledger.txt", $vote_hash . PHP_EOL, FILE_APPEND);
        echo json_encode(["message" => "Vote cast successfully", "hash" => $vote_hash]);
    } else {
        echo json_encode(["message" => "Vote submission failed"]);
    }
}
?>
    