<?php
require_once('../config.php');
require_once('../functions.php');
//require_once('../funcitons.php');

session_start();
/*
if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}
*/
//櫻間
$user_id = $_SESSION['member']['user_id'];
$user_name = $_SESSION['member']['user_name'];
$user_adm = $_SESSION['member']['adm_user'];
//櫻間
$dbh = get_db_connect();

//櫻間
if(isset($_SESSION)){
    unset($_SESSION['password']);
    unset($_SESSION['insert']);
    unset($_SESSION['update']);
    unset($_SESSION['password_clear']);
    unset($_SESSION['user']);
}
//櫻間

include_once('MENU.php');
?>