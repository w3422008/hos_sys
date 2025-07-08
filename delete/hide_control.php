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

$data = detail($dbh,$hos_cd);

include_once('hide_view.php');
?>

