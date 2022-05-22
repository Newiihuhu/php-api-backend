<?php
require("../database.php");
$id = isset($_GET['id']) ? $_GET['id'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';
$phone_number = isset($_GET['phone_number']) ? $_GET['phone_number'] : '';
$name = isset($_GET['name']) ? $_GET['name'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$access = isset($_GET['access']) ? $_GET['access'] : '';

$query = "INSERT INTO `account`
(`id`, 
`email`, 
`password`, 
`name`, 
`phone_number`, 
`status`, `access`) 
VALUES (
    '".$id."',
    '".$email."',
    '".$password."',
    '".$name."',
    '".$phone_number."',
    '".$status."',
    '".$access."')";

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