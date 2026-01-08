<?php
/**
 * 医療機関登録 - 実行処理
 * セッションのデータをDBに登録し、ログを記録
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

// 以下、既存のinserted_control.phpの処理を実装
// （DBへの登録処理は元のファイルと同じロジックを使用）

// 変数を展開（互換性）
extract($basic);
extract($schedule);
extract($medical);
extract($director);
extract($relations);
extract($fields);
extract($cooperation);
extract($social_meeting);

// ★ 基本情報をDBに登録
$sql = "INSERT INTO main (hos_cd, hos_div, op_flg, clo_day, med_ass, are_cd, hos_name, zipcode, area, pre, city, zone, town, str_num, tel, fax, mail, note, reg_date, mod_date, adm_user) 
        VALUES (:hos_cd, :hos_div, :op_flg, :clo_day, :med_ass, :are_cd, :hos_name, :zipcode, :area, :pre, :city, :zone, :town, :str_num, :tel, :fax, :mail, :note, NOW(), NOW(), :adm_user)";

$stmt = $dbh->prepare($sql);
$stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
$stmt->bindValue(':hos_div', $hos_div, PDO::PARAM_STR);
$stmt->bindValue(':op_flg', $op_flg, PDO::PARAM_STR);
$stmt->bindValue(':clo_day', $clo_day !== '' ? $clo_day : null, $clo_day !== '' ? PDO::PARAM_STR : PDO::PARAM_NULL);
$stmt->bindValue(':med_ass', $med_ass, PDO::PARAM_STR);
$stmt->bindValue(':are_cd', $are_cd, PDO::PARAM_STR);
$stmt->bindValue(':hos_name', $hos_name, PDO::PARAM_STR);
$stmt->bindValue(':zipcode', $zipcode, PDO::PARAM_STR);
$stmt->bindValue(':area', $area, PDO::PARAM_STR);
$stmt->bindValue(':pre', $pre, PDO::PARAM_STR);
$stmt->bindValue(':city', $city, PDO::PARAM_STR);
$stmt->bindValue(':zone', $zone, PDO::PARAM_STR);
$stmt->bindValue(':town', $town, PDO::PARAM_STR);
$stmt->bindValue(':str_num', $str_num, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':fax', $fax, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':note', $note, PDO::PARAM_STR);
$stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_STR);

$stmt->execute();

// 挿入されたレコードのIDを取得
$last_id = $dbh->lastInsertId();

// ★ 診療時間をDBに登録
$diagnosis_sql = "INSERT INTO diagnosis (hos_id, mon_am, mon_pm, tue_am, tue_pm, wed_am, wed_pm, thr_am, thr_pm, fri_am, fri_pm, sat_am, sat_pm, sun_am, sun_pm, holiday, con_hour, reg_date, mod_date, adm_user)
                  VALUES (:hos_id, :mon_am, :mon_pm, :tue_am, :tue_pm, :wed_am, :wed_pm, :thr_am, :thr_pm, :fri_am, :fri_pm, :sat_am, :sat_pm, :sun_am, :sun_pm, :holiday, :con_hour, NOW(), NOW(), :adm_user)";

$diagnosis_stmt = $dbh->prepare($diagnosis_sql);
$diagnosis_stmt->bindValue(':hos_id', $last_id, PDO::PARAM_INT);
$diagnosis_stmt->bindValue(':mon_am', $mon_am ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':mon_pm', $mon_pm ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':tue_am', $tue_am ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':tue_pm', $tue_pm ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':wed_am', $wed_am ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':wed_pm', $wed_pm ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':thr_am', $thr_am ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':thr_pm', $thr_pm ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':fri_am', $fri_am ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':fri_pm', $fri_pm ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':sat_am', $sat_am ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':sat_pm', $sat_pm ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':sun_am', $sun_am ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':sun_pm', $sun_pm ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':holiday', $holiday ?? '×', PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':con_hour', $con_hour, PDO::PARAM_STR);
$diagnosis_stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_STR);
$diagnosis_stmt->execute();

// ★ 医療内容をDBに登録
$medical_sql = "INSERT INTO medical (hos_id, int_int, int_dig, int_uri, int_tum, int_res, int_kid, int_blo, int_apo, int_cir, int_ner, int_inf,
                ped_ped, ped_sur, ped_neo, sur_sur, sur_lac, sur_ner, sur_nes, sur_dig, sur_car, sur_ven,
                ort_rhe, ort_cos, ort_ort, ort_reh, ort_pla, oph_oph, ent_ent, ent_to, so_sky, so_org,
                gyn_gyn, gyn_obs, gyn_gyne, psy_psy, psy_psyc, den_den, den_cav, den_ref, den_ped,
                alle, pat, checkup, rad, cli, ane, eme, bed, bed_main, bed_tre, bed_reh, bed_care, bed_tra, bed_att, pt, ot, st, reg_date, mod_date, adm_user)
                VALUES (:hos_id, :int_int, :int_dig, :int_uri, :int_tum, :int_res, :int_kid, :int_blo, :int_apo, :int_cir, :int_ner, :int_inf,
                :ped_ped, :ped_sur, :ped_neo, :sur_sur, :sur_lac, :sur_ner, :sur_nes, :sur_dig, :sur_car, :sur_ven,
                :ort_rhe, :ort_cos, :ort_ort, :ort_reh, :ort_pla, :oph_oph, :ent_ent, :ent_to, :so_sky, :so_org,
                :gyn_gyn, :gyn_obs, :gyn_gyne, :psy_psy, :psy_psyc, :den_den, :den_cav, :den_ref, :den_ped,
                :alle, :pat, :checkup, :rad, :cli, :ane, :eme, :bed, :bed_main, :bed_tre, :bed_reh, :bed_care, :bed_tra, :bed_att, :pt, :ot, :st, NOW(), NOW(), :adm_user)";

$medical_stmt = $dbh->prepare($medical_sql);
$medical_stmt->bindValue(':hos_id', $last_id, PDO::PARAM_INT);

// 医療内容の全フィールドをバインド
$medicalFields = [
    'int_int', 'int_dig', 'int_uri', 'int_tum', 'int_res', 'int_kid', 'int_blo', 'int_apo', 'int_cir', 'int_ner', 'int_inf',
    'ped_ped', 'ped_sur', 'ped_neo', 'sur_sur', 'sur_lac', 'sur_ner', 'sur_nes', 'sur_dig', 'sur_car', 'sur_ven',
    'ort_rhe', 'ort_cos', 'ort_ort', 'ort_reh', 'ort_pla', 'oph_oph', 'ent_ent', 'ent_to', 'so_sky', 'so_org',
    'gyn_gyn', 'gyn_obs', 'gyn_gyne', 'psy_psy', 'psy_psyc', 'den_den', 'den_cav', 'den_ref', 'den_ped',
    'alle', 'pat', 'checkup', 'rad', 'cli', 'ane', 'eme', 'bed', 'bed_main', 'bed_tre', 'bed_reh', 'bed_care', 'bed_tra', 'bed_att', 'pt', 'ot', 'st'
];

foreach ($medicalFields as $field) {
    $medical_stmt->bindValue(':' . $field, $$field ?? '', PDO::PARAM_STR);
}

$medical_stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_STR);
$medical_stmt->execute();

// ★ 理事長・病院長情報をDBに登録
$director_sql = "INSERT INTO director (hos_id, chi_name, chi_spe, chi_year, chi_sch, chi_note, pre_name, pre_spe, pre_year, pre_sch, pre_note, reg_date, mod_date, adm_user)
                 VALUES (:hos_id, :chi_name, :chi_spe, :chi_year, :chi_sch, :chi_note, :pre_name, :pre_spe, :pre_year, :pre_sch, :pre_note, NOW(), NOW(), :adm_user)";

$director_stmt = $dbh->prepare($director_sql);
$director_stmt->bindValue(':hos_id', $last_id, PDO::PARAM_INT);
$director_stmt->bindValue(':chi_name', $chi_name ?? '', PDO::PARAM_STR);
$director_stmt->bindValue(':chi_spe', $chi_spe ?? '', PDO::PARAM_STR);
$director_stmt->bindValue(':chi_year', $chi_year ?? '', PDO::PARAM_STR);
$director_stmt->bindValue(':chi_sch', $chi_sch ?? '', PDO::PARAM_STR);
$director_stmt->bindValue(':chi_note', $chi_note ?? '', PDO::PARAM_STR);
$director_stmt->bindValue(':pre_name', $pre_name ?? '', PDO::PARAM_STR);
$director_stmt->bindValue(':pre_spe', $pre_spe ?? '', PDO::PARAM_STR);
$director_stmt->bindValue(':pre_year', $pre_year ?? '', PDO::PARAM_STR);
$director_stmt->bindValue(':pre_sch', $pre_sch ?? '', PDO::PARAM_STR);
$director_stmt->bindValue(':pre_note', $pre_note ?? '', PDO::PARAM_STR);
$director_stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_STR);
$director_stmt->execute();

// ★ 親族情報をDBに登録
if (!empty($rel_insert) && is_array($rel_insert)) {
    $rel_sql = "INSERT INTO relations (hos_id, rel_name, rel_div, rel_year, rel_spe, reg_date, mod_date, adm_user)
                VALUES (:hos_id, :rel_name, :rel_div, :rel_year, :rel_spe, NOW(), NOW(), :adm_user)";
    
    $rel_stmt = $dbh->prepare($rel_sql);
    
    foreach ($rel_insert as $relation) {
        $rel_stmt->bindValue(':hos_id', $last_id, PDO::PARAM_INT);
        $rel_stmt->bindValue(':rel_name', $relation['rel_name'] ?? '', PDO::PARAM_STR);
        $rel_stmt->bindValue(':rel_div', $relation['rel_div'] ?? '', PDO::PARAM_STR);
        $rel_stmt->bindValue(':rel_year', $relation['rel_year'] ?? '', PDO::PARAM_STR);
        $rel_stmt->bindValue(':rel_spe', $relation['rel_spe'] ?? '', PDO::PARAM_STR);
        $rel_stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_STR);
        $rel_stmt->execute();
    }
}

// ★ 部門連絡先をDBに登録
if (!empty($fie_insert) && is_array($fie_insert)) {
    $fie_sql = "INSERT INTO fields (hos_id, fie_name, fie_tel, fie_fax, fie_mail, reg_date, mod_date, adm_user)
                VALUES (:hos_id, :fie_name, :fie_tel, :fie_fax, :fie_mail, NOW(), NOW(), :adm_user)";
    
    $fie_stmt = $dbh->prepare($fie_sql);
    
    foreach ($fie_insert as $field) {
        $fie_stmt->bindValue(':hos_id', $last_id, PDO::PARAM_INT);
        $fie_stmt->bindValue(':fie_name', $field['fie_name'] ?? '', PDO::PARAM_STR);
        $fie_stmt->bindValue(':fie_tel', $field['fie_tel'] ?? '', PDO::PARAM_STR);
        $fie_stmt->bindValue(':fie_fax', $field['fie_fax'] ?? '', PDO::PARAM_STR);
        $fie_stmt->bindValue(':fie_mail', $field['fie_mail'] ?? '', PDO::PARAM_STR);
        $fie_stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_STR);
        $fie_stmt->execute();
    }
}

// ★ 医療連携情報をDBに登録
$cooperation_sql = "INSERT INTO cooperation (hos_id, intr_note, tra_note, carna, coop_note, con_note, mcare_note, reg_date, mod_date, adm_user)
                    VALUES (:hos_id, :intr_note, :tra_note, :carna, :coop_note, :con_note, :mcare_note, NOW(), NOW(), :adm_user)";

$cooperation_stmt = $dbh->prepare($cooperation_sql);
$cooperation_stmt->bindValue(':hos_id', $last_id, PDO::PARAM_INT);
$cooperation_stmt->bindValue(':intr_note', $intr_note ?? '', PDO::PARAM_STR);
$cooperation_stmt->bindValue(':tra_note', $tra_note ?? '', PDO::PARAM_STR);
$cooperation_stmt->bindValue(':carna', $carna ?? '', PDO::PARAM_STR);
$cooperation_stmt->bindValue(':coop_note', $coop_note ?? '', PDO::PARAM_STR);
$cooperation_stmt->bindValue(':con_note', $con_note ?? '', PDO::PARAM_STR);
$cooperation_stmt->bindValue(':mcare_note', $mcare_note ?? '', PDO::PARAM_STR);
$cooperation_stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_STR);
$cooperation_stmt->execute();

// ★ 医療連携懇話会情報をDBに登録
if (isset($kurashiki_sm) && !empty($kurashiki_sm)) {
    $socialmeeting_sql = "INSERT INTO social_meeting (hos_id, area_cd, year, reg_date, mod_date, adm_user)
                          VALUES (:hos_id, :area_cd, :year, NOW(), NOW(), :adm_user)";
    
    $socialmeeting_stmt = $dbh->prepare($socialmeeting_sql);
    
    foreach ($kurashiki_sm as $year) {
        $socialmeeting_stmt->bindValue(':hos_id', $last_id, PDO::PARAM_INT);
        $socialmeeting_stmt->bindValue(':area_cd', '1', PDO::PARAM_STR);
        $socialmeeting_stmt->bindValue(':year', $year, PDO::PARAM_STR);
        $socialmeeting_stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_STR);
        $socialmeeting_stmt->execute();
    }
}

// ★ ログを記録
$insert_log_sql = "INSERT INTO insert_log (hos_cd, hos_name, item, ymd, adm_user)
                   VALUES (:hos_cd, :hos_name, '新規追加', NOW(), :adm_user)";

$insert_log_stmt = $dbh->prepare($insert_log_sql);
$insert_log_stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
$insert_log_stmt->bindValue(':hos_name', $hos_name, PDO::PARAM_STR);
$insert_log_stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_STR);
$insert_log_stmt->execute();

// セッションをクリア
unset($_SESSION['insert']);

// 完了画面へ遷移
include_once('./inserted_view.php');
?>
