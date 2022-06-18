<?php
header('Content-Type: application/json ; charset=utf-8');
require("../database.php");

$query = 'SELECT DISTINCT d.DEVICENAME, d.FAVORITE, da.DURATION, d.IMAGE
            FROM `devices` as d 
            INNER JOIN `devices_on_app` as da
            ON d.DEVICENAME = da.DEVICENAME
            WHERE d.ITEMSTATUSNAME = "Available" AND d.FAVORITE = 1';
$queryTotal = 'SELECT COUNT(d.`DEVICENAME`) as TOTALAVAILABLE
            FROM `devices` as d 
            INNER JOIN `devices_on_app` as da
            ON d.DEVICENAME = da.DEVICENAME
            WHERE d.ITEMSTATUSNAME = "Available" AND d.FAVORITE = 1
            GROUP BY d.BIBID';

$result = $DATABASE->query($query);
$resultTotal = $DATABASE->query($queryTotal);
$data = "";
while ($row = $result->fetch_array()) {
    $rowTotal = $resultTotal->fetch_array();
    $data .= '{
        "id": "' . $row['DEVICENAME'] . '",
        "image": "' . $row["IMAGE"] . '",
        "favorite": "' . $row["FAVORITE"] . '",
        "duration": "' . $row["DURATION"] . '",
        "totalAvailable": "' . $rowTotal["TOTALAVAILABLE"] . '"
    },';
}

echo '[' . substr($data, 0, -1) . ']';
