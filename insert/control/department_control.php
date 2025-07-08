<?php

//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');


$dbh = get_db_connect();




//区分
$list_dept_kubun = array(
   '外来', '連携', 'その他'
);

//ビューview.phpの読み出し
   include_once('./insert_view/department_view.php');


