
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->long_url)) {
    $database = new Database();
    $db = $database->getConnection();

    $short_code = substr(md5(uniqid()), 0, 6);
    $query = "INSERT INTO urls (short_code, long_url) VALUES (:short_code, :long_url)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":short_code", $short_code);
    $stmt->bindParam(":long_url", $data->long_url);

    if ($stmt->execute()) {
        echo json_encode(["short_url" => "http://localhost:8000/scripts/redirect.php?c=" . $short_code]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Error shortening URL."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Invalid URL."]);
}
?>
    