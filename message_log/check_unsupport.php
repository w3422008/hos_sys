<?php
require_once('./config.php');
require_once('./functions.php');

$dbh = get_db_connect();
$mes_log = get_message($dbh);


//$check1 = check1($dbh);
//$check2 = check2($dbh);
$check3 = check3($dbh);

//var_dump($_SESSION['message'],$_POST);


//include_once('message_done.php');
//include_once('message_responding.php');
include_once('message_unsupported.php');
?>