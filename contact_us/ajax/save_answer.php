<?php
// 管理者用
// 依頼内容の登録・変更を行う
session_start();

require_once('../../functions.php');

// データベース接続
$dbh = get_db_connect();

// ユーザ情報を取得
$user_id = $_SESSION['member']['user_id'];

// ユーザの職員番号・依頼番号を取得
$history = $_POST['history'] ?? null;
$que_id = $_POST['que_id'];

if(isset($history)){
    
    // 既に依頼されていた内容を変更する場合
    $order_answer = html_escape($_POST['order']);
    $advisability = null;
    $supp_status = null;
    $db_adv = null;

}else{
    
    // 新たに依頼する内容を登録する場合
    $order_answer = html_escape($_POST['answer']);
    $advisability = $_POST['advisability'];
    $supp_status = $_POST['supp_status'];
    $db_adv=111;
    if(mb_strlen($_POST['db_adv'])!==0){
        $db_adv=$_POST['db_adv'];
    }

}

update_rep_message($user_id,$que_id,$order_answer,$advisability,$supp_status,$db_adv,$history,$dbh);

?>