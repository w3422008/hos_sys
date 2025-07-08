<?php
require_once('../functions.php');
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$user_id = $_SESSION['member']['user_id'];

$pw = $_SESSION['password']['pw'];
$pw3 = $_SESSION['password']['pw1'];


$dbh = get_db_connect();
date_default_timezone_set('Asia/Tokyo');
$date = date("Y/m/d H:i:s");

$up_date = $date;


//if($_SESSION['password']['pw'] !== $pw){
    //if(mb_strlen($pw) !==0){
        update_pw($dbh,$user_id,$pw);
    //}
//}
//櫻間
update_up_date($dbh,$user_id,$up_date);

if(isset($_SESSION)){
    unset($_SESSION['password']);
}



include_once('password_compleated_view.php');
?>
