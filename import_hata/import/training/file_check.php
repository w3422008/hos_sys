<?php

require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh =get_db_connect();



$training_year = get_training_year($dbh);
$training_year = empty($training_year) ? 'データなし' : substr($training_year, 0, 4) . "年度";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ファイルが正しくアップロードされたか確認
    if (isset($_FILES["filename"]) && $_FILES["filename"]["error"] == 0  ) {
        // アップロードされたファイルの情報を取得
        //サーバ上で日本語が消える問題を解決
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $file_name = $_FILES["filename"]["name"];
        $file_tmp = $_FILES["filename"]["tmp_name"];
        $file_size = $_FILES["filename"]["size"];


        // エラーメッセージを格納する配列を初期化
        $errors = [];

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


        // カラム名が正しいかの判定
        if(mb_ereg('医療機関CD', $csv_data[0][0]) == 1 && mb_ereg('年度', $csv_data[0][1]) == 1 && mb_ereg('施設', $csv_data[0][2]) == 1 &&mb_ereg('医療機関名', $csv_data[0][3]) == 1 && mb_ereg('診療科', $csv_data[0][4]) == 1 && mb_ereg('職名', $csv_data[0][5]) == 1 && mb_ereg('氏名', $csv_data[0][6]) == 1 && mb_ereg('開始日', $csv_data[0][7]) == 1 && mb_ereg('終了日', $csv_data[0][8]) == 1 && mb_ereg('診療支援区分', $csv_data[0][9]) == 1 && mb_ereg('日時', $csv_data[0][10]) == 1 && mb_ereg('役職順', $csv_data[0][11]) == 1){
            // CSVデータをセッションに保存
            $_SESSION['csv_data'] = $csv_data;
        }else{
            $errors[] = "・カラム名が正しくありません。";   
        }

        if (isset($_SESSION['csv_data'])) {
        
            // CSVデータの1行目をスキップ
            $csv_data = array_slice($csv_data, 1);


        // CSVデータをセッションに保存
        $_SESSION['csv_data'] = $csv_data;
        }else{
            $errors[] = "・カラム名が正しくありません。";   
        }

        // 空の行を削除
        $csv_data = array_filter($csv_data, function($row) {
            return array_filter($row); // 空のフィールドがない行のみを残す
        });

        // 空の列を削除
        $csv_data = array_map(function($row) {
            return array_filter($row, function($field) {
                return trim($field) !== ''; // 空のフィールドを削除
            });
        }, $csv_data);

        // 不要項目削除済みCSVデータをセッションに保存
        $_SESSION['csv_data'] = $csv_data;




                // 空のデータがあるかチェック
                foreach ($csv_data as $rowIndex => $row) {
                    foreach ($row as $colIndex => $field) {
                        if (trim($field) === '') {
                            $errors[] = "・空のデータが含まれています。行: " . ($rowIndex + 1) . ", 列: " . ($colIndex + 1);
                        }
                    }
                }



                    $dateIndex = 1;

                    // 初期化
                    $minDate = null;
                    $maxDate = null;
                
                    //最古年度取得
                    foreach ($csv_data as $row) {
                        $start_date = $row[$dateIndex];
                
                        if ($minDate === null || $start_date < $minDate) {
                            $minDate = $start_date;
                        }
                    }
                    //最新年度取得取得
                    foreach ($csv_data as $row) {
                        $end_date = $row[$dateIndex];
                
                        if ($maxDate === null || $end_date > $maxDate) {
                            $maxDate = $end_date;
                        }
                    }


                    if($minDate == null || $maxDate == null){
                        $minDate = "データがありません";
                        $maxDate = "データがありません";
                    }elseif($minDate == $maxDate){
                        $year = substr($minDate, 0, 4) . "年度" ;
                    }else{
                        $year = substr($minDate, 0, 4) . "年度 ～ " . substr($maxDate, 0, 4) . "年度";        
                        $errors[] = "・1年度分のデータに変更してください。";
                    }
/* 
                    // 日付のカラムインデックス（例: 4番目のカラムが日付の場合）
                    $mindateIndex = null;
                    $maxdateIndex = null;
                    $mindateIndex = 7;
                    $maxdateIndex = 8;
                
                    // 初期化
                    $minDate = null;
                    $maxDate = null;
                    最古日付取得
                    foreach ($csv_data as $row) {
                        $start_date = $row[$mindateIndex];
                
                        if ($minDate === null || $start_date < $minDate) {
                            $minDate = $start_date;
                        }
                    }
                    最新日付取得取得
                    foreach ($csv_data as $row) {
                        $end_date = $row[$maxdateIndex];
                
                        if ($maxDate === null || $end_date > $maxDate) {
                            $maxDate = $end_date;
                        }
                    }
                    
                                       
                    if($minDate == null || $maxDate == null){
                        $minDate = "データがありません";
                        $maxDate = "データがありません";
                    }else{
                    // **日付フォーマット（年月日形式）**
                    $minDate = ($minDate !== null && strpos($minDate, '/') !== false)
                        ? sprintf("%d年%d月%d日", ...explode('/', $minDate))
                        : "日付がありません";

                    $maxDate = ($maxDate !== null && strpos($maxDate, '/') !== false)
                        ? sprintf("%d年%d月%d日", ...explode('/', $maxDate))
                        : "日付がありません";
                    }    */
    }

                $check = "<strong><span style='font-size: 20px; font-weight: bold;'>＜　以下の内容を確認してください。　＞</span></strong>
                　・ファイル名を変更する場合は、ファイルを再選択してください。
                　・ファイルの形式が「csv」ではない場合は、ファイルを再選択してください。
                　・ファイルの内容が、「兼業データ」であるか確認してください。
                　・既存データの最新年度は、".$training_year."です。
                　・$file_name は、$year のデータです。
                　・上記の内容に問題がない場合は、追加ボタンを押してください。";

} else {
    echo "ファイルがアップロードされていません。";
}


include_once('file_check_view.php');
