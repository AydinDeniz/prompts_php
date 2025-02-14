
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->url)) {
        $output = shell_exec("python3 ../scripts/web_scraper.py " . escapeshellarg($data->url));
        echo json_encode(["message" => "Scraping completed", "summary" => json_decode($output)]);
    }
}
?>
    