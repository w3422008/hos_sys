<?php

//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');

$dbh = get_db_connect();



//区分
$list_fie_div = array(
   0 => '---',
   1 => '外来',
   2 => '連携',
   3 => 'その他'
);

//ビューview.phpの読み出し
   include_once('./insert_view/number_view.php');

