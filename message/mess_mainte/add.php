<?php
require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh = get_db_connect();



//var_dump($_POST);
$title = $_POST['mai_title'];
$upload_date = $_POST['mai_upload_date'];
$date = $_POST['mai_date'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$comment = $_POST['mai_comment'];
$view = $_POST['mai_view'];


    

    $_SESSION['maintenance']['title'] = $title;
    $_SESSION['maintenance']['upload_date'] = $upload_date;
    $_SESSION['maintenance']['date'] = $date;
    $_SESSION['maintenance']['start_time'] = $start_time;
    $_SESSION['maintenance']['end_time'] = $end_time;
    $_SESSION['maintenance']['comment'] = $comment;
    $_SESSION['maintenance']['view'] = $view;
    
    
    include_once('./mainte_view/add_view.php');




?>