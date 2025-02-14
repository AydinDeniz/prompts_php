
<?php
include_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document'])) {
    $targetFile = $_FILES["document"]["tmp_name"];
    $signatureFile = $targetFile . ".sig";

    if (!file_exists($signatureFile)) {
        echo json_encode(["message" => "Signature file not found."]);
        exit();
    }

    $public_key = openssl_pkey_get_public(file_get_contents("../config/public_key.pem"));
    $data = file_get_contents($targetFile);
    $signature = base64_decode(file_get_contents($signatureFile));

    $valid = openssl_verify($data, $signature, $public_key, OPENSSL_ALGO_SHA256);

    echo json_encode(["message" => $valid ? "Signature is valid." : "Signature is invalid."]);
}
?>
    