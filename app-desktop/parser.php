<?php

use Illuminate\Support\Facades\Http;

$response = Http::get('https://www.imdb.com/search/title/?title_type=feature', [
    //'name' => 'Taylor',
]);

$rules = [
    'name' => 'regex:/<h2 class="block-header">(.*?)<\/h2>/'
];

preg_match($rules['name'], $response, $match);

echo $match;

/*$curl = curl_init();

//$url = "https://www.imdb.com/search/title/?title_type=feature";
$url = "https://vc.ru/niksolovov/1150689-parser-vk-8-servisov-parsinga-druzei-grupp-nomerov-2024";

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST , false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

$result = curl_exec($curl);

$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
echo 'HTTP code: ' . $httpcode;

//$res = preg_match_all('/<div class="ipc-html-content-inner-div" role="presentation">(.*?)<\/div>/', $result, $match);
$res = preg_match('/<h2 class="block-header">(.*?)<\/h2>/', $result, $match);

echo $res;
echo $match[1];*/

