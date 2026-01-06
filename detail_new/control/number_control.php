<?php
require_once('../functions.php');

$hos_cd = $_GET['cd'];
$dbh = get_db_connect();

// 部門別連絡先データ取得
$num_data = detail_num($dbh, $hos_cd);
