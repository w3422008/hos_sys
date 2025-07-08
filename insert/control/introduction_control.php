<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');

$dbh = get_db_connect();

//ビューview.phpの読み出し
include_once('./insert_view/introduction_view.php');