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



$dbh = get_db_connect();

$data = result2($dbh);

include_once('hide_hos_view.php');
?>

