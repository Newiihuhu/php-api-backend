<?php
require("../../database.php");
$email = isset($_GET['email']) ? $_GET['email'] : '';

$query = "DELETE FROM `account` WHERE `email` = '" . $email . "'";
$result = $DATABASE->query($query);

if ($result === FALSE) {
    echo '{
    "status": "error"
}';
    exit;
}
