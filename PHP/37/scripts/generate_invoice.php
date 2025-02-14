
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->tenant_id) && !empty($data->amount)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO invoices (tenant_id, amount, status) VALUES (:tenant_id, :amount, 'pending')";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":tenant_id", $data->tenant_id);
    $stmt->bindParam(":amount", $data->amount);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Invoice generated successfully"]);
    } else {
        echo json_encode(["message" => "Invoice generation failed"]);
    }
}
?>
    