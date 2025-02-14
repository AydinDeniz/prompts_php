
<?php
include_once '../config/config.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$user_message = trim($data['message'] ?? '');

if (!$user_message) {
    echo json_encode(["error" => "No message provided"]);
    exit;
}

$api_key = OPENAI_API_KEY;
$url = "https://api.openai.com/v1/chat/completions";
$headers = [
    "Authorization: Bearer " . $api_key,
    "Content-Type: application/json"
];

$payload = json_encode([
    "model" => "gpt-4",
    "messages" => [["role" => "user", "content" => $user_message]],
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
$reply = $result['choices'][0]['message']['content'] ?? "Sorry, I couldn't process that.";

echo json_encode(["response" => $reply]);
?>
    