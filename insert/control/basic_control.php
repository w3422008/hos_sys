<?php

//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');

include_once('../config.php');
$dbh = get_db_connect();

//医師会
$datalist_ass = get_ass($dbh);



//ビューview.phpの読み出し
   include_once('./insert_view/basic_view.php');

