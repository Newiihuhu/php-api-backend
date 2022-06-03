<?php
header('Content-Type: application/json ; charset=utf-8');
require("../../database.php");
$device_name = isset($_GET['device']) ? $_GET['device'] : '';
$unlock = isset($_GET['unlock']) ? $_GET['unlock'] : '';

$query = "UPDATE `devices_on_app` SET `UNLOCKDEVICE`='" . $unlock . "' WHERE `DEVICENAME`='" . $device_name . "'";
$result = $DATABASE->query($query);
echo '{
    "status": "update success"
}';
