<?php
//櫻間
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$user_adm = $_SESSION['member']['adm_user'];
require_once('../functions.php');
$user_id = $_GET['id'];

$dbh = get_db_connect();

$data = get_data1($dbh,$user_id);

include_once('undoing_view.php');
?>