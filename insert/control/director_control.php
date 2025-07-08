<?php

//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');

$dbh = get_db_connect();



//学校名
$list_sch_name = array(
    0 => '川崎医科大学',
    1 => '医療福祉大学',
    2 => '医療短期大学',
    3 => '附属高校',
    4 => 'リハビリテーション学院'
);

//続柄
$list_conn = array(
    0 => '親',
    1 => '配偶者',
    2 => '弟・姉妹',
    3 => '子',
    4 => '孫',
    5 => 'その他'
);
    



//櫻間
$datalist_dept=get_depa($dbh);


//ビューview.phpの読み出し
    include_once('./insert_view/director_view.php');
 


