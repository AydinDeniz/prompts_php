
<?php
include_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $token_id = uniqid();
        $metadata = json_encode(["name" => $_POST["name"], "description" => $_POST["description"], "image" => $targetFile]);

        $database = new Database();
        $db = $database->getConnection();
        $query = "INSERT INTO nfts (token_id, name, description, image, metadata) VALUES (:token_id, :name, :description, :image, :metadata)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":token_id", $token_id);
        $stmt->bindParam(":name", $_POST["name"]);
        $stmt->bindParam(":description", $_POST["description"]);
        $stmt->bindParam(":image", $targetFile);
        $stmt->bindParam(":metadata", $metadata);

        if ($stmt->execute()) {
            echo json_encode(["message" => "NFT minted successfully", "token_id" => $token_id]);
        } else {
            echo json_encode(["message" => "Failed to mint NFT"]);
        }
    }
}
?>
    