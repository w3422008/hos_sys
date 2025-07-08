<?php
require_once('../functions.php');

session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$user_id = $_SESSION['user']['user_id'];
$user_name = $_SESSION['user']['user_name'];
$ins = $_SESSION['user']['ins'];
$bel = $_SESSION['user']['bel'];
$pw = $_SESSION['user']['pw'];
$adm_user = $_SESSION['user']['adm_user'];
$dbh = get_db_connect();
date_default_timezone_set('Asia/Tokyo');
$date = date("Y/m/d H:i:s");

$start = $date;
$end = "";

//嶋津	
$onf = 0;	
$up_date = "";	



$data = insert_user($dbh,$user_id,$user_name,$ins,$bel,$pw,$adm_user,$start,$end,$onf,$up_date);


if(isset($_SESSION)){
    unset($_SESSION['user']);
}

include_once('completion_view.php');
?>