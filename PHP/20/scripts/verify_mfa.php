
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->email) && !empty($data->mfa_code)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT id FROM users WHERE email = :email AND mfa_code = :mfa_code AND mfa_expiry > NOW()";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->bindParam(":mfa_code", $data->mfa_code);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        echo json_encode(["message" => "MFA verification successful. Access granted."]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Invalid or expired MFA code."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Invalid data."]);
}
?>
    