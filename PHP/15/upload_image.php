
<?php
function addWatermark($image, $watermarkText) {
    $textColor = imagecolorallocate($image, 255, 255, 255);
    $font = __DIR__ . '/arial.ttf';
    $fontSize = 20;
    $x = 10;
    $y = imagesy($image) - 20;
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $watermarkText);
}

function resizeImage($file, $width, $height, $outputFormat = 'jpeg') {
    list($origWidth, $origHeight) = getimagesize($file);
    $image_p = imagecreatetruecolor($width, $height);
    $image = imagecreatefromstring(file_get_contents($file));
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
    addWatermark($image_p, 'Sample Watermark');

    if ($outputFormat === 'jpeg') {
        $outputFile = 'uploads/resized_image.jpg';
        imagejpeg($image_p, $outputFile, 100);
    } else {
        $outputFile = 'uploads/resized_image.png';
        imagepng($image_p, $outputFile);
    }

    imagedestroy($image_p);
    return $outputFile;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    
    if ($check !== false && ($imageFileType == "jpg" || $imageFileType == "png")) {
        if ($_FILES["image"]["size"] < 5000000) {  // 5MB limit
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
            $resizedImage = resizeImage($targetFile, 800, 600, 'jpeg');
            echo "Image uploaded and manipulated successfully: <a href='$resizedImage'>View Image</a>";
        } else {
            echo "File is too large.";
        }
    } else {
        echo "File is not a valid image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload and Manipulation</title>
</head>
<body>
    <form action="upload_image.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <input type="submit" value="Upload Image">
    </form>
</body>
</html>
    