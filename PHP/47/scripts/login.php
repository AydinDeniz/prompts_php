
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password) && !empty($data->otp_code)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT password, otp_secret FROM users WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":email", $data->email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($data->password, $row['password'])) {
            $expected_otp = shell_exec("python3 ../scripts/validate_otp.py " . escapeshellarg($row['otp_secret']) . " " . escapeshellarg($data->otp_code));
            if (trim($expected_otp) == "VALID") {
                echo json_encode(["message" => "Login successful"]);
            } else {
                echo json_encode(["message" => "Invalid OTP"]);
            }
        } else {
            echo json_encode(["message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["message" => "User not found"]);
    }
}
?>
    