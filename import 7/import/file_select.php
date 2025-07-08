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

// CSVファイル関連
function getCsvFolders() {
    return [
        'BK_contact'      => 'BK_contact',
        'BK_intro'        => 'BK_intro',
        'BK_invers_intro' => 'BK_invers_intro',
        'BK_training'     => 'BK_training',
    ];
}

// 指定ディレクトリ内のCSVファイル名一覧を返す
function getCsvFiles($dir) {
    $files = [];
    if (is_dir($dir)) {
        foreach (glob($dir . '/*.csv') as $file) {
            $files[] = basename($file);
        }
    }
    return $files;
}

// 指定されたCSVファイルの内容をHTMLテーブルとして返す
// フォルダの安全性もチェックする
function getCsvTableHtml($baseDir, $folders, $viewFile) {
    $realPath = realpath($baseDir . $viewFile);
    
    // フォルダの安全性チェック
    $allow = false;
    foreach ($folders as $folder) {
        if (strpos($realPath, realpath($baseDir . $folder)) === 0) {
            $allow = true;
            break;
        }
    }
    // ファイルの存在とアクセス権を確認
    if ($allow && is_file($realPath)) {
        if (($fp = fopen($realPath, 'r')) !== false) {
            $html = "<table class='stylish-csv-table'>";
            $isFirst = true;    // 最初の行はヘッダーとして扱う

            // CSVファイルを読み込み、HTMLテーブルに変換
            // fgetcsvはCSVの各行を配列として返す
            while (($row = fgetcsv($fp)) !== false) {
                $html .= "<tr>";
                foreach ($row as $cell) {
                    $tag = $isFirst ? "th" : "td";
                    $html .= "<$tag>" . htmlspecialchars($cell) . "</$tag>";
                }
                $html .= "</tr>";
                $isFirst = false;
            }
            $html .= "</table>";
            fclose($fp);
            return $html;
        }
    }
    return "<p style='color:red;'>ファイルが見つからないか、アクセスできません。</p>";
}

// ファイル名から保存日時を取得する関数
function getSavedDatetimeFromFilename($filename) {
    // 例: 20240608_153012_Year_import.csv
    if (preg_match('/^(\d{8})_(\d{6})/', $filename, $m)) {
        $date = $m[1]; // 20240608
        $time = $m[2]; // 153012
        $datetime = sprintf(
            '%s年%s月%s日 %s:%s:%s',
            substr($date, 0, 4),
            substr($date, 4, 2),
            substr($date, 6, 2),
            substr($time, 0, 2),
            substr($time, 2, 2),
            substr($time, 4, 2)
        );
        return $datetime;
    }
    return '';
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


