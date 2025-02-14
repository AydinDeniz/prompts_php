
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->ticker)) {
    $output = shell_exec("python3 ../scripts/predict_stock.py " . escapeshellarg($data->ticker));
    echo json_encode(["ticker" => $data->ticker, "prediction" => trim($output)]);
}
?>
    