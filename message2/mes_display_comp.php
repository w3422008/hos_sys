<?php
require_once('../config.php');
require_once('../functions.php');
session_start();

$dbh = get_db_connect();
if (isset($_POST['mes_display'])) {

    $id = $_SESSION['message']['id'];
    /* viewの元の値を反対にすることで表示→非表示　非表示→表示の値に変えている */
    if($_SESSION['message']['view'] == '0'){
        $view = '1';
    }else{
        $view = '0';
    };
    
    /*'表示非表示変更完了'*/
    $display_update= view_update_message($dbh,$id,$view);
    /* セッションのエラーを防ぐ */
    $_SESSION['message']['display'] = $_POST['mes_display'];
    /* 新規追加画面のの表示非表示のエラーを防ぐ */
    $view = 1;

}elseif(isset($_POST['back'])){
    $_SESSION['back'] = $_POST['back'];
    /* 新規追加画面のの表示非表示のエラーを防ぐ */
    $view = 1;
}
include_once("mes_log.php"); 