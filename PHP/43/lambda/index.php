
<?php
require 'vendor/autoload.php';

use Aws\Lambda\LambdaClient;

$lambda = new LambdaClient([
    'region' => 'us-east-1',
    'version' => 'latest'
]);

function lambda_handler($event) {
    return [
        'statusCode' => 200,
        'body' => json_encode(["message" => "Hello from AWS Lambda!", "event" => $event])
    ];
}

$event = json_decode(file_get_contents('php://input'), true);
$response = lambda_handler($event);
echo json_encode($response);
?>
    