<?php
header('Content-Type: application/json ; charset=utf-8');
require("../../database.php");
$bib_id = isset($_GET['bib_id']) ? $_GET['bib_id'] : '';
$device_name = isset($_GET['device_name']) ? $_GET['device_name'] : '';
$accession = isset($_GET['accession']) ? $_GET['accession'] : '';
$duration = isset($_GET['duration']) ? $_GET['duration'] : '';


$query = "UPDATE `devices_on_app` 
            SET `BIBID`= '" . $bib_id . "',
            `DEVICENAME`='" . $device_name . "',
            `ACCESSION`='" . $accession . "',
            `DURATION`='" . $duration . "' 
            WHERE `BIBID` = '" . $bib_id . "'";
$query1 = "UPDATE `devices` 
            SET `DEVICENAME`='" . $device_name . "' 
            WHERE `BIBID` = '" . $bib_id . "'";

$result = $DATABASE->query($query);
$result1 = $DATABASE->query($query1);
echo '{
    "status": "update success"
}';
