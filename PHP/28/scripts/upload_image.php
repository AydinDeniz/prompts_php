
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $output = shell_exec("python3 ../scripts/recognize.py " . escapeshellarg($targetFile));
        echo json_encode(["message" => "Image uploaded successfully", "result" => trim($output)]);
    } else {
        echo json_encode(["message" => "Image upload failed"]);
    }
}
?>
    