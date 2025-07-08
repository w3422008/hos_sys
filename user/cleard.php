<?php
require_once('../functions.php');
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$user_id = $_SESSION['password_clear']['id'];
$pw = $_SESSION['password_clear']['pw'];



$dbh = get_db_connect();
date_default_timezone_set('Asia/Tokyo');
$date = date("Y/m/d H:i:s");

$up_date = $date;

        update_pw($dbh,$user_id,$pw);
//櫻間
update_up_date($dbh,$user_id,$up_date);


if(isset($_SESSION['password_clear'])){
    unset($_SESSION['password_clear']);
}



include_once('cleard_view.php');
?>
