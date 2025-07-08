<?php

//櫻間
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('functions.php');

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

//櫻間
$user_id = $_SESSION['member']['user_id'];
$user_name = $_SESSION['member']['user_name'];
$user_adm = $_SESSION['member']['adm_user'];
//$user_id='';
//$user_id=$member['user_id'];
//櫻間
//データベース接続
$dbh = get_db_connect();

$data50=user_info($dbh,$user_id);

include_once('header_view.php');

//櫻間




