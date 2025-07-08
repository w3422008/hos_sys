<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
   $hos_cd= $_GET['cd'];

$dbh = get_db_connect();

/* 高橋20230224 コンタクト履歴データ */
$contact_data = detail_contact($dbh,$hos_cd);

/* 高橋20230515 プルダウンリスト */
//区分
$list1_contact = array(
   '訪問', '来訪', 'その他'
);
$list2_contact = array(
   '附属病院', '総合医療センター', '高齢者医療センター', '川﨑学園'
);


//ビューview.phpの読み出し
//櫻間
if($user_adm === '1'){
   include_once('./view/contact_view.php');
}elseif($user_adm === '2'){
   include_once('./office_view/office_contact_view.php');
}else{
   include_once('./user_view/user_contact_view.php');

}
//櫻間
