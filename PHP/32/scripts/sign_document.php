
<?php
include_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document'])) {
    $targetDir = "../documents/";
    $targetFile = $targetDir . basename($_FILES["document"]["name"]);

    if (move_uploaded_file($_FILES["document"]["tmp_name"], $targetFile)) {
        $private_key = openssl_pkey_get_private(file_get_contents("../config/private_key.pem"), "your_password_here");
        $data = file_get_contents($targetFile);
        openssl_sign($data, $signature, $private_key, OPENSSL_ALGO_SHA256);
        file_put_contents("$targetFile.sig", base64_encode($signature));

        $database = new Database();
        $db = $database->getConnection();
        $query = "INSERT INTO signed_documents (file_name, signature) VALUES (:file_name, :signature)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":file_name", $targetFile);
        $stmt->bindParam(":signature", base64_encode($signature));

        if ($stmt->execute()) {
            echo json_encode(["message" => "Document signed successfully", "signature" => base64_encode($signature)]);
        } else {
            echo json_encode(["message" => "Database error"]);
        }
    } else {
        echo json_encode(["message" => "File upload failed"]);
    }
}
?>
    