<?php

ob_start();
ini_set('max_execution_time', 0);

include('../functions/functions.php');


if (!isset($_POST['query']) && !isset($_POST['page']) && !isset($_POST['api-token'])) {
    die('invalid access.00');
}
elseif (empty($_POST['query']) || empty($_POST['api-token']) || empty($_POST['page'])) {
    die('invalid access.01');
}
elseif (!is_int($_POST['page']) && $_POST['api-token'] !== "2468543210nuralam543210") {
    die('invalid access.02');
}


// $query = str_replace(" ", "+", htmlspecialchars(trim($_POST['query'])));
$query = urlencode(trim($_POST['query']));

$offset = ($_POST['page']-1)*60;
$count = 60;

$url = "https://in.video.search.yahoo.com/search/video?p=".$query."&fr=yfp-t-s&o=js&gs=0&_partner=&fr2=p:s,v:v&b=".$offset."&iid=Y.1&ig=0acf871ece7640bc9a000000009e52a0&n=".$count;

$options = [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HEADER         => 0,
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_ENCODING       => '',
                CURLOPT_COOKIEFILE     => '',
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.72 Safari/537.36',
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
            ];

$ch = curl_init($url);
curl_setopt_array($ch, $options);
$json_data = curl_exec($ch);
curl_close ($ch);

if (isJson($json_data)) {

    header('Content-Type: application/json');
    echo $json_data;
}
else{
    echo "yahoo error";
}