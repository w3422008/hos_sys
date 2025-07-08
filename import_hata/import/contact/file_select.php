<?php

require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh = get_db_connect();

$_SESSION['tsv_data'] = null;

$contactB_ym = get_contactB_ym($dbh);
if(empty($contactB_ym)){
    $contactB_ym = 'データなし';
}else{
$contactB_ym = substr( $contactB_ym, 0, 4 )."年".substr( $contactB_ym, 5, 2 )."月";
}

include_once('file_select_view.php');