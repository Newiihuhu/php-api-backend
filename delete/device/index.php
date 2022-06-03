<?php
require("../../database.php");
$bib_id = isset($_GET['bib_id']) ? $_GET['bib_id'] : '';

$query = "DELETE FROM `devices_on_app` WHERE `BIBID` = '" . $bib_id . "'";
$result = $DATABASE->query($query);

if ($result === FALSE) {
    echo '{
    "status": "error"
}';
    exit;
}
