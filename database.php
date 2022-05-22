<?php
$DATABASE = mysqli_connect("localhost", "root", "", "checkforborrow_db");
mysqli_set_charset($DATABASE, "utf8");
if ($DATABASE->connect_error) {
    echo die("Connection failed: " . $DATABASE->connect_error);
}
