<?php
header('Content-Type: application/json ; charset=utf-8');
require("../database.php");
$faculty_name = isset($_GET['faculty']) ? $_GET['faculty'] : '';

$query = "SELECT DISTINCT d.DEVICENAME, d.FAVORITE, d.IMAGE, da.DURATION
            FROM `devices` as d 
            INNER JOIN `location_name` as ln 
            ON ln.SHORTNAME = d.LOCATIONINITIAL
            INNER JOIN `devices_on_app` as da
            ON d.DEVICENAME = da.DEVICENAME
            WHERE d.ITEMSTATUSNAME = 'Available' AND ln.THNAME = '" . $faculty_name . "' AND da.UNLOCKDEVICE = 1";

$queryTotalAvailable = "SELECT COUNT(d.`DEVICENAME`) as TOTALAVAILABLE
            FROM `devices` as d 
            INNER JOIN `location_name` as ln 
            ON ln.SHORTNAME = d.LOCATIONINITIAL
            INNER JOIN `devices_on_app` as da
            ON d.DEVICENAME = da.DEVICENAME
            WHERE d.ITEMSTATUSNAME = 'Available' AND ln.THNAME = '" . $faculty_name . "' AND da.UNLOCKDEVICE = 1
            GROUP BY d.BIBID";

$result = $DATABASE->query($query);
$resultTotalAvailable = $DATABASE->query($queryTotalAvailable);
$data = "";
while ($row = $result->fetch_array()) {
    $rowTotalAvailable = $resultTotalAvailable->fetch_array();
    $data .= '{
        "id": "' . $row['DEVICENAME'] . '",
        "image": "' . $row["IMAGE"] . '",
        "favorite": "' . $row["FAVORITE"] . '",
        "duration": "' . $row["DURATION"] . '",
        "totalAvailable": "' . $rowTotalAvailable["TOTALAVAILABLE"] . '"
    },';
}

echo '[' . substr($data, 0, -1) . ']';
