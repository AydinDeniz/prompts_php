
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->doc_id)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM documents WHERE doc_id = :doc_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":doc_id", $data->doc_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $doc = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode(["verified" => true, "document" => $doc]);
    } else {
        echo json_encode(["verified" => false, "message" => "Document not found"]);
    }
}
?>
    