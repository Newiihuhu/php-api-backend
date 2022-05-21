<?php
require("../../database.php");
$device_name = isset($_GET['device']) ? $_GET['device'] : '';
$favorite = isset($_GET['favorite']) ? $_GET['favorite'] : '';

$query = "UPDATE `devices` SET `FAVORITE`='" . $favorite . "' WHERE `DEVICENAME` = '" . $device_name . "'";
$result = $DATABASE->query($query);
echo '{
    "status": "update success"
}';
