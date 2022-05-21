<?php
$DATABASE = mysqli_connect("localhost", "root", "", "id18953963_kku_db");
mysqli_set_charset($DATABASE, "utf8");
if ($DATABASE->connect_error) {
    echo die("Connection failed: " . $DATABASE->connect_error);
}
