<?php
require("../database.php");
$email = isset($_GET['email']) ? $_GET['email'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';

$query = "INSERT INTO `account`
(`email`, 
`name`) 
VALUES (
    '" . $email . "',
    '" . $name . "')";

if ($DATABASE->query($query) === FALSE) {
    echo '{
            "status": "error"
        }';
    exit;
} else {
    echo '{
            "status": "success"
        }';
}
