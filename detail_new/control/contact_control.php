<?php
require_once('../functions.php');

$hos_cd = $_GET['cd'];
$dbh = get_db_connect();

// コンタクト履歴データ取得
$data = detail_contact($dbh, $hos_cd);
