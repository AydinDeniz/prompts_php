
<?php
require 'vendor/autoload.php';
use Mpdf\Mpdf;

function generatePDF($htmlContent, $fileName = 'generated_pdf.pdf') {
    $mpdf = new Mpdf();
    $mpdf->WriteHTML($htmlContent);
    $filePath = "pdfs/" . $fileName;
    $mpdf->Output($filePath, \Mpdf\Output\Destination::FILE);
    return $filePath;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

    $html = "<h1>{$title}</h1><p>{$content}</p>";
    $pdfPath = generatePDF($html);

    echo "PDF generated successfully: <a href='$pdfPath'>Download PDF</a>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate PDF</title>
</head>
<body>
    <form action="generate_pdf.php" method="post">
        <input type="text" name="title" placeholder="Enter title" required>
        <textarea name="content" placeholder="Enter content" required></textarea>
        <input type="submit" value="Generate PDF">
    </form>
</body>
</html>
    