<?php
require_once('../config.php');
require_once('../functions.php');
session_start();

$dbh = get_db_connect();
if (isset($_POST['mes_delete'])) {

    $id = $_SESSION['message']['id'];

    /*'削除完了'*/
    $mes_delete= delete_message($dbh,$id);
    /* セッションのエラーを防ぐ */
    $_SESSION['message']['delete'] = $_POST['mes_delete'];

    /* 新規追加画面のの表示非表示のエラーを防ぐ */
    $view = 1;

}elseif(isset($_POST['back'])){
    $_SESSION['back'] = $_POST['back'];
        /* 新規追加画面のの表示非表示のエラーを防ぐ */
        $view = 1;
}
include_once("mes_log.php"); 