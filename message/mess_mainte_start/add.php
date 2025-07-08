<?php
require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh = get_db_connect();



//var_dump($_POST);
$title = $_POST['mai_start_title'];
$comment = $_POST['mai_start_comment'];
$date = $_POST['mai_start_date'];
$start_time = $_POST['start_start_time'];
$end_time = $_POST['end_start_time'];
$comment2 = $_POST['mai_start_comment2'];
$view = $_POST['mai_start_view'];


    

    $_SESSION['maintenance_start']['title'] = $title;
    $_SESSION['maintenance_start']['comment'] = $comment;
    $_SESSION['maintenance_start']['date'] = $date;
    $_SESSION['maintenance_start']['start_time'] = $start_time;
    $_SESSION['maintenance_start']['end_time'] = $end_time;
    $_SESSION['maintenance_start']['comment2'] = $comment2;
    $_SESSION['maintenance_start']['view'] = $view;
    


    include_once('./mainte_view/add_view.php');




?>