<?php
require_once('../functions.php');

$hos_cd = $_GET['cd'];
$dbh = get_db_connect();

// 医療機能データ取得
$data = detail_medCare($dbh, $hos_cd);

// 医療機能カテゴリー取得
$medCare_all = medCare($dbh, '全般');
$medCare_naika = medCare($dbh, '内科系');
$medCare_geka = medCare($dbh, '外科系');
