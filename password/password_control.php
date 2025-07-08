<?php
require_once('../functions.php');

session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

/*
if(isset($_SESSION)){ 
    $pw=$_SESSION['pw'];
    $pw1=$_SESSION['pw1'];
}
*/
$user_id = $_SESSION['member']['user_id'];
//櫻間
if(isset($_SESSION['password'])){		
    $pw1 = $_SESSION['password']['pw'];	
    $pw4= $_SESSION['password']['pw1'];	

    }


$dbh = get_db_connect();

$data = get_data1($dbh,$user_id);

include_once('password_view.php');
