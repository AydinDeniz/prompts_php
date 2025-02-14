
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id) && !empty($data->course_id)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO enrollments (user_id, course_id, points) VALUES (:user_id, :course_id, 10)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":user_id", $data->user_id);
    $stmt->bindParam(":course_id", $data->course_id);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Enrolled successfully! You earned 10 points."]);
    } else {
        echo json_encode(["message" => "Failed to enroll"]);
    }
}
?>
    