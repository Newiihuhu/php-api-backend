<?php
header('Content-Type: application/json ; charset=utf-8');
require("../database.php");

$query = 'SELECT d.DEVICENAME, d.FAVORITE, da.DURATION, d.IMAGE, COUNT(d.ITEMSTATUSNAME) as TOTALAVAILABLE 
FROM `devices` as d 
INNER JOIN `devices_on_app` as da
ON d.DEVICENAME = da.DEVICENAME
WHERE d.ITEMSTATUSNAME = "Available" AND d.FAVORITE = 1 
GROUP BY d.DEVICENAME';

$result = $DATABASE->query($query);
$data = "";
while ($row = $result->fetch_array()) {
    $data .= '{
        "id": "' . $row['DEVICENAME'] . '",
        "image": "' . $row["IMAGE"] . '",
        "favorite": "' . $row["FAVORITE"] . '",
        "duration": "' . $row["DURATION"] . '",
        "totalAvailable": "' . $row["TOTALAVAILABLE"] . '"
    },';
}

echo '[' . substr($data, 0, -1) . ']';
