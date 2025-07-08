<?php

// 紹介・逆紹介
require_once('../config.php');
require_once('../functions.php');

session_start();
$dbh = get_db_connect();

//紹介・逆紹介-------------------------------------------------------------------
$introB_year = get_introB_year($dbh);
$invB_year = get_invB_year($dbh);

// 紹介
if(empty($introB_year)){
    $introB_year = 'データなし';
}else{
    $introB_year = substr( $introB_year, 0, 4 )."年度";
}

// 逆紹介
if(empty($invB_year)){
    $invB_year = 'データなし';
}else{
    $invB_year = substr( $invB_year, 0, 4 )."年度";
}

// コンタクト -------------------------------------------------------------------
$contactB_year = get_contactB_ym($dbh);

if(empty($contactB_year)){
    $contactB_year = 'データなし';
}else{
    $contactB_year = substr( $contactB_year, 0, 4 )."年度";
}


//　　兼業　　-------------------------------------------------------------------
$trainingB_year = get_trainingB_year($dbh);

if(empty($trainingB_year)){
    $trainingB_year = 'データなし';
}else{
    $trainingB_year = substr( $trainingB_year, 0, 4 )."年度";
}

$folders = getCsvFolders();
$baseDir = __DIR__ . '/';

// AJAXリクエスト: CSV内容取得
if (isset($_GET['ajax_view'])) {
    $viewFile = $_GET['ajax_view'];
    echo getCsvTableHtml($baseDir, $folders, $viewFile);
    exit;
}

// ファイル一覧取得
$folderFiles = [];
foreach ($folders as $label => $folder) {
    $folderFiles[$label] = getCsvFiles($baseDir . $folder);
}

include_once('file_select_view.php');


