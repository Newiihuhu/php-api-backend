<?php
require("../database.php");

$url_chromebook = "https://opac.kku.ac.th/v2/api/GetItem/b00393863";
$url_lenovo = "https://opac.kku.ac.th/v2/api/GetItem/b00463692";
$url_apple = "https://opac.kku.ac.th/v2/api/GetItem/b00462843";

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
$resp_chromebook = get_data($url_chromebook);
$resp_lenovo = get_data($url_lenovo);
$resp_apple = get_data($url_apple);

$json_chromebook = json_decode($resp_chromebook);
$json_lenovo = json_decode($resp_lenovo);
$json_apple = json_decode($resp_apple);
$query = "";

$clear = "DELETE FROM `devices`";
$clear_result = $DATABASE->query($clear);

for ($i = 0; $i < count($json_chromebook->ItemInfo); $i++) {
    $query = "INSERT INTO `devices`
    (
     `FAVORITE`,
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
    'assets/images/trueChrome.png',
    'Chromebook',
    '" . $json_chromebook->ItemInfo[$i]->ACCESSIONNO . "',
    '" . $json_chromebook->ItemInfo[$i]->BARCODE . "',
    '" . $json_chromebook->ItemInfo[$i]->CALLNO . "',
    '" . $json_chromebook->ItemInfo[$i]->COLLECTIONNAME . "',
    '" . $json_chromebook->ItemInfo[$i]->COPY . "',
    '" . $json_chromebook->ItemInfo[$i]->ITEMCLASSNAME . "',
    '" . $json_chromebook->ItemInfo[$i]->ITEMSTATUSNAME . "',
    '" . $json_chromebook->ItemInfo[$i]->LOCATIONINITIAL . "',
    '" . $json_chromebook->ItemInfo[$i]->UNIT . "')";
    if ($DATABASE->query($query) === FALSE) {
        echo '{
            "status": "error"
        }';
        exit;
    }
}
for ($i = 0; $i < count($json_lenovo->ItemInfo); $i++) {
    $query = "INSERT INTO `devices`
    (
     `FAVORITE`,
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
    'assets/images/v14.jpg',
    'Notebook Lenovo V14',
    '" . $json_lenovo->ItemInfo[$i]->ACCESSIONNO . "',
    '" . $json_lenovo->ItemInfo[$i]->BARCODE . "',
    '" . $json_lenovo->ItemInfo[$i]->CALLNO . "',
    '" . $json_lenovo->ItemInfo[$i]->COLLECTIONNAME . "',
    '" . $json_lenovo->ItemInfo[$i]->COPY . "',
    '" . $json_lenovo->ItemInfo[$i]->ITEMCLASSNAME . "',
    '" . $json_lenovo->ItemInfo[$i]->ITEMSTATUSNAME . "',
    '" . $json_lenovo->ItemInfo[$i]->LOCATIONINITIAL . "',
    '" . $json_lenovo->ItemInfo[$i]->UNIT . "')";
    if ($DATABASE->query($query) === FALSE) {
        echo '{
            "status": "error"
        }';
        exit;
    }
}
for ($i = 0; $i < count($json_apple->ItemInfo); $i++) {
    $query = "INSERT INTO `devices`
    (
     `FAVORITE`,
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
    'assets/images/applePen.png',
    'Apple Pencil gen 1',
    '" . $json_apple->ItemInfo[$i]->ACCESSIONNO . "',
    '" . $json_apple->ItemInfo[$i]->BARCODE . "',
    '" . $json_apple->ItemInfo[$i]->CALLNO . "',
    '" . $json_apple->ItemInfo[$i]->COLLECTIONNAME . "',
    '" . $json_apple->ItemInfo[$i]->COPY . "',
    '" . $json_apple->ItemInfo[$i]->ITEMCLASSNAME . "',
    '" . $json_apple->ItemInfo[$i]->ITEMSTATUSNAME . "',
    '" . $json_apple->ItemInfo[$i]->LOCATIONINITIAL . "',
    '" . $json_apple->ItemInfo[$i]->UNIT . "')";
    if ($DATABASE->query($query) === FALSE) {
        echo '{
            "status": "error"
        }';
        exit;
    }
}

echo '{ 
    "status": "success"
}';
