<?php
/**
 * 医療機関登録 - 実行処理
 * セッションのデータをDBに登録し、ログを記録
 * オリジナルのinsert/inserted_control.phpの機能をすべて保持した最適化版
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
$user_id = $_SESSION['member']['user_id'];

// セッションからデータを取得
if (empty($_SESSION['insert'])) {
    header('Location:' . SITE_URL . 'insert/insert_header.php');
    exit();
}

// データを取得
$data = $_SESSION['insert'];

// ビュー用に配列を展開（互換性維持）
$basic = $data['basic'] ?? [];
$schedule = $data['schedule'] ?? [];
$medical = $data['medical'] ?? [];
$director = $data['director'] ?? [];
$relations = $data['relations'] ?? [];
$fields = $data['fields'] ?? [];
$cooperation = $data['cooperation'] ?? [];
$social_meeting = $data['social_meeting'] ?? [];

// 全データを展開
extract($basic);
extract($schedule);
extract($medical);
extract($director);
extract($relations);
extract($fields);
extract($cooperation);
extract($social_meeting);

// ユーザー情報の取得
$datetime = date('Y-m-d H:i:s');
$insert_log = $datetime;
$user_data = insert_userlog($dbh, $user_id);
foreach ($user_data as $var) {
    $user_name = $var['user_name'];
    $ins = $var['ins'];
    $bel = $var['bel'];
    $adm_user = $var['adm_user'];
}

// 記入されないもの
$ad = $city . $zone . $town . $str_num;
$onf = 0;
$log_data = "";
$log_name = "";

// ★ 基本情報・診療時間・診療科目・理事長病院長情報をDBに登録
insert_hos(
    $dbh, $op_flg, $med_ass, $hos_div, $hos_cd, $hos_name, $zipcode, $ad, $tel, $fax, $mail,
    $are_cd, $pre, $area, $city, $zone, $town, $str_num, $note, $clo_day,
    $chi_name, $chi_spe, $chi_year, $chi_sch, $chi_note,
    $pre_name, $pre_spe, $pre_year, $pre_sch, $pre_note,
    $con_hour, $mon_am, $mon_pm, $tue_am, $tue_pm, $wed_am, $wed_pm, $thr_am, $thr_pm, $fri_am, $fri_pm, $sat_am, $sat_pm, $sun_am, $sun_pm, $holiday,
    $int_med, $ped_med, $sur_med, $ort_med, $oph_med, $ent_med, $so_med, $gyn_med, $psy_med, $den_med, $etc_med,
    $int_int, $int_dig, $int_uri, $int_tum, $int_res, $int_kid, $int_blo, $int_apo, $int_cir, $int_ner, $int_inf,
    $ped_ped, $ped_sur, $ped_neo,
    $sur_sur, $sur_lac, $sur_ner, $sur_nes, $sur_dig, $sur_car, $sur_ven,
    $ort_rhe, $ort_cos, $ort_ort, $ort_reh, $ort_pla,
    $oph_oph, $ent_ent, $ent_to, $so_sky, $so_org,
    $gyn_gyn, $gyn_obs, $gyn_gyne, $psy_psy, $psy_psyc,
    $den_den, $den_cav, $den_ref, $den_ped,
    $alle, $pat, $checkup, $rad, $cli, $ane, $eme,
    $bed, $bed_reh, $bed_tre, $bed_main, $bed_care, $bed_tra, $bed_att, $pt, $ot, $st,
    $onf, $dep_note, $num_note, $drct_note, $intr_note, $tra_note, $coop_note, $con_note, $log_data, $log_name
);

// ★ 親族情報をDBに登録
if (!empty($rel_insert) && is_array($rel_insert)) {
    foreach ($rel_insert as $relation) {
        rel_rowInsert(
            $dbh, $hos_cd,
            $relation['name'] ?? '',
            $relation['conn'] ?? '',
            $relation['sch_name'] ?? '',
            $relation['ent_year'] ?? '',
            $relation['gra_year'] ?? '',
            $relation['rel_note'] ?? ''
        );
    }
}

// ★ 部門連絡先をDBに登録
if (!empty($fie_insert) && is_array($fie_insert)) {
    foreach ($fie_insert as $field) {
        fie_rowInsert(
            $dbh, $hos_cd, $hos_name,
            $field['fie_div'] ?? '',
            $field['fie_name'] ?? '',
            $field['fie_tel'] ?? '',
            $field['fie_fax'] ?? '',
            $field['fie_note'] ?? ''
        );
    }
}

// ★ 医療連携情報をDBに登録
// 7-1 カルナコネクト
if (isset($carna) && $carna === '1') {
    carna_Insert($dbh, $hos_cd);
}

// 7-2 連携パス
if (!empty($kurashiki_path)) {
    path_Insert($dbh, $hos_cd, 0, $kurashiki_path);
}
if (!empty($okayama_path)) {
    path_Insert($dbh, $hos_cd, 1, $okayama_path);
}

// 7-3 医療連携懇話会 参加年度
// 附属病院
sm_Delete($dbh, $hos_cd, 0);
if (!empty($kurashiki_sm)) {
    foreach ($kurashiki_sm as $sm) {
        sm_Insert($dbh, $hos_cd, 0, trim($sm));
    }
}
// 総合医療センター
sm_Delete($dbh, $hos_cd, 1);
if (!empty($okayama1_sm)) {
    foreach ($okayama1_sm as $sm) {
        sm_Insert($dbh, $hos_cd, 1, trim($sm));
    }
}
// 高齢者医療センター
sm_Delete($dbh, $hos_cd, 2);
if (!empty($okayama2_sm)) {
    foreach ($okayama2_sm as $sm) {
        sm_Insert($dbh, $hos_cd, 2, trim($sm));
    }
}

// ★ 診療内容
medcare_Insert($dbh, $hos_cd, $med_care, $mcare_note);

// ★ ログを記録
log_new($dbh, $hos_cd, $hos_name, $insert_log, $user_name, $user_id, $ins, $bel, $adm_user);

// セッションをクリア
unset($_SESSION['insert']);

// 完了画面へ遷移
include_once('./inserted_view.php');
?>
