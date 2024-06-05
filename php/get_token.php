<?php
// get_token.php

$clientID = 'ab44cf466d404c1194e90a7b7cd56e2f';
$secretKey = 'c9fe4d2f6b8d433e8f25294f86b26c2c';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Basic ' . base64_encode($clientID . ':' . $secretKey),
    'Content-Type: application/x-www-form-urlencoded'
));

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

echo $result;
?>
