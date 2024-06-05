<?php
// get_categories.php

$token = $_GET['token'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/browse/categories');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token
));

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

echo $result;
?>
