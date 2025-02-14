
<?php
$requestUri = $_SERVER['REQUEST_URI'];
$serviceMap = [
    '/users' => 'http://localhost:8001/user_service.php',
    '/orders' => 'http://localhost:8002/order_service.php'
];

foreach ($serviceMap as $route => $serviceUrl) {
    if (strpos($requestUri, $route) === 0) {
        $query = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        $response = file_get_contents($serviceUrl . $query);
        echo $response;
        exit;
    }
}

http_response_code(404);
echo json_encode(["message" => "Service not found"]);
?>
    