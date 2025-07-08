<?php
//櫻間
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

//櫻間
$user_adm = $_SESSION['member']['adm_user'];
require_once('../functions.php');

$user_id = $_GET['sid'];
$dbh = get_db_connect();
$onf = 1;
update_onf($dbh,$user_id,$onf);

date_default_timezone_set('Asia/Tokyo');
$date = date("Y/m/d H:i:s");

$end = $date;
update_end($dbh,$user_id,$end);

include_once('switch_view.php');
?>