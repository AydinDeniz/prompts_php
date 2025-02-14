
<?php
$api_url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,cardano&vs_currencies=usd";
$response = file_get_contents($api_url);
header('Content-Type: application/json');
echo $response;
?>
    