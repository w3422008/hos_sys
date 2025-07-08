<?php

//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
   $hos_cd= $_GET['cd'];



$dbh = get_db_connect();
$data=detail($dbh,$hos_cd);

//高橋 医師会データリストの取得
$datalist_ass = get_ass($dbh);


