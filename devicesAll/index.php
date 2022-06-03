<?php
header('Content-Type: application/json ; charset=utf-8');
require("../database.php");

$query = 'SELECT da.DURATION as DURATION, d.IMAGE as IMAGE, da.BIBID as BIBID, da.ACCESSION as ACCESSION, da.DEVICENAME as DEVICENAME, da.UNLOCKDEVICE as UNLOCKDEVICE
            FROM `devices` as d 
            INNER JOIN `devices_on_app` as da
            ON d.DEVICENAME = da.DEVICENAME
            WHERE `ITEMSTATUSNAME` = "Available"
            GROUP BY `DEVICENAME`';
$result = $DATABASE->query($query);
$data = "";
while ($row = $result->fetch_array()) {
    $data .= '{
        "bib_id": "' . $row['BIBID'] . '",
        "device_name": "' . $row["DEVICENAME"] . '",
        "image": "' . $row["IMAGE"] . '",
        "accession": "' . $row["ACCESSION"] . '",
        "duration": "' . $row["DURATION"] . '",
        "unlock": "' . $row["UNLOCKDEVICE"] . '"
    },';
}

echo '[' . substr($data, 0, -1) . ']';
