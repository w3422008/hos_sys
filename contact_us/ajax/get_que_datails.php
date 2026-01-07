<?php
// 画面読み込み時、依頼されたデータを取得する
require_once('../../functions.php');

// データベースに接続
$dbh = get_db_connect();
$result = [];

if(isset($_POST['user_id'])) {

    // ユーザー（依頼履歴）　データ取得
    $user_id = $_POST['user_id'];
    $adm_id = $_POST['adm_id'];

    if($adm_id == 3){

        // システム管理者（依頼一覧）　データ取得
        $result = get_request_data($dbh,'0000','0000');
        
    }else{

        // ユーザーの所属先を取得
        // $user_data = array();
        // $user_data = user_info($dbh,$user_id);

        // // ユーザーからの依頼情報を取得

        // $result = get_request_data($dbh,$user_data[0]['ins'],$user_data[0]['bel']);

        $result = get_request_data($dbh,'0000','0000');
    }

    // JSON形式で出力
    echo json_encode($result);

}else {
    echo json_encode(['error' => 'Invalid request']);
}
