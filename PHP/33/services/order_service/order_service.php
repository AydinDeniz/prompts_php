
<?php
header('Content-Type: application/json');

$orders = [
    ["order_id" => 101, "user_id" => 1, "amount" => 250],
    ["order_id" => 102, "user_id" => 2, "amount" => 450]
];

echo json_encode($orders);
?>
    