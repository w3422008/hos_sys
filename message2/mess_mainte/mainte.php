<?php
require_once('../../config.php');
require_once('../../functions.php');

if(empty($_SESSION['maintenance']['add']) && empty($_SESSION['back']) ){
    session_start();
}

if(isset($_SESSION['maintenance']['add'])){
    $_SESSION['maintenance'] = null;
    $_SESSION['maintenance']['add'] = null;
}
if(isset($_SESSION['back'])){
    $_SESSION['back'] = null;
}

$dbh = get_db_connect();
$mes_mainte = get_maintenance($dbh);

if(isset($mes_mainte)){
$title = $mes_mainte[0]['title'];
$upload_date = $mes_mainte[0]['upload_date'];
$date = $mes_mainte[0]['date'];
$start_time = $mes_mainte[0]['s_time'];
$end_time = $mes_mainte[0]['e_time'];
$comment = $mes_mainte[0]['comment'];
$view = $mes_mainte[0]['view'];
}else{
$title = '';
$upload_date = '';
$date = '';
$start_time = '';
$end_time = '';
$comment = '';
$view = '';
}

include_once("./mainte_view/mainte_view.php");
?>