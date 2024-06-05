<?php
$language = isset($_GET['language']) ? $_GET['language'] : 13;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 100;
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

$url = 'https://wger.de/api/v2/exercisebaseinfo/?language=' . $language . '&limit=' . $limit . '&offset=' . $offset;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$headers = array();
$headers[] = 'Authorization: Token ' . '62e95f2d76b4aefd161d1f16cd487a5bb3ad3db0';
$headers[] = 'Accept: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

echo $result;
?>
