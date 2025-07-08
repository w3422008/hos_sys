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

$dbh = get_db_connect();
$onf = 0;
update_onf1($dbh,$hos_cd,$onf);

include_once('undid_view.php');
?>