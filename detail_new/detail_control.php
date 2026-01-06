<?php
// ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
$hos_cd = html_escape($_GET['cd']);
session_start();

if(empty($_SESSION['member'])){
   header('Location:'.SITE_URL.'index.php');
   exit();
}

$_SESSION["hos_cd"] = $hos_cd;
$user_adm = $_SESSION['member']['adm_user'];
$dbh = get_db_connect();

// ユーザータイプを決定
$user_type = ($user_adm == '1' || $user_adm == '3') ? 'admin' : (($user_adm == '2') ? 'office' : 'user');

// 編集可能フラグ（admin のみ true）
$is_editable = ($user_type === 'admin');

// セッション処理
if(isset($_SESSION['update'])){
   unset($_SESSION['update']);
}

// ページングの保持
if(isset($_GET['page_id'])){
   $_SESSION['page_id'] = $_GET['page_id'];
   $page_id = $_SESSION['page_id'];
}else{
   $page_id = 1;
}

// ===== 基本データ読込み =====
$data = detail($dbh, $hos_cd);

// 地域マスタ情報取得
$are_cds = get_area($dbh);

// ===== 管理者のみ必要なデータ =====
if($user_type === 'admin'){
   $datalist_ass = get_ass($dbh);
}

// ===== 基本情報 (Basic) =====
$datalist_ass = get_ass($dbh);

// ===== 連絡先情報 (Contact) =====
$contact_data = detail_contact($dbh, $hos_cd);

// ===== 部門情報 (Department) =====
$dept_data = get_Internal_medicine($dbh);
$dept_data2 = get_pediatrics($dbh);
$dept_data3 = get_surgery($dbh);
$dept_data4 = get_orthopedics($dbh);
$dept_data5 = get_ophthalmology($dbh);
$dept_data6 =get_otolaryngology($dbh);
$dept_data7 = get_dermatology_urology($dbh);
$dept_data8 = get_gynecology($dbh);
$dept_data9 = get_psychiatry($dbh);
$dept_data10 = get_dentistry($dbh);
$dept_data11 = get_etcetera($dbh);

// ===== 診療科目情報 (Medical) =====
$medical_data = detail_medCare($dbh, $hos_cd);
$medCare_all = medCare($dbh, '全般');
$medCare_naika = medCare($dbh, '内科系');
$medCare_geka = medCare($dbh, '外科系');

$med_depts = array( 
  '全般'
  => array('各種治療','在宅診療内容','各種検査'),
  '内科系'
  => array(
   '消化器内科', '呼吸器内科', '精神科・神経科・診療内科', 
   '内分泌・糖尿病（代謝内科）', '（脳）神経内科・脳卒中内科', '腎臓内科', 
   '小児科', '循環器内科' ),
  '外科系'
  => array(
   '外科', '呼吸器外科', '腎臓移植外科', 
   '乳腺外科', '泌尿器科', '耳鼻咽喉科', 
   '歯科・口腔外科', '整形外科・リハビリ・リウマチ科', 
   '脳神経外科', '形成外科', '産婦人科', 
   '皮膚科', '眼科' ),
);

// ===== 病床数情報 (Number) =====
$num_data = detail_num($dbh, $hos_cd);

// 区分リスト
$list_fie_div = array(
   '外来',
   '連携',
   'その他'
);

// ===== 理事長・病院長情報情報 (Director) =====
$drct_data1 = detail_director($dbh, $hos_cd);  // 理事長・病院長情報
$drct_data2 = detail_relative($dbh, $hos_cd);  // 親族情報

//学校名
$list_sch_name = array(
    0 => '川崎医科大学',
    1 => '医療福祉大学',
    2 => '医療短期大学',
    3 => '附属高校',
    4 => 'リハビリテーション学院'
);

//続柄
$list_conn = array(
    0 => '親',
    1 => '配偶者',
    2 => '弟・姉妹',
    3 => '子',
    4 => '孫',
    5 => 'その他'
);
    
// 学校名リスト
$datalist_dept=get_depa($dbh);

// ===== 紹介・逆紹介情報 (Introduction) =====
$intr_data = detail_intr($dbh, $hos_cd);
$intr_sum = SUMs_intr($dbh, $hos_cd);
$invintr_data = detail_invintr($dbh, $hos_cd);
$invintr_sum = SUMs_invintr($dbh, $hos_cd);

// 過去10年配列取得
$Years = get_10Years();

// ===== 院外支援・研修情報 (Support) =====
$training_data = detail_training($dbh, $hos_cd);

// ===== 連携情報 (Relation) =====
$carna_data = detail_carna($dbh, $hos_cd);
$cPath_data1 = detail_cPath($dbh, $hos_cd, 0);
$cPath_data2 = detail_cPath($dbh, $hos_cd, 1);
$socialMeeting_data1 = detail_socialMeeting($dbh, $hos_cd, 0);
$socialMeeting_data2 = detail_socialMeeting($dbh, $hos_cd, 1);
$socialMeeting_data3 = detail_socialMeeting($dbh, $hos_cd, 2);

// 連携パス配列定義（固定値）
$CorpPath = array(
   '入退院支援連携先病院',
   '脳卒中パス',
   '大腿骨パス',
   '心筋梗塞・心不全パス',
   '胃がんパス',
   '大腸がんパス',
   '乳がんパス',
   '肺がんパス',
   '肝がんパス',
);

// テンプレート読み込み
include_once('header_detail.php');
?>
