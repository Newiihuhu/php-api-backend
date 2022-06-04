<?php
header('Content-Type: application/json ; charset=utf-8');
require("../database.php");

$query = 'SELECT `email`, `name`
            FROM `account`';
$result = $DATABASE->query($query);
$data = "";
while ($row = $result->fetch_array()) {
    $data .= '{
        "email": "' . $row['email'] . '",
        "name": "' . $row["name"] . '"
    },';
}

echo '[' . substr($data, 0, -1) . ']';
