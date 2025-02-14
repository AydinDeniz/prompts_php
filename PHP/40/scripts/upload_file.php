
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        $output = shell_exec("python3 ../scripts/moderate_content.py " . escapeshellarg($targetFile));
        echo json_encode(["message" => "File uploaded successfully", "result" => trim($output)]);
    } else {
        echo json_encode(["message" => "File upload failed"]);
    }
}
?>
    