<?php
$DATABASE = mysqli_connect("localhost", "admin", "H&^fg567Hk", "check_borrow_db");
mysqli_set_charset($DATABASE, "utf8");
if ($DATABASE->connect_error) {
    echo die("Connection failed: " . $DATABASE->connect_error);
}
