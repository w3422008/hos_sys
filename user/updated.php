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
//櫻間
//$pw = $_SESSION['user']['pw'];
//櫻間
$adm_user = $_SESSION['user']['adm_user'];


$dbh = get_db_connect();
date_default_timezone_set('Asia/Tokyo');
$date = date("Y/m/d H:i:s");

$up_date = $date;



if(mb_strlen($user_name) !==0){
    update_user_name($dbh,$user_id,$user_name);
}

if(mb_strlen($ins) !==0){
    update_ins($dbh,$user_id,$ins);
}

if(mb_strlen($bel) !==0){
    update_bel($dbh,$user_id,$bel);
}
//櫻間
/*
if($_SESSION['pw'] !== $pw){
    if(mb_strlen($pw) !==0){
        update_pw($dbh,$user_id,$pw);
    }
}
*/
//櫻間
if(mb_strlen($adm_user) !==0){
    update_adm_user($dbh,$user_id,$adm_user);
}

update_up_date($dbh,$user_id,$up_date);

if(isset($_SESSION)){
    unset($_SESSION['user']);
}

include_once('updated_view.php');
?>