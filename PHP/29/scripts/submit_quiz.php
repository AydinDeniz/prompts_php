
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->answers)) {
    $database = new Database();
    $db = $database->getConnection();

    $score = 0;
    foreach ($data->answers as $answer) {
        $query = "SELECT correct_answer FROM questions WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":id", $answer->id);
        $stmt->execute();
        $correct_answer = $stmt->fetch(PDO::FETCH_ASSOC)['correct_answer'];

        if ($answer->answer == $correct_answer) {
            $score++;
        }
    }

    echo json_encode(["score" => $score]);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Invalid submission."]);
}
?>
    