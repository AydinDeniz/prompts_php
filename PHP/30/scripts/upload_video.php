
<?php
include_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['video'])) {
    $targetDir = "../videos/";
    $targetFile = $targetDir . basename($_FILES["video"]["name"]);

    if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetFile)) {
        $database = new Database();
        $db = $database->getConnection();
        $query = "INSERT INTO videos (title, file_path) VALUES (:title, :file_path)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":title", $_POST['title']);
        $stmt->bindParam(":file_path", $targetFile);

        if ($stmt->execute()) {
            echo json_encode(["message" => "Video uploaded successfully"]);
        } else {
            echo json_encode(["message" => "Database error"]);
        }
    } else {
        echo json_encode(["message" => "File upload failed"]);
    }
}
?>
    