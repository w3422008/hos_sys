<?php
/**
 * 医療機関登録 - 確認画面
 * 
 * このファイルは insert/check_view.php と同じ内容を参照します
 * 既存のビューファイルをそのまま利用できます
 * 
 * 注意：このファイルは insert/ フォルダから check_view.php と
 * check_view/ フォルダをコピーして使用してください
 */

// ビューファイルが存在しない場合のメッセージ
if (!file_exists('./check_view.php')) {
    die('エラー: check_view.php が見つかりません。insert フォルダから check_view.php をコピーしてください。');
}

// 既存のビューを読み込み
include_once('./check_view.php');
?>
