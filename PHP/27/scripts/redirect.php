
<?php
include_once '../config/database.php';

$short_code = $_GET['c'] ?? '';

if (!empty($short_code)) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT long_url FROM urls WHERE short_code = :short_code";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":short_code", $short_code);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Location: " . $row['long_url']);
        exit();
    } else {
        echo "Invalid short URL.";
    }
} else {
    echo "No URL specified.";
}
?>
    