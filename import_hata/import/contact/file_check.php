<?php

require_once('../../config.php');
require_once('../../functions.php');

session_start();

$dbh = get_db_connect();

$contact_ym = get_contact_ym($dbh);
$contact_ym = empty($contact_ym) ? 'データなし' : substr($contact_ym, 0, 4) . "年" . substr($contact_ym, 5, 2) . "月";

$contactB_ym = get_contactB_ym($dbh);
$contactB_ym = empty($contactB_ym) ? 'データなし' : substr($contactB_ym, 0, 4) . "年" . substr($contactB_ym, 5, 2) . "月";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ファイルが正しくアップロードされたか確認
    if (isset($_FILES["filename"]) && $_FILES["filename"]["error"] == 0) {
        // アップロードされたファイルの情報を取得
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

        // Excelファイルのタイトルが正しいか確認（ファイル判定）
        if (mb_ereg('医療機関CD', $csv_data[0][0]) == 1 && mb_ereg('医療機関名', $csv_data[0][1]) == 1 && mb_ereg('年度', $csv_data[0][2]) == 1 && mb_ereg('施設区分', $csv_data[0][3]) == 1 && mb_ereg('日付', $csv_data[0][4]) == 1 && mb_ereg('方法', $csv_data[0][5]) == 1 && mb_ereg('連携機関対応者部署', $csv_data[0][6]) == 1 && mb_ereg('連携機関対応者役職', $csv_data[0][7]) == 1 && mb_ereg('連携機関対応者氏名', $csv_data[0][8]) == 1 && mb_ereg('連携機関対応人数・氏名', $csv_data[0][9]) == 1 && mb_ereg('当院対応者所属', $csv_data[0][10]) == 1 && mb_ereg('当院対応者氏名', $csv_data[0][11]) == 1 && mb_ereg('当院対応人数・氏名', $csv_data[0][12]) == 1 && mb_ereg('内容', $csv_data[0][13]) == 1 && mb_ereg('備考', $csv_data[0][14]) == 1 && mb_ereg('データ作成部署', $csv_data[0][15]) == 1) {
            // CSVデータをセッションに保存
            $_SESSION['csv_data'] = $csv_data;
        } else {
            $errors[] = "・カラム名が正しくありません。";
        }

        // 日付のカラムインデックス（例: 4番目のカラムが日付の場合）
        $dateIndex = 4;

        $minDate = null;
        $maxDate = null;

        // 最小日付と最大日付を取得（1行目スキップ）
        $csv_data = array_slice($csv_data, 1);

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

        // **エラーチェック**
        if ($minDate === null || $maxDate === null) {
            $errors[] = "日付がありません";
        }

        // **日付フォーマット(年月形式)**
        $minYearMonth = ($minDate !== null) ? date('Y-m', strtotime($minDate)) : null;
        $maxYearMonth = ($maxDate !== null) ? date('Y-m', strtotime($maxDate)) : null;
        $_SESSION['minYearMonth'] = $minYearMonth;
        $_SESSION['maxYearMonth'] = $maxYearMonth;

        // **日付フォーマット（年月日形式）**
        $minDate = ($minDate !== null && strpos($minDate, '/') !== false)
            ? sprintf("%d年%d月%d日", ...explode('/', $minDate))
            : "日付がありません";

        $maxDate = ($maxDate !== null && strpos($maxDate, '/') !== false)
            ? sprintf("%d年%d月%d日", ...explode('/', $maxDate))
            : "日付がありません";

        if ($minYearMonth == $maxYearMonth) {
            $errors[] = "期間が１ヵ月のため、１ヵ月用のインポート機能を使用してください。";
        } else {
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
var_dump($minYearMonth);
var_dump($maxYearMonth);

}

include_once('file_check_view.php');
?>