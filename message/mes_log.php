<?php
require_once('../config.php');
require_once('../functions.php');

if(empty($_SESSION['message']['add']) && empty($_SESSION['message']['delete']) && empty($_SESSION['back']) && empty($_SESSION['message']['display']) && empty($_SESSION['message']['update']) && empty($_SESSION['back_add'])){
    session_start();
}

$dbh = get_db_connect();
$mes_log = get_message($dbh);


//三宅20231226 エラー対策(delete,chengeから戻った時)
if(isset($_SESSION['message']['add'])){
    $_SESSION['message'] = null;
}
if(isset($_SESSION['message']['delete'])){
    $_SESSION['message'] = null;
}
if(isset($_SESSION['message']['update'])){
    $_SESSION['message'] = null;
}if(isset($_SESSION['message']['display'])){
    $_SESSION['message'] = null;
}if(empty($_SESSION['back_add'])){
    $view = '1';
}if(isset($_SESSION['back_add'])){
    $_SESSION['back_add'] = null;
}





include_once('./message_view/mes_log_view.php');
?>