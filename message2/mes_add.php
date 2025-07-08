<?php
require_once('../config.php');
require_once('../functions.php');


session_start();


$dbh = get_db_connect();



//var_dump($_POST);
$req_fac = $_POST['req_fac'];
$req_dep = $_POST['req_dep'];
$req_date = $_POST['req_date'];
$comment = $_POST['comment'];
$view = $_POST['view'];


    
    $_SESSION['message']['req_fac'] = $req_fac;
    $_SESSION['message']['req_dep'] = $req_dep;
    $_SESSION['message']['req_date'] = $req_date;
    $_SESSION['message']['comment'] = $comment;
    $_SESSION['message']['view'] = $view;
    



include_once('./message_view/mes_add_view.php');
?>