<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
   $hos_cd= $_GET['cd'];

$dbh = get_db_connect();

/* 高橋20230428 紹介・逆紹介データ */
   //紹介（附属病院）
   $intr_data = detail_intr($dbh,$hos_cd);
      $intr_sum = SUMs_intr($dbh,$hos_cd);
   //逆紹介（附属病院）
   $invintr_data = detail_invintr($dbh,$hos_cd);
      $invintr_sum = SUMs_invintr($dbh,$hos_cd);


/* 高橋20230428　今後、総合医療センターデータ取得時に使用
   //紹介（総合医療センター）
   $intr_data2 = detail_intr($dbh,$hos_cd);
      $intr_sum2 = SUMs_intr($dbh,$hos_cd);
   //逆紹介（総合医療センター）
   $invintr_data2 = detail_invintr($dbh,$hos_cd);
      $invintr_sum2 = SUMs_invintr($dbh,$hos_cd);
*/

