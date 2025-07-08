<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');

$hos_cd= $_GET['cd'];
$dbh = get_db_connect();


/* 高橋20230609 カルナコネクト　データ */
   $carna_data = detail_carna($dbh,$hos_cd);
  
/* 高橋20230609 連携パス　データ */
   $cPath_data1 = detail_cPath($dbh,$hos_cd,0); //附属病院
   $cPath_data2 = detail_cPath($dbh,$hos_cd,1); //総合医療センター
  
/* 高橋20231121 医療連携懇話会参加年度　データ */
   $socialMeeting_data1 = detail_socialMeeting($dbh,$hos_cd,0); //附属病院
   $socialMeeting_data2 = detail_socialMeeting($dbh,$hos_cd,1); //総合医療センター
   $socialMeeting_data3 = detail_socialMeeting($dbh,$hos_cd,2); //総合医療センター


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

