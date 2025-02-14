
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password)) {
    $database = new Database();
    $db = $database->getConnection();

    $hashed_password = password_hash($data->password, PASSWORD_BCRYPT);
    $query = "INSERT INTO users (email, password, otp_secret) VALUES (:email, :password, :otp_secret)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->bindParam(":password", $hashed_password);

    $otp_secret = bin2hex(random_bytes(16));
    $stmt->bindParam(":otp_secret", $otp_secret);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User registered successfully", "otp_secret" => $otp_secret]);
    } else {
        echo json_encode(["message" => "Registration failed"]);
    }
}
?>
    