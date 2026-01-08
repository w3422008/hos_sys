<?php
/**
 * 医療機関登録 - 完了画面
 * 
 * このファイルは insert/inserted_view.php と同じ内容を参照します
 * 既存のビューファイルをそのまま利用できます
 * 
 * 注意：このファイルは insert/ フォルダから inserted_view.php をコピーして使用してください
 */

// ビューファイルが存在しない場合のメッセージ
if (!file_exists('../insert/inserted_view.php')) {
    die('エラー: inserted_view.php が見つかりません。insert フォルダから inserted_view.php をコピーしてください。');
}

// 既存のビューを読み込み
include_once('../insert/inserted_view.php');
?>
