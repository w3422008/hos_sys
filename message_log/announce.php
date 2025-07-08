<?php
require_once('functions.php');

$dbh = get_db_connect();

$data = get_announce($dbh);


include_once('announce_view.php');


?>