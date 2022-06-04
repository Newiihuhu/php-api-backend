<?php
require("../database.php");

$email = isset($_GET['email']) ? $_GET['email'] : '';

$query = "SELECT * FROM `account` WHERE `email` = '" . $email . "'";

$result = $DATABASE->query($query);
$row = $result->fetch_assoc();
$data = '{
    "email": "' . $row['email'] . '",
    "name": "' . $row['name'] . '"
}';

if ($DATABASE->query($query) === FALSE) {
    echo '{
            "status": "error"
        }';
    exit;
} else {
    echo $data;
}
