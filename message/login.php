<?php

require_once('../config.php');
session_start();

$adm_user = $_SESSION['member']['adm_user'];

if(!isset($_SESSION['member']) || $adm_user != 3){
    header('Location:'.SITE_URL.'/index.php');
    exit;
}

header('Location:'.SITE_URL.'message/mes_log.php');
exit;


