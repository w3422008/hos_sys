<?php
require_once('../../config.php');
require_once('../../functions.php');

if(empty($_SESSION['maintenance_start']['add']) && empty($_SESSION['start_back']) ){
    session_start();
}

if(isset($_SESSION['maintenance_start']['add'])){
    $_SESSION['maintenance_start'] = null;
    $_SESSION['maintenance_start']['add'] = null;
}
if(isset($_SESSION['start_back'])){
    $_SESSION['start_back'] = null;
}

$dbh = get_db_connect();
$mes_mainte_start = get_maintenance_start($dbh);



if(isset($mes_mainte_start[0])){
$title = $mes_mainte_start[0]['title'];
$comment = $mes_mainte_start[0]['comment'];;
$date = $mes_mainte_start[0]['date'];
$start_time = $mes_mainte_start[0]['s_time'];
$end_time = $mes_mainte_start[0]['e_time'];
$comment2 = $mes_mainte_start[0]['comment2'];
$view = $mes_mainte_start[0]['view'];
}else{
$title = "";
$comment = "";
$date = "";
$start_time = "";
$end_time = "";
$comment2 = "";
$view = "";
}

include_once("./mainte_view/mainte_view.php");
?>