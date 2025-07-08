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

$user_id = $_GET['id'];
$dbh = get_db_connect();
$onf = 0;
update_onf($dbh,$user_id,$onf);


date_default_timezone_set('Asia/Tokyo');
$date = date("Y/m/d H:i:s");

$up_date = $date;

update_up_date($dbh,$user_id,$up_date);

include_once('undid_view.php');
?>