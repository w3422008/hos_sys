
<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
   $hos_cd=  $_GET['cd'];
session_start();


if(empty($_SESSION['member'])){
   header('Location:'.SITE_URL.'index.php');
   exit();
}

$_SESSION["sid_id"]=$hos_cd;

//櫻間
$user_adm = $_SESSION['member']['adm_user'];
$dbh = get_db_connect();
$data=detail($dbh,$hos_cd);

if(isset($_SESSION)){
   unset($_SESSION['update']);
}

//高橋20230329追記　検索結果画面よりpageidをGETで取得　ここから
if(isset($_GET['page_id'])){
   $page_id = $_GET['page_id'];
   $_SESSION['page_id'] = $page_id; 
}elseif(isset($_SESSION['page_id'])){
   $page_id = $_SESSION['page_id'];
}
//20230329追記　ここまで

//20230512　地域マスタ情報取得
$are_cds=get_area($dbh);

//櫻間
//ビューview.phpの読み出し
if($user_adm === '1' || $user_adm === '3'){
   include_once('header_detail.php');
}elseif($user_adm === '2'){
   include_once('office_header_detail.php');
}elseif($user_adm === '0'){
   include_once('user_header_detail.php');
}

