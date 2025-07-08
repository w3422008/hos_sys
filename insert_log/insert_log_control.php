<?php
require_once('../config.php');
require_once('../functions.php');
session_start();
//新規ログ
//櫻間20230511
$user_id = $_SESSION['member']['user_id'];
$user_name = $_SESSION['member']['user_name'];
$user_adm = $_SESSION['member']['adm_user'];

$dbh = get_db_connect();
$data=get_log_insert($dbh);

include_once('insert_log_view.php');
//櫻間20230511
?>