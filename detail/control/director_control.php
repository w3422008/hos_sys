<?php

//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');

$hos_cd= $_GET['cd'];
$dbh = get_db_connect();

//drct_data1:理事長・病院長情報
$drct_data1= detail_director($dbh,$hos_cd);

//drct_data2:親族情報取得
$drct_data2= detail_relative($dbh,$hos_cd);


/* 高橋 プルダウンリスト 1106*/
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


