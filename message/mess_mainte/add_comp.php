<?php
require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh = get_db_connect();
if (isset($_POST['add'])) {
    //表示
    $title = $_SESSION['maintenance']['title'];
    $upload_date = $_SESSION['maintenance']['upload_date'];
    $date = $_SESSION['maintenance']['date'];
    $start_time = $_SESSION['maintenance']['start_time'];
    $end_time = $_SESSION['maintenance']['end_time'];
    $comment = $_SESSION['maintenance']['comment'];
    $view = $_SESSION['maintenance']['view'];

    //改行コードの統一 20240521
    $comment = str_replace("\r\n", "\n", $comment);
    $comment = str_replace("\r", "\n", $comment);

    $_SESSION['maintenance']['add'] = $_POST['add'];
    /* echo "追加合図"; */
    $maintenance= update_maintenance($dbh,$title,$upload_date,$date,$start_time,$end_time,$comment,$view);


}elseif(isset($_POST['back'])){
    $_SESSION['back'] = $_POST['back'];

    $title = $_SESSION['maintenance']['title'];
    $upload_date = $_SESSION['maintenance']['upload_date'];
    $date = $_SESSION['maintenance']['date'];
    $start_time = $_SESSION['maintenance']['start_time'];
    $end_time = $_SESSION['maintenance']['end_time'];
    $comment = $_SESSION['maintenance']['comment'];
    $view = $_SESSION['maintenance']['view'];


}
include_once("mainte.php"); 