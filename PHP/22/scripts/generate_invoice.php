
<?php
require 'vendor/autoload.php';
use Mpdf\Mpdf;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $invoiceNumber = htmlspecialchars($_POST['invoice_number']);
    $customerName = htmlspecialchars($_POST['customer_name']);
    $items = json_decode($_POST['items'], true);

    $html = "<h1>Invoice #$invoiceNumber</h1>";
    $html .= "<p>Customer: $customerName</p>";
    $html .= "<table border='1' cellpadding='5'><tr><th>Item</th><th>Price</th></tr>";

    foreach ($items as $item) {
        $html .= "<tr><td>{$item['name']}</td><td>\${$item['price']}</td></tr>";
    }
    
    $html .= "</table>";

    $mpdf = new Mpdf();
    $mpdf->WriteHTML($html);
    $filePath = "../pdfs/invoice_$invoiceNumber.pdf";
    $mpdf->Output($filePath, \Mpdf\Output\Destination::FILE);

    echo json_encode(["message" => "Invoice generated successfully", "file" => $filePath]);
}
?>
    