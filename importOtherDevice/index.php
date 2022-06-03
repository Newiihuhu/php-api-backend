<?php
header('Content-Type: application/json ; charset=utf-8');
require("../database.php");

$bib_id = isset($_GET['bib_id']) ? $_GET['bib_id'] : '';
$device_name = isset($_GET['device_name']) ? $_GET['device_name'] : '';
$accession = isset($_GET['accession']) ? $_GET['accession'] : '';
$duration = isset($_GET['duration']) ? $_GET['duration'] : '';

$query = "INSERT INTO `devices_on_app`
(`BIBID`, `DEVICENAME`, `ACCESSION`, `DURATION`, `UNLOCKDEVICE`) 
VALUES (
    '" . $bib_id . "',
    '" . $device_name . "',
    '" . $accession . "',
    '" . $duration . "',
    '0')";

$result = $DATABASE->query($query);
