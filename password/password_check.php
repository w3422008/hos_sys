<?php
require_once('../functions.php');
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$user_id = $_SESSION['member']['user_id'];
//櫻間
$pw = $_POST['pw'];
$pw3=$_POST['name'];


    $password = array();
    $_SESSION['password']['pw'] = $pw;
    $_SESSION['password']['pw1'] = $pw3;

  //櫻間  

include_once('password_check_view.php');



?>