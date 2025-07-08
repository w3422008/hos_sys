<?php
//櫻間
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$user_adm = $_SESSION['member']['adm_user'];

if(isset($_SESSION)){
    unset($_SESSION['insert']);
}

include_once('manage_view.php');
?>