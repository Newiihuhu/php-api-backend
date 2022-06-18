<?php
header('Content-Type: application/json ; charset=utf-8');
require("../database.php");
$device_name = isset($_GET['device']) ? $_GET['device'] : '';

$query = "SELECT DISTINCT d.DEVICENAME, d.FAVORITE, d.LOCATIONINITIAL, ln.THNAME, da.DURATION, da.ACCESSION, ln.COLORCODE
            FROM `devices` as d 
            INNER JOIN `location_name` as ln 
            ON d.LOCATIONINITIAL = ln.SHORTNAME 
            INNER JOIN `devices_on_app` as da
            ON d.DEVICENAME = da.DEVICENAME
            WHERE d.DEVICENAME = '" . $device_name . "' AND d.ITEMSTATUSNAME = 'Available' 
            ORDER BY ln.THNAME ASC;";

$queryTotalLocation = "SELECT ln.THNAME, COUNT(d.`LOCATIONINITIAL`) as TOTALLOCATION
            FROM `devices` as d 
            INNER JOIN `location_name` as ln
            ON d.LOCATIONINITIAL = ln.SHORTNAME
            WHERE d.DEVICENAME = '" . $device_name . "' AND d.ITEMSTATUSNAME = 'Available'
            GROUP BY ln.THNAME  
            ORDER BY `ln`.`THNAME`  ASC";

$result = $DATABASE->query($query);
$result2 = $DATABASE->query($query);
$resultTotalLocation = $DATABASE->query($queryTotalLocation);

$row = $result->fetch_assoc();
$first_data = '
    "id": "' . $row['DEVICENAME'] . '",
    "favorite": "' . $row["FAVORITE"] . '",
    "description":  "' . $row['DEVICENAME'] . '",
    "accession": "' . $row['ACCESSION'] . '",
    "duration": "' . $row["DURATION"] . '",
    "location": ';

$second_data = "";
$third_data = "";
while ($row2 = $result2->fetch_array()) {
    $rowTotalLocation = $resultTotalLocation->fetch_array();
    if ($row2['THNAME'] == "หอสมุดกลาง" || $rowTotalLocation['THNAME'] == "หอสมุดกลาง") {
        $second_data .= '{
                "shortName": "' . $row2['LOCATIONINITIAL'] . '",
                "locationName": "' . $row2['THNAME'] . '",
                "count": "' . $rowTotalLocation['TOTALLOCATION'] . '",
                "colorCode": "' . $row2['COLORCODE'] . '"
            },';
    }
    if ($row2['THNAME'] !== "หอสมุดกลาง" || $rowTotalLocation['THNAME'] !== "หอสมุดกลาง") {
        $third_data .= '{
                "shortName": "' . $row2['LOCATIONINITIAL'] . '",
                "locationName": "' . $row2['THNAME'] . '",
                "count": "' . $rowTotalLocation['TOTALLOCATION'] . '",
                "colorCode": "' . $row2['COLORCODE'] . '"
            },';
    }
}


echo '{' . $first_data . '[' . $second_data . substr($third_data, 0, -1) . ']' . '}';
