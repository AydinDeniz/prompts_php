
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->email) && !empty($data->password)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT id, password FROM users WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user && password_verify($data->password, $user['password'])) {
        $mfa_code = rand(100000, 999999);  // Generate 6-digit MFA code
        $query = "UPDATE users SET mfa_code = :mfa_code, mfa_expiry = DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":mfa_code", $mfa_code);
        $stmt->bindParam(":id", $user['id']);
        $stmt->execute();

        // Simulate sending MFA code (in production, use email or SMS API)
        echo json_encode(["message" => "Login successful. MFA code sent.", "mfa_code" => $mfa_code]);
    } else {
        http_response_code(401);
        echo json_encode(["message" => "Invalid credentials."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Invalid data."]);
}
?>
    