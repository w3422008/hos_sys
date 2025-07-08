<?php

require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh =get_db_connect();

$intro_year = get_intro_year($dbh);
$intro_year = substr( $intro_year, 0, 4 )."年";




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ファイルが正しくアップロードされたか確認
    if (isset($_FILES["filename"]) && $_FILES["filename"]["error"] == 0  ) {
        // アップロードされたファイルの情報を取得
        
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $file_name = $_FILES["filename"]["name"];
        $file_tmp = $_FILES["filename"]["tmp_name"];
        $file_size = $_FILES["filename"]["size"];

    // エラーメッセージを格納する配列を初期化
    $errors = [];

        // ファイル名に「紹介」が含まれているかつ「逆紹介」ではない場合にエラー
        if (strpos($file_name, '紹介') === false || strpos($file_name, '逆紹介') !== false) {
            $errors[] = "・ファイル名に「紹介」という文字が含まれていないか、「逆紹介」が含まれています。";
        }

    // ファイルの拡張子がcsvであるかの判定
    if (pathinfo($file_name, PATHINFO_EXTENSION) !== 'csv') {
        $errors[] = "・拡張子がcsvではありません。";
    } 
    


    // セッションを開始
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

        // CSVファイルの内容を読み取る
        $csv_data = [];
        if (($handle = fopen($file_tmp, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Shift-JIS から UTF-8 に変換
                $utf8_data = array_map(function ($field) {
                    return mb_convert_encoding($field, 'UTF-8', 'SJIS-win');
                }, $data);
                $csv_data[] = $utf8_data;
            }
            fclose($handle);
        }

        // 空の行を削除
        $csv_data = array_filter($csv_data, function($row) {
            return array_filter($row); // 空のフィールドがない行のみを残す
        });

        // 空のデータがあるかチェック
        foreach ($csv_data as $rowIndex => $row) {
            foreach ($row as $colIndex => $field) {
                if (trim($field) === '') {
                    $errors[] = "・空のデータが含まれています。行: " . ($rowIndex + 1) . ", 列: " . ($colIndex + 1);
                }
            }
        }

    // カラム名が正しいかの判定
    if(mb_ereg('医療機関CD', $csv_data[0][0]) == 1 && mb_ereg('病院区分', $csv_data[0][1]) == 1 && mb_ereg('年度', $csv_data[0][2]) == 1 && mb_ereg('診療日', $csv_data[0][3]) == 1 && mb_ereg('科コード', $csv_data[0][4]) == 1 && mb_ereg('診療科', $csv_data[0][5]) == 1 && mb_ereg('紹介件数', $csv_data[0][6]) == 1 ){
        // CSVデータをセッションに保存
        $_SESSION['csv_data'] = $csv_data;
    }else{
        $errors[] = "・カラム名が正しくありません。";
    }

    if(isset($_SESSION['csv_data'])){
        // CSVデータの1行目をスキップ
        $csv_data = array_slice($csv_data, 1);
    
        //初期化
        $dateIndex = null;
        // 日付のカラムインデックス（例: 4番目のカラムが日付の場合）
        $dateIndex = 2;
    
        
        // 初期化
        $minDate = null;
        $maxDate = null;
    
        foreach ($csv_data as $row) {
            if (!isset($row[$dateIndex])) {
                continue; // $dateIndex のキーが存在しない場合はスキップ
            }
        
            $date = trim($row[$dateIndex]); // 空白除去
        
            if ($date === '') {
                continue; // 空文字の場合スキップ
            }
        
            // 初回の代入（$minDate が null の場合）
            if ($minDate === null || strtotime($date) < strtotime($minDate)) {
                $minDate = $date;
            }
        
            if ($maxDate === null || strtotime($date) > strtotime($maxDate)) {
                $maxDate = $date;
            }
        }
        $year = null;
        if($minDate == null || $maxDate == null){
            $minDate = "データがありません";
            $maxDate = "データがありません";
        }elseif($minDate == $maxDate){
            $year = substr($minDate, 0, 4) . "年度" ;
        }else{
            $year = substr($minDate, 0, 4) . "年度 ～ " . substr($maxDate, 0, 4) . "年度";        
            $errors[] = "・1年度分のデータに変更してください。";
        }
    }

        $check = "<strong><span style='font-size: 20px; font-weight: bold;'>＜　以下の内容を確認してください。　＞</span></strong>
        　・ファイル名を変更する場合は、ファイルを再選択してください。
        　・ファイルの形式が「csv」ではない場合は、ファイルを再選択してください。
        　・ファイルの内容が、「紹介データ」であるか確認してください。
        　・既存データの最新年度は、".$intro_year."です。
        　・$file_name は、$year のデータです。
        　・上記の内容に問題がない場合は、追加ボタンを押してください。";
    }
    



    } else {
        echo "ファイルがアップロードされていません。";
    }



include_once('intro_file_check_view.php');
