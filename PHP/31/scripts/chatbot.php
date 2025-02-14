
<?php
include_once '../config/database.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$user_message = trim($data['message'] ?? '');

if (!$user_message) {
    echo json_encode(["error" => "No message provided"]);
    exit;
}

$database = new Database();
$db = $database->getConnection();

// Store user message in memory
$query = "INSERT INTO chat_memory (user_message) VALUES (:message)";
$stmt = $db->prepare($query);
$stmt->bindParam(":message", $user_message);
$stmt->execute();

// Get conversation history
$query = "SELECT user_message FROM chat_memory ORDER BY id DESC LIMIT 5";
$stmt = $db->query($query);
$messages = $stmt->fetchAll(PDO::FETCH_COLUMN);
$conversation_history = implode(" ", array_reverse($messages));

// Call AI API for response
$api_key = 'your_openai_api_key_here';
$url = "https://api.openai.com/v1/chat/completions";
$headers = [
    "Authorization: Bearer " . $api_key,
    "Content-Type: application/json"
];

$payload = json_encode([
    "model" => "gpt-4",
    "messages" => [["role" => "system", "content" => "You are an AI chatbot."], ["role" => "user", "content" => $conversation_history]],
    "temperature" => 0.7
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
$reply = $result['choices'][0]['message']['content'] ?? "I'm not sure how to respond.";

// Store AI response in memory
$query = "INSERT INTO chat_memory (ai_response) VALUES (:response)";
$stmt = $db->prepare($query);
$stmt->bindParam(":response", $reply);
$stmt->execute();

echo json_encode(["response" => $reply]);
?>
    