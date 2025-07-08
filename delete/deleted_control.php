<?php


//櫻間
session_start();
require_once('../functions.php');

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

//櫻間
$user_adm = $_SESSION['member']['adm_user'];

$hos_cd = $_GET['sid'];

$hos_name = $_GET['sname'];

$dbh = get_db_connect();

$data = deletion_user1($dbh,$hos_cd);

$data = deletion_user2($dbh,$hos_cd);

$data = deletion_user3($dbh,$hos_cd);

$data = deletion_user4($dbh,$hos_cd); //高橋20230704 診療内容削除用


$user_id = $_SESSION['member']['user_id'];
$dbh = get_db_connect();
//櫻間20230511
    $user_adm = $_SESSION['member']['adm_user'];
    $datetime = date('Y-m-d H:i:s');
    $insert_log=$datetime;
    $data=delete_userlog($dbh,$user_id);
    foreach($data as $key => $var):
    $user_name=$var['user_name'];
    $ins=$var['ins'];
    $bel=$var['bel'];
    $adm_user=$var['adm_user']; 
endforeach; 

//delete_log
//嶋津20230518
delete_log($dbh,$hos_cd,$hos_name,$insert_log,$user_name,$user_id,$ins,$bel,$adm_user);

include_once('deleted_view.php');
?>