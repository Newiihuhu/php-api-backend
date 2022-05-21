<?php
require("../database.php");
$faculty_name = isset($_GET['faculty']) ? $_GET['faculty'] : '';

$query = "SELECT d.DEVICENAME, d.FAVORITE, d.IMAGE, COUNT(d.ITEMSTATUSNAME) as TOTALAVAILABLE
            FROM `devices` as d 
            INNER JOIN `location_name` as ln 
            ON ln.SHORTNAME = d.LOCATIONINITIAL
            WHERE `ITEMSTATUSNAME` = 'Available' AND ln.THNAME = '" . $faculty_name . "' 
            GROUP BY `DEVICENAME`";

$result = $DATABASE->query($query);
$data = "";
while ($row = $result->fetch_array()) {
    $data .= '{
        "id": "' . $row['DEVICENAME'] . '",
        "image": "' . $row["IMAGE"] . '",
        "favorite": "' . $row["FAVORITE"] . '",
        "totalAvailable": "' . $row["TOTALAVAILABLE"] . '",
    },';
}

echo '[' . $data . ']';
