<?php
if(!isset($_SESSION)){ session_start(); }
//session_start();



//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}


//データベース接続
$dbh = get_db_connect();


//櫻間
$user_adm = $_SESSION['member']['adm_user'];

// 診療科目

$data = get_Internal_medicine($dbh);
$data2 = get_pediatrics($dbh);
$data3 = get_surgery($dbh);
$data4 = get_orthopedics($dbh);
$data5 = get_ophthalmology($dbh);
$data6 =get_otolaryngology($dbh);
$data7 = get_dermatology_urology($dbh);
$data8 = get_gynecology($dbh);
$data9 = get_psychiatry($dbh);
$data10 = get_dentistry($dbh);
$data11 = get_etcetera($dbh);

//地域
$data12= get_southeast($dbh);
$data13= get_southwest($dbh);
$data14 = get_takahashi_niimi($dbh);
$data15 = get_maniwa($dbh);
$data16 = get_tuyama_aida($dbh);
$data17 = get_taken($dbh);


//医師会

$data18 =get_d_southeast($dbh);
$data19 =get_d_southwest($dbh);
$data20 =get_d_takahashi_niimi($dbh);
$data21 =get_d_maniwa($dbh);
$data22 =get_d_tuyama_aida($dbh);


//高橋20230414　検索結果⇔詳細のpageid　セッションunset
   if(isset($_SESSION['page_id'])){ unset($_SESSION['page_id']); }


//ビューview.phpの読み出し
//櫻間（修正：20250531加藤）
if($user_adm === '1' || $user_adm === '2' || $user_adm === '3'){
    include_once('search_view.php');
}else{
    include_once('user_search_view.php');
}
