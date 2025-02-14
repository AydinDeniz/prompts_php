
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->message)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT response FROM knowledge_base WHERE question LIKE :message LIMIT 1";
    $stmt = $db->prepare($query);
    $searchTerm = "%" . $data->message . "%";
    $stmt->bindParam(":message", $searchTerm);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $response = $row['response'];
    } else {
        $response = shell_exec("python3 ../scripts/llm_handler.py " . escapeshellarg($data->message));
    }

    echo json_encode(["response" => $response]);
}
?>
    