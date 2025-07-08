<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
$hos_cd= $_GET['cd'];
$dbh = get_db_connect();

//$data=detail($dbh,$hos_cd);
/* 高橋20230224 院外支援・研修データ */
$training_data = detail_training($dbh,$hos_cd);
