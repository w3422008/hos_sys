<?php
require_once('../config.php');
require_once('../functions.php');


session_start();

$id = $_GET['id'];

$dbh = get_db_connect();
$display_data = get_select_message($dbh,$id);

$_SESSION['message']['id'] = $id;
$_SESSION['message']['view'] = $display_data[0]['view'];

/*
$_SESSION['message']['situation'] = $situation;
$_SESSION['message']['req_fac'] = $req_fac;
$_SESSION['message']['req_dep'] = $req_dep;
$_SESSION['message']['date'] = $date;
$_SESSION['message']['comment'] = $comment;
   */



include_once('./message_view/mes_display_view.php');
?>