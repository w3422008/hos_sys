<?php

//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
   $hos_cd= $_GET['cd'];


$dbh = get_db_connect();
$data=detail($dbh,$hos_cd);

//高橋20230106追加 診療科
$dept_data = get_Internal_medicine($dbh);
$dept_data2 = get_pediatrics($dbh);
$dept_data3 = get_surgery($dbh);
$dept_data4 = get_orthopedics($dbh);
$dept_data5 = get_ophthalmology($dbh);
$dept_data6 =get_otolaryngology($dbh);
$dept_data7 = get_dermatology_urology($dbh);
$dept_data8 = get_gynecology($dbh);
$dept_data9 = get_psychiatry($dbh);
$dept_data10 = get_dentistry($dbh);
$dept_data11 = get_etcetera($dbh);
//高橋20230106 ここまで


