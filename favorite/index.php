<?php
require("../database.php");

$query = "SELECT `DEVICENAME`, `FAVORITE`, `IMAGE`, COUNT(`ITEMSTATUSNAME`) as TOTALAVAILABLE 
            FROM `devices` 
            WHERE `ITEMSTATUSNAME` = 'Available' AND `FAVORITE` = 1 
            GROUP BY `DEVICENAME`";

$result = $DATABASE->query($query);
$data = "";
while ($row = $result->fetch_array()) {
    $data .= '{
        "id": "' . $row['DEVICENAME'] . '",
        "image": "' . $row["IMAGE"] . '",
        "favorite": "' . $row["FAVORITE"] . '",
        "totalAvailable": "' . $row["TOTALAVAILABLE"] . '"
    },';
}

echo '[' . substr($data, 0, -1) . ']';
