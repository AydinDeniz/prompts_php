
<?php
session_start();

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $data = json_decode(file_get_contents("php://input"), true);
        $_SESSION['cart'][$data['product_id']] = $data['quantity'];
        echo json_encode(["message" => "Product added to cart"]);
        break;

    case 'view':
        echo json_encode($_SESSION['cart'] ?? []);
        break;

    case 'update':
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($_SESSION['cart'][$data['product_id']])) {
            $_SESSION['cart'][$data['product_id']] = $data['quantity'];
            echo json_encode(["message" => "Cart updated"]);
        }
        break;

    case 'remove':
        $data = json_decode(file_get_contents("php://input"), true);
        unset($_SESSION['cart'][$data['product_id']]);
        echo json_encode(["message" => "Product removed from cart"]);
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Invalid action"]);
        break;
}
?>
    