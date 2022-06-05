<?php
header('Content-Type: application/json ; charset=utf-8');
require("../database.php");
$bib_id = isset($_GET['bib_id']) ? $_GET['bib_id'] : '';

$query = "SELECT `BIBID`, `CALLNO` FROM `devices` WHERE BIBID = '" . $bib_id . "'";
$result = $DATABASE->query($query);

$device_name = $result->fetch_array()['CALLNO'];
$bib_id = $result->fetch_array()['BIBID'];

echo '{
    "bib_id": "' . $bib_id . '",
    "device_name": "' . $device_name . '"
}';
