<?php
//櫻間0801
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$user_adm = $_SESSION['member']['adm_user'];

include_once('all_download_view.php');
//櫻間20230801
?>