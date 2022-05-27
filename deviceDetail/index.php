<?php
require("../database.php");
$device_name = isset($_GET['device']) ? $_GET['device'] : '';

$query = "SELECT d.DEVICENAME, d.FAVORITE, d.LOCATIONINITIAL, COUNT(d.LOCATIONINITIAL) as COUNTLOCATION, ln.THNAME 
            FROM `devices` as d 
            INNER JOIN `location_name` as ln 
            ON d.LOCATIONINITIAL = ln.SHORTNAME 
            WHERE d.DEVICENAME = '" . $device_name . "' AND d.ITEMSTATUSNAME = 'Available' 
            GROUP BY d.LOCATIONINITIAL 
            ORDER BY ln.THNAME ASC";

$result = $DATABASE->query($query);
$result2 = $DATABASE->query($query);
$row = $result->fetch_assoc();
$first_data = '
    "id": "' . $row['DEVICENAME'] . '",
    "favorite": "' . $row["FAVORITE"] . '",
    "description":  "' . $row['DEVICENAME'] . '",
    "accession": " ",
    "location": ';

$second_data = "";
$third_data = "";
while ($row2 = $result2->fetch_array()) {
    if ($row2['THNAME'] == "หอสมุดกลาง") {
        $second_data .= '{
                "shortName": "' . $row2['LOCATIONINITIAL'] . '",
                "locationName": "' . $row2['THNAME'] . '",
                "count": "' . $row2['COUNTLOCATION'] . '"
            },';
    }
    if ($row2['THNAME'] !== "หอสมุดกลาง") {
        $third_data .= '{
                "shortName": "' . $row2['LOCATIONINITIAL'] . '",
                "locationName": "' . $row2['THNAME'] . '",
                "count": "' . $row2['COUNTLOCATION'] . '"
            },';
    }
}


echo '{' . $first_data . '[' . $second_data . substr($third_data, 0, -1) . ']' . '}';
