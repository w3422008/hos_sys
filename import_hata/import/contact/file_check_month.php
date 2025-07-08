<?php

require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh =get_db_connect();

$contact_ym = get_contact_ym($dbh);
if(empty($contact_ym)){
    $contact_ym = 'データなし';
}else{
$contact_ym = substr( $contact_ym, 0, 4 )."年".substr( $contact_ym, 5, 2 )."月";
}
$contactB_ym = get_contactB_ym($dbh);
if(empty($contactB_ym)){
    $contactB_ym = 'データなし';
}else{
$contactB_ym = substr( $contactB_ym, 0, 4 )."年".substr( $contactB_ym, 5, 2 )."月";
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
            // Shift-JIS から UTF-8 に変換を全行やるために$dataを$csvデータに入れている（もしかしたらいらない？）
                $csv_data[] = $data; 
                $utf8_data = array_map(function ($field) {
                    return mb_convert_encoding($field, 'UTF-8', 'SJIS-win'); // 'SJIS-win' は Windows 環境での互換性のため
                }, $csv_data);
            }
        }
        fclose($handle);


        // 空の行を削除
        $csv_data = array_filter($csv_data, function($row) {
            return array_filter($row); // 空のフィールドがない行のみを残す
        });
        
        //Excelファイルのタイトルが正しいか確認（ファイル判定）
        if (mb_ereg('医療機関CD', $utf8_data[0][0]) == 1 && mb_ereg('医療機関名', $utf8_data[0][1]) == 1 && mb_ereg('年度', $utf8_data[0][2]) == 1  && mb_ereg('施設区分', $utf8_data[0][3]) == 1 && mb_ereg('日付', $utf8_data[0][4]) == 1 && mb_ereg('方法', $utf8_data[0][5]) == 1 && mb_ereg('連携機関対応者部署', $utf8_data[0][6]) == 1 && mb_ereg('連携機関対応者役職', $utf8_data[0][7]) == 1 && mb_ereg('連携機関対応者氏名', $utf8_data[0][8]) == 1 && mb_ereg('連携機関対応人数・氏名', $utf8_data[0][9]) == 1 && mb_ereg('当院対応者所属', $utf8_data[0][10]) == 1 && mb_ereg('当院対応者氏名', $utf8_data[0][11]) == 1 && mb_ereg('当院対応人数・氏名', $utf8_data[0][12]) == 1 && mb_ereg('内容', $utf8_data[0][13]) == 1 && mb_ereg('備考', $utf8_data[0][14]) == 1 && mb_ereg('データ作成部署', $utf8_data[0][15]) == 1 ){                      
            // TSVデータをセッションに保存
            $_SESSION['csv_data'] = $utf8_data;
        }else{
            $errors[] = "・カラム名が正しくありません。";
        }

            // CSVデータの1行目をスキップ
        /* $tsv_data = array_slice($tsv_data, 1); */

        // 日付のカラムインデックス（例: 4番目のカラムが日付の場合）
        $dateIndex = null;
        $dateIndex = 4;

        $minDate = null;
        $maxDate = null;
        
       // 最小日付と最大日付を取得（1行目スキップ）
        $utf8_data = array_slice($utf8_data, 1);

        $minDate = null;
        $maxDate = null;

        foreach ($utf8_data as $row) {
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
       
        
        // **エラーチェック**
        if ($minDate === null || $maxDate === null) {
            $errors[] = "日付がありません";
        }

        // **日付フォーマット(年月形式)**
        $minYearMonth = ($minDate !== null) ? date('Y-m', strtotime($minDate)) : null;
        $maxYearMonth = ($maxDate !== null) ? date('Y-m', strtotime($maxDate)) : null;

        
        // **日付フォーマット（年月日形式）**
        $minDate = ($minDate !== null && strpos($minDate, '/') !== false)
            ? sprintf("%d年%d月%d日", ...explode('/', $minDate))
            : "日付がありません";
        
        $maxDate = ($maxDate !== null && strpos($maxDate, '/') !== false)
            ? sprintf("%d年%d月%d日", ...explode('/', $maxDate))
            : "日付がありません";

        if($minYearMonth !== $maxYearMonth){
            $errors[] = "期間が１ヵ月ではないため、データを追加できません。";
        }else{
            

/*      $minDate = substr($minDate, 0, 4) . "年" . substr($minDate, 5, 2) . "月" . substr($minDate, 8, 2) . "日";
        $maxDate = substr($maxDate, 0, 4) . "年" . substr($maxDate, 5, 2) . "月" . substr($maxDate, 8, 2) . "日"; */
        


        $check = "<strong><span style='font-size: 20px; font-weight: bold;'>＜　以下の内容を確認してください。　＞</span></strong>
        　・ファイル名を変更する場合は、ファイルを再選択してください。
        　・ファイルの形式が「csv」ではない場合は、ファイルを再選択してください。
        　・ファイルの内容が、「コンタクト履歴データ」であるか確認してください。
        　・重複データが存在している場合、上書きされる可能性があります。
        　・既存データの最新年月は、".$contact_ym."です。
        　・$file_name は、 $minDate ～ $maxDate のデータです。
        　・上記の内容に問題がない場合は、追加ボタンを押してください。";                    



                
        }
        
    } else {
        echo "ファイルがアップロードされていません。";
    }
}


include_once('file_check_month_view.php');
