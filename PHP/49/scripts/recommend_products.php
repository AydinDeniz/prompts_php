
<?php
include_once '../config/database.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id)) {
    $output = shell_exec("python3 ../scripts/generate_recommendations.py " . escapeshellarg($data->user_id));
    echo json_encode(["user_id" => $data->user_id, "recommendations" => json_decode($output)]);
}
?>
    