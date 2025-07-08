<?php
require_once('../functions.php');
require_once('../config.php');

session_start();

// DB接続
$dbh = get_db_connect();

// 各病院の部署名をJavascriptで使用できるように変換
// 附属病院
$json_user_bel=json_encode($user_bel);
// 総合医療センター
$json_center_bel=json_encode($center_bel);
// 高齢者医療センター
$json_old_bel=json_encode($kourei_bel);

// ログイン中ユーザの権限を取得
// 0：一般
// 1：管理者
// 2：事務
// 3：システム管理者
$adm_id = $_SESSION['member']['adm_user'];

if($adm_id == 3){

    // システム管理者 ⇒ 全ての問い合わせ内容を取得
    $user_id = "";

}else{

    // 一般/事務/管理者 ⇒ 自分の所属部署の問い合わせ内容を取得
    $user_id = $_SESSION['member']['user_id'];

}

// 画面遷移
include_once('./history_view.php');