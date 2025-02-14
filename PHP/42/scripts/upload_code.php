
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['code'])) {
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["code"]["name"]);

    if (move_uploaded_file($_FILES["code"]["tmp_name"], $targetFile)) {
        $output = shell_exec("python3 ../scripts/analyze_code.py " . escapeshellarg($targetFile));
        echo json_encode(["message" => "Code uploaded successfully", "result" => trim($output)]);
    } else {
        echo json_encode(["message" => "Code upload failed"]);
    }
}
?>
    