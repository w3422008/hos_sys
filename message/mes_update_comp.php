<?php
require_once('../config.php');
require_once('../functions.php');
session_start();

$dbh = get_db_connect();
if (isset($_POST['mes_update'])) {
    $id = $_SESSION['message']['id'];  
    $req_fac = $_SESSION['message']['req_fac'];
    if( $req_fac === "附属病院"){
        $req_fac = '附';
    }elseif($req_fac ==="総合医療センター"){
        $req_fac = '総';
    }elseif($req_fac==="医療福祉大学"){
        $req_fac = '福祉大';
    }elseif($req_fac==="その他"){
        $req_fac = 'その他';
    }
    $req_dep = $_SESSION['message']['req_dep'];
    $situation = $_POST['situation'];
    $req_date = $_SESSION['message']['req_date'];
    $res_date = $_POST['res_date'];
    $version = $_POST['version'];
    $comment = $_POST['comment'];
    $view = $_POST['view'];

    /*'変更完了'*/
    $mes_update= update_message($dbh,$id,$situation,$req_date,$res_date,$version,$comment,$req_fac,$req_dep,$view);
    /* セッションのエラーを防ぐ */
    $_SESSION['message']['update'] = $_POST['mes_update'];
    /* 新規追加画面のの表示非表示のエラーを防ぐ */
    $view = 1;

}elseif(isset($_POST['back'])){
    $_SESSION['back'] = $_POST['back'];
        /* 新規追加画面のの表示非表示のエラーを防ぐ */
        $view = 1;
}
include_once("mes_log.php"); 