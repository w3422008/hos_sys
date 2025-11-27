<?php

// 紹介・逆紹介
require_once('../config.php');
require_once('../functions.php');

session_start();
$dbh = get_db_connect();

// データ最新年度 取得
//紹介・逆紹介-------------------------------------------------------------------
$intro_ym = get_intro_ym($dbh);
$inv_ym = get_inv_intro_ym($dbh);

// 紹介
if(empty($intro_ym)){
    $intro_ym = 'データなし';
}else{
    $intro_ym = substr( $intro_ym, 0, 4 )."年".substr( $intro_ym, 5, 2 )."月";
}

// 逆紹介
if(empty($inv_ym)){
    $inv_ym = 'データなし';
}else{
    $inv_ym = substr( $inv_ym, 0, 4 )."年".substr( $inv_ym, 5, 2 )."月";
}

// コンタクト -------------------------------------------------------------------
$contact_ym = get_contact_ym($dbh);

if(empty($contact_ym)){
    $contact_ym = 'データなし';
}else{
    $contact_ym = substr( $contact_ym, 0, 4 )."年".substr( $contact_ym, 5, 2 )."月";
}


//　　兼業　　-------------------------------------------------------------------
$training_year = get_training_year($dbh);

if(empty($training_year)){
    $training_year = 'データなし';
}else{
    $training_year = substr( $training_year, 0, 4 )."年度";
}

$folders = getCsvFolders();
$baseDir = __DIR__ . '/';

// ファイル一覧取得
$folderFiles = [];
foreach ($folders as $label => $folder) {
    $folderFiles[$label] = getCsvFiles($baseDir . $folder);
}

include_once('file_select_view.php');