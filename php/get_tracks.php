<?php

$token = $_GET['token'];
$endpoint = $_GET['endpoint'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $endpoint . '?limit=10');
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
