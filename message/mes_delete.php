<?php
require_once('../config.php');
require_once('../functions.php');


session_start();

$id = $_GET['id'];

$dbh = get_db_connect();
$delete_data = get_select_message($dbh,$id);





/* $situation = $_POST['situation'];
$req_fac = $_POST['req_fac'];
$req_dep = $_POST['req_dep'];
$date = $_POST['date'];
$comment = $_POST['comment'];
$view = $_POST['view']; */

    $_SESSION['message']['id'] = $id;
/*     $_SESSION['message']['situation'] = $situation;
    $_SESSION['message']['req_fac'] = $req_fac;
    $_SESSION['message']['req_dep'] = $req_dep;
    $_SESSION['message']['date'] = $date;
    $_SESSION['message']['comment'] = $comment;
    $_SESSION['message']['view'] = $view; */
   



include_once('./message_view/mes_delete_view.php');
?>