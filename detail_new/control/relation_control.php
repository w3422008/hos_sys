<?php
require_once('../functions.php');

$hos_cd = $_GET['cd'];
$dbh = get_db_connect();

// CARNA接続状況データ取得
$data = detail_carna($dbh, $hos_cd);

// 連携パスデータ取得
$cPath_data1 = detail_cPath($dbh, $hos_cd, 0);
$cPath_data2 = detail_cPath($dbh, $hos_cd, 1);

// 医療連携懇話会参加データ取得
$socialMeeting_data1 = detail_socialMeeting($dbh, $hos_cd, 0);
$socialMeeting_data2 = detail_socialMeeting($dbh, $hos_cd, 1);
$socialMeeting_data3 = detail_socialMeeting($dbh, $hos_cd, 2);
