<?php

require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh = get_db_connect();

$intro_ym = get_intro_ym($dbh);
if(empty($intro_ym)){
    $intro_ym = 'データなし';
}else{
$intro_ym = substr( $intro_ym, 0, 4 )."年".substr( $intro_ym, 5, 2 )."月";
}
$intro_ymB_ym = get_introB_ym($dbh);
if(empty($intro_ymB_ym)){
    $intro_ymB_ym = 'データなし';
}else{
$intro_ymB_ym = substr( $intro_ymB_ym, 0, 4 )."年".substr( $intro_ymB_ym, 5, 2 )."月";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ファイルが正しくアップロードされたか確認
    if (isset($_FILES["filename"]) && $_FILES["filename"]["error"] == 0  ) {
        // アップロードされたファイルの情報を取得
        //サーバ上で日本語が消える問題を解決
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $file_name = $_FILES["filename"]["name"];
        $file_tmp = $_FILES["filename"]["tmp_name"];
        $file_size = $_FILES["filename"]["size"];

        $errors = [];

        // 拡張子チェック
        if (pathinfo($file_name, PATHINFO_EXTENSION) !== 'csv') {
            $errors[] = "・拡張子がcsvではありません。";
        }

        // セッションを開始
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // CSV読み込み
        $csv_data = [];
        if (($handle = fopen($file_tmp, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $csv_data[] = $data;
            }
            fclose($handle);
        }
        
        // 文字コード変換
        $utf8_data = array_map(function ($row) {
            return array_map(function ($field) {
                return mb_convert_encoding($field, 'UTF-8', 'SJIS-win');
            }, $row);
        }, $csv_data);

        // 空行除去
        $utf8_data = array_filter($utf8_data, function($row) {
            return array_filter($row);
        });
var_dump($utf8_data);
        // intro用カラム名判定
        // 例: hos_cd, ins, year, date, fie_cd, fie_name, intr
        $header = $utf8_data ? array_values($utf8_data)[0] : [];
        if (
            mb_ereg('医療機関CD', $header[0]) == 1 &&
            mb_ereg('担当者', $header[1]) == 1 &&
            mb_ereg('年度', $header[2]) == 1 &&
            mb_ereg('日付', $header[3]) == 1 &&
            mb_ereg('診療科CD', $header[4]) == 1 &&
            mb_ereg('診療科名', $header[5]) == 1 &&
            mb_ereg('紹介内容', $header[6]) == 1
        ) {
            $_SESSION['csv_data'] = $utf8_data;
        } else {
            $errors[] = "・カラム名が正しくありません。";
        }
var_dump($_SESSION['csv_data']);
        // 日付カラムインデックス
        $dateIndex = 3;
        $minDate = null;
        $maxDate = null;

        // 1行目スキップ
        $data_rows = array_slice($utf8_data, 1);

        foreach ($data_rows as $row) {
            if (!isset($row[$dateIndex])) continue;
            $date = trim($row[$dateIndex]);
            if ($date === '') continue;
            if ($minDate === null || strtotime($date) < strtotime($minDate)) $minDate = $date;
            if ($maxDate === null || strtotime($date) > strtotime($maxDate)) $maxDate = $date;
        }

        if ($minDate === null || $maxDate === null) {
            $errors[] = "日付がありません";
        }

        $minYearMonth = ($minDate !== null) ? date('Y-m', strtotime($minDate)) : null;
        $maxYearMonth = ($maxDate !== null) ? date('Y-m', strtotime($maxDate)) : null;

        // セッションに年月も保存
        $_SESSION['minYearMonth'] = $minYearMonth;
        $_SESSION['maxYearMonth'] = $maxYearMonth;

        // 1か月判定
        if ($minYearMonth !== $maxYearMonth) {
            $errors[] = "期間が１ヵ月ではないため、データを追加できません。";
        } else {
            $check = "<strong><span style='font-size: 20px; font-weight: bold;'>＜　以下の内容を確認してください。　＞</span></strong>
            　・ファイル名を変更する場合は、ファイルを再選択してください。
            　・ファイルの形式が「csv」ではない場合は、ファイルを再選択してください。
            　・ファイルの内容が、「紹介データ」であるか確認してください。
            　・重複データが存在している場合、上書きされる可能性があります。
            　・$file_name は、 $minDate ～ $maxDate のデータです。
            　・上記の内容に問題がない場合は、追加ボタンを押してください。";
        }
    } else {
        $errors[] = "ファイルがアップロードされていません。";
    }
}

include_once('file_check_month_view.php');