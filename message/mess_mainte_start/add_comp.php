<?php
require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh = get_db_connect();
if (isset($_POST['start_add'])) {
    //表示
    $title = $_SESSION['maintenance_start']['title'];
    $comment = $_SESSION['maintenance_start']['comment'];
    $date = $_SESSION['maintenance_start']['date'];
    $start_time = $_SESSION['maintenance_start']['start_time'];
    $end_time = $_SESSION['maintenance_start']['end_time'];
    $comment2 = $_SESSION['maintenance_start']['comment2'];
    $view = $_SESSION['maintenance_start']['view'];

    //改行コードの統一 20240521
    $comment = str_replace("\r\n", "\n", $comment);
    $comment = str_replace("\r", "\n", $comment);
    $comment2 = str_replace("\r\n", "\n", $comment2);
    $comment2 = str_replace("\r", "\n", $comment2);

    $_SESSION['maintenance_start']['add'] = $_POST['start_add'];
    /* echo "追加合図"; */
    $maintenance_start= update_maintenance_start($dbh,$title,$comment,$date,$start_time,$end_time,$comment2,$view);


}elseif(isset($_POST['start_back'])){
    $_SESSION['start_back'] = $_POST['start_back'];

    $title = $_SESSION['maintenance_start']['title'];
    $upload_date = $_SESSION['maintenance_start']['comment'];
    $date = $_SESSION['maintenance_start']['date'];
    $start_time = $_SESSION['maintenance_start']['start_time'];
    $end_time = $_SESSION['maintenance_start']['end_time'];
    $comment = $_SESSION['maintenance_start']['comment2'];
    $view = $_SESSION['maintenance_start']['view'];


}

include_once("mainte.php"); 