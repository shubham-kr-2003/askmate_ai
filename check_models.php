<?php
$api_key = "AIzaSyDg5NssNORAmcxFJOtgARqQ8Z5OXJKvVAA";
$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $api_key;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo "<h3>Available Models:</h3>";
echo "<pre>" . htmlspecialchars($response) . "</pre>";
?>
