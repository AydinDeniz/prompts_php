
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['resume'])) {
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["resume"]["name"]);

    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFile)) {
        $output = shell_exec("python3 ../scripts/parse_resume.py " . escapeshellarg($targetFile));
        echo json_encode(["message" => "Resume uploaded successfully", "result" => trim($output)]);
    } else {
        echo json_encode(["message" => "Resume upload failed"]);
    }
}
?>
    