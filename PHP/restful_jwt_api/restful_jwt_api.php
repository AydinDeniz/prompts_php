
<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

class API {
    private $host = "localhost";
    private $db_name = "test_db";
    private $username = "root";
    private $password = "";
    private $secret_key = "YOUR_SECRET_KEY";
    public $conn;

    public function __construct() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function register($email, $password) {
        $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bindParam(":password", $password_hash);
        if($stmt->execute()) {
            http_response_code(201);
            return json_encode(["message" => "User was created."]);
        } else {
            http_response_code(503);
            return json_encode(["message" => "Unable to create user."]);
        }
    }

    public function login($email, $password) {
        $query = "SELECT id, password FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row && password_verify($password, $row['password'])) {
            $token = $this->generateJWT(['id' => $row['id']]);
            http_response_code(200);
            return json_encode(["token" => $token]);
        } else {
            http_response_code(401);
            return json_encode(["message" => "Login failed."]);
        }
    }

    public function getUserDetails($token) {
        $user_data = $this->validateJWT($token);
        if ($user_data) {
            $query = "SELECT id, email FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $user_data->id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                http_response_code(200);
                return json_encode($user);
            } else {
                http_response_code(404);
                return json_encode(["message" => "User not found."]);
            }
        } else {
            http_response_code(401);
            return json_encode(["message" => "Access denied."]);
        }
    }

    private function generateJWT($data) {
        $issuedAt = time();
        $expire = $issuedAt + (60 * 60);
        $token = [
            "iat" => $issuedAt,
            "exp" => $expire,
            "data" => $data
        ];
        return JWT::encode($token, $this->secret_key);
    }

    private function validateJWT($token) {
        try {
            return JWT::decode($token, $this->secret_key, ['HS256'])->data;
        } catch(Exception $e) {
            return null;
        }
    }
}

$api = new API();
$input = json_decode(file_get_contents("php://input"));

$action = $_GET['action'] ?? '';

switch ($action) {
    case "register":
        echo $api->register($input->email, $input->password);
        break;
    case "login":
        echo $api->login($input->email, $input->password);
        break;
    case "user":
        $headers = apache_request_headers();
        $jwt = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : null;
        echo $api->getUserDetails($jwt);
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Invalid API endpoint."]);
        break;
}
?>
