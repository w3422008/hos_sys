<?php

//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');

$hos_cd= $_GET['cd'];
$dbh = get_db_connect();

$num_data = detail_num($dbh, $hos_cd);
$num_data1 = gairai($dbh, $hos_cd);
$num_data2 = renkei($dbh, $hos_cd);
$num_data3 = sonota($dbh, $hos_cd);


/* 高橋 プルダウンリスト */
//区分
$list_fie_div = array(
   0 => '外来',
   1 => '連携',
   2 => 'その他'
);
