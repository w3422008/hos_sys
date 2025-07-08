<?php
//櫻間
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

//櫻間
$user_adm = $_SESSION['member']['adm_user'];
require_once('../functions.php');


$user_id = $_GET['sid'];

$dbh = get_db_connect();

$data = deletion_user($dbh,$user_id);

include_once('deleated_view.php');
?>