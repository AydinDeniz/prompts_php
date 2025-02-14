
<?php
include_once '../config/config.php';

function fetchFacebookPosts() {
    $url = "https://graph.facebook.com/v12.0/me/posts?access_token=" . FACEBOOK_ACCESS_TOKEN;
    return json_decode(file_get_contents($url), true);
}

function fetchTwitterPosts() {
    $url = "https://api.twitter.com/2/tweets?ids=your_twitter_user_id";
    $auth = base64_encode(TWITTER_API_KEY . ":" . TWITTER_API_SECRET);
    
    $context = stream_context_create([
        "http" => [
            "header" => "Authorization: Basic " . $auth
        ]
    ]);

    return json_decode(file_get_contents($url, false, $context), true);
}

function fetchInstagramPosts() {
    $url = "https://graph.instagram.com/me/media?fields=id,caption,media_url&access_token=" . INSTAGRAM_ACCESS_TOKEN;
    return json_decode(file_get_contents($url), true);
}

$response = [
    "facebook" => fetchFacebookPosts(),
    "twitter" => fetchTwitterPosts(),
    "instagram" => fetchInstagramPosts()
];

header('Content-Type: application/json');
echo json_encode($response);
?>
    