<?php

require_once('../../config.php');
require_once('../../functions.php');

session_start();
$dbh = get_db_connect();

$introB_year = get_introB_year($dbh);
$invB_year = get_invB_year($dbh);

if(empty($introB_year)){
    $introB_year = 'データなし';
}else{
    $introB_year = substr( $introB_year, 0, 4 )."年度";
}

if(empty($invB_year)){
    $invB_year = 'データなし';
}else{
    $invB_year = substr( $invB_year, 0, 4 )."年度";
}

include_once('file_select_view.php');