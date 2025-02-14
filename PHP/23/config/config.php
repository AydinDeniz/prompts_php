
<?php
session_start();

function loadLanguage($lang) {
    $file = __DIR__ . "/../languages/$lang.json";
    if (file_exists($file)) {
        return json_decode(file_get_contents($file), true);
    }
    return json_decode(file_get_contents(__DIR__ . "/../languages/en.json"), true);
}

$lang = $_SESSION['lang'] ?? 'en';
$translations = loadLanguage($lang);
?>
    