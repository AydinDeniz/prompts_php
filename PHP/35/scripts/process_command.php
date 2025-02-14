
<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->command)) {
    $command = strtolower(trim($data->command));
    $response = "I didn't understand that command.";

    if (strpos($command, "hello") !== false) {
        $response = "Hello! How can I assist you?";
    } elseif (strpos($command, "time") !== false) {
        $response = "The current time is " . date("h:i A");
    } elseif (strpos($command, "date") !== false) {
        $response = "Today's date is " . date("Y-m-d");
    } elseif (strpos($command, "weather") !== false) {
        $response = "Fetching weather details... (Placeholder)";
    }

    echo json_encode(["response" => $response]);
} else {
    echo json_encode(["error" => "No command received."]);
}
?>
    