<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
$dbh = get_db_connect();

//高橋20230602　『連携パス』項目
$CorpPath = array(
   '入退院支援連携先病院',
   '脳卒中パス',
   '大腿骨パス',
   '心筋梗塞・心不全パス',
   '胃がんパス',
   '大腸がんパス',
   '乳がんパス',
   '肺がんパス',
   '肝がんパス',
);
