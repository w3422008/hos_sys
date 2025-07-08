<?php
require_once('../config.php');
require_once('../functions.php');
session_start();
//削除ログ
//嶋津20230515
$user_id = $_SESSION['member']['user_id'];
$user_name = $_SESSION['member']['user_name'];
$user_adm = $_SESSION['member']['adm_user'];

$dbh = get_db_connect();
$data=get_log_delete($dbh);

include_once('delete_log_view.php');
?>