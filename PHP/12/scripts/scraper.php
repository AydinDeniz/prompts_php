
<?php
include_once '../config/database.php';

function fetchHTML($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

function parseHTML($html) {
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);

    $data = [];
    foreach ($xpath->query('//div[@class="product"]') as $product) {
        $name = $xpath->query('.//h2[@class="product-name"]', $product)->item(0)->nodeValue ?? "N/A";
        $price = $xpath->query('.//span[@class="price"]', $product)->item(0)->nodeValue ?? "N/A";
        $description = $xpath->query('.//p[@class="description"]', $product)->item(0)->nodeValue ?? "N/A";

        $data[] = [
            "name" => trim($name),
            "price" => trim($price),
            "description" => trim($description)
        ];
    }
    return $data;
}

function saveToDatabase($data) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO products (name, price, description) VALUES (:name, :price, :description) ON DUPLICATE KEY UPDATE name=name";
    $stmt = $db->prepare($query);

    foreach ($data as $product) {
        $stmt->bindParam(":name", $product['name']);
        $stmt->bindParam(":price", $product['price']);
        $stmt->bindParam(":description", $product['description']);
        $stmt->execute();
    }
}

$url = "https://example.com/products";  // Example URL
$html = fetchHTML($url);
$data = parseHTML($html);
saveToDatabase($data);

echo "Scraping completed and data saved to database.";
?>
    