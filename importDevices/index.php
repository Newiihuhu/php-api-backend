<?php
require("../database.php");

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

$clear = "DELETE FROM `devices`";
$clear_result = $DATABASE->query($clear);
$get_bib_id_and_name = "SELECT * FROM `devices_on_app`";
$result = $DATABASE->query($get_bib_id_and_name);
while ($row = $result->fetch_array()) {
    $url = "https://opac.kku.ac.th/v2/api/GetItem/" . $row['BIBID'];
    $url_image = "https://opac.kku.ac.th/v2/api/GetBookCover/" . $row['BIBID'];
    $response = get_data($url);
    $response_image = get_data($url_image);
    $json = json_decode($response);
    $json_image = json_decode($response_image);

    for ($i = 0; $i < count($json->ItemInfo); $i++) {
        $query = "INSERT INTO `devices`
    (
        `BIBID`,
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
        '" . $row['BIBID'] . "',
    0,
    '" . $json_image . "',
    '" . $row['DEVICENAME'] . "',
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
}
