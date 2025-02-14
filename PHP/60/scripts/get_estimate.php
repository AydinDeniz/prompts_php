
<?php
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->location) && !empty($data->size)) {
    $output = shell_exec("python3 ../scripts/estimate_price.py " . escapeshellarg($data->location) . " " . escapeshellarg($data->size));
    echo $output;
}
?>
    