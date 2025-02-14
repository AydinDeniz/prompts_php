
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->campaign_id) && !empty($data->donor_name) && !empty($data->amount)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO donations (campaign_id, donor_name, amount) VALUES (:campaign_id, :donor_name, :amount)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":campaign_id", $data->campaign_id);
    $stmt->bindParam(":donor_name", $data->donor_name);
    $stmt->bindParam(":amount", $data->amount);

    if ($stmt->execute()) {
        $updateQuery = "UPDATE campaigns SET raised_amount = raised_amount + :amount WHERE id = :campaign_id";
        $updateStmt = $db->prepare($updateQuery);
        $updateStmt->bindParam(":amount", $data->amount);
        $updateStmt->bindParam(":campaign_id", $data->campaign_id);
        $updateStmt->execute();

        echo json_encode(["message" => "Donation successful"]);
    } else {
        echo json_encode(["message" => "Failed to process donation"]);
    }
}
?>
    