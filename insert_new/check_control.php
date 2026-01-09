<?php
/**
 * 医療機関登録 - チェック処理
 * POSTデータを受け取り、セッションに保存して確認画面へ遷移
 */

require_once('../functions.php');
require_once('./InsertProcessor.php');

session_start();

// ログイン確認
if (empty($_SESSION['member'])) {
    header('Location:' . SITE_URL . 'index.php');
    exit();
}

$dbh = get_db_connect();
$user_adm = $_SESSION['member']['adm_user'];

// POSTデータを処理
$processor = new InsertProcessor($dbh, $user_adm);
$processor->parsePostData($_POST);

// セッションに構造化されたデータを保存
$_SESSION['insert'] = $processor->getData();

// バリデーション実行
if (!$processor->validate()) {
    $_SESSION['insert']['err'] = implode('、', $processor->getErrors());
}

// 地域マスタ情報取得（ビューで必要）
$are_cds = get_area($dbh);

// ビュー用に配列を展開（互換性維持）
extract($processor->getExtractArray());
var_dump($processor->getExtractArray());
// 確認ビューを表示
include_once('./check_view.php');
?>