
<?php
include_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document'])) {
    $targetDir = "../uploads/";
    $fileName = basename($_FILES["document"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["document"]["tmp_name"], $targetFile)) {
        $database = new Database();
        $db = $database->getConnection();

        $doc_id = uniqid();
        $qr_code = "qrcodes/" . $doc_id . ".png";
        shell_exec("python3 ../scripts/generate_qr.py " . escapeshellarg($doc_id) . " " . escapeshellarg($targetFile) . " " . escapeshellarg($qr_code));

        $query = "INSERT INTO documents (doc_id, name, path, qr_code) VALUES (:doc_id, :name, :path, :qr_code)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":doc_id", $doc_id);
        $stmt->bindParam(":name", $fileName);
        $stmt->bindParam(":path", $targetFile);
        $stmt->bindParam(":qr_code", $qr_code);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Document uploaded successfully", "doc_id" => $doc_id, "qr_code" => $qr_code]);
        } else {
            echo json_encode(["message" => "Failed to upload document"]);
        }
    }
}
?>
    