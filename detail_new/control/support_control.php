<?php
require_once('../functions.php');

$hos_cd = $_GET['cd'];
$dbh = get_db_connect();

// 院外支援・研修データ取得
$data = detail_training($dbh, $hos_cd);
