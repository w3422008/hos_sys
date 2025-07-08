<?php
require_once('../config.php');
require_once('../functions.php');
session_start();

$dbh = get_db_connect();



if (isset($_POST['mes_add'])) {
    //表示
    $situation = "0";
    $req_fac = $_SESSION['message']['req_fac'];
    $req_dep = $_SESSION['message']['req_dep'];
    $req_date = $_SESSION['message']['req_date'];
    $comment = $_SESSION['message']['comment'];
    $view = $_SESSION['message']['view'];

    $_SESSION['message']['add'] = $_POST['mes_add'];
    /* echo "追加合図"; */
    $message= insert_message($dbh,$situation,$req_date,$comment,$req_fac,$req_dep,$view);

    $situation = '';
    $req_fac = '';
    $req_dep = '';
    $req_date = '';
    $comment = '';
    $view = '';

}elseif(isset($_POST['back'])){
    $_SESSION['back_add'] = $_POST['back'];

    $req_fac = $_SESSION['message']['req_fac'];
    $req_dep = $_SESSION['message']['req_dep'];
    $req_date = $_SESSION['message']['req_date'];
    $comment = $_SESSION['message']['comment'];
    $view = $_SESSION['message']['view'];

}
include_once("mes_log.php"); 