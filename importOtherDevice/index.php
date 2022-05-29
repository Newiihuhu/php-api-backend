<?php
require("../database.php");

$bib_id = isset($_GET['bib_id']) ? $_GET['bib_id'] : '';
$accession = isset($_GET['accession']) ? $_GET['accession'] : '';

$url = "https://opac.kku.ac.th/v2/api/GetItem/" . $bib_id;

function get_data($url)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "token: 8JEb0/FKBS9B10Y0zfzMw4ars7b2dhaV3AG7Op0fVqenC9mpCoJtbIn7jUSN8eDJNeteoLxelIgzyYGFy/t7KKVANa375rcg2ORDcczF/BQ=",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}

$response = get_data($curl);
$json = json_decode($response);
for ($i = 0; $i < count($json->ItemInfo); $i++) {
    $query = "INSERT INTO `devices`
    (
     `FAVORITE`,
     `UNLOCKDEVICE`,
     `IMAGE`,
     `DEVICENAME`,
     `ACCESSIONNO`,
     `BARCODE`,
     `CALLNO`,
     `COLLECTIONNAME`,
     `COPY`,
     `ITEMCLASSNAME`,
     `ITEMSTATUSNAME`,
     `LOCATIONINITIAL`,
     `UNIT`) 
    VALUES (
        0,
    0,
    'assets/images/trueChrome.png',
    'Chromebook',
    '" . $json->ItemInfo[$i]->ACCESSIONNO . "',
    '" . $json->ItemInfo[$i]->BARCODE . "',
    '" . $json->ItemInfo[$i]->CALLNO . "',
    '" . $json->ItemInfo[$i]->COLLECTIONNAME . "',
    '" . $json->ItemInfo[$i]->COPY . "',
    '" . $json->ItemInfo[$i]->ITEMCLASSNAME . "',
    '" . $json->ItemInfo[$i]->ITEMSTATUSNAME . "',
    '" . $json->ItemInfo[$i]->LOCATIONINITIAL . "',
    '" . $json->ItemInfo[$i]->UNIT . "')";
    if ($DATABASE->query($query) === FALSE) {
        echo '{
            "status": "error"
        }';
        exit;
    }
}
