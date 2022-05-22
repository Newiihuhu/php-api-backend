<?php
require("../database.php");

$email = isset($_GET['email']) ? $_GET['email'] : '';
$password = isset($_GET['password']) ? $_GET['password'] : '';

$query = "SELECT * FROM `account` WHERE `email` = '".$email."' AND `password` = '".$password."' ";

$result = $DATABASE->query($query);
$row = $result->fetch_assoc();
$data = '{
    "id": "' . $row['id']. '",
    "email": "' . $row['email']. '",
    "password": "' . $row['password']. '",
    "name": "' . $row['name']. '",
    "phoneNo": "' . $row['phone_number']. '",
    "access": "' . $row['access']. '",
    "status": "' . $row['status']. '" 
}';

    if ($DATABASE->query($query) === FALSE) {
        echo '{
            "status": "error"
        }';
        exit;
    } else {
        echo $data 
            
    ;
    }




