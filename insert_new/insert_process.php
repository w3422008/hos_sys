<?php
/**
 * 医療機関登録処理
 * セッションのデータをDBに登録する専用ファイル
 * check_view.phpのfetchから呼び出される
 * ※元ファイル(insert/inserted_control.php)の処理に忠実
 */

// エラー出力を抑制（JSONを返すため）
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set('log_errors', 1);

require_once('../functions.php');
session_start();

header('Content-Type: application/json; charset=utf-8');

if (empty($_SESSION['member']) || empty($_SESSION['insert'])) {
    echo json_encode(['success' => false, 'error' => 'ログインまたはセッションデータがありません']);
    exit();
}

try {
    $dbh = get_db_connect();
    $insert = $_SESSION['insert'];
    
    // ユーザー情報取得
    $user_adm = $_SESSION['member']['adm_user'];
    $user_id = $_SESSION['member']['user_id'];
    $insert_log = date('Y-m-d H:i:s');
    $data = insert_userlog($dbh, $user_id);
    foreach($data as $var){
        $user_name = $var['user_name'];
        $ins = $var['ins'];
        $bel = $var['bel'];
        $adm_user = $var['adm_user']; 
    }

    // 住所組み立て
    $ad = ($insert['city'] ?? '') . ($insert['zone'] ?? '') . ($insert['town'] ?? '') . ($insert['str_num'] ?? '');
    $onf = 0;

    // ★ 既存レコードの確認と削除（新規登録の場合）
    $hos_cd = $insert['hos_cd'] ?? null;
    if (!empty($hos_cd)) {
        $sql = "SELECT COUNT(*) as cnt FROM main WHERE hos_cd = :hos_cd";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // 既存レコードがあれば削除（新規登録フローの場合）
        if ($row['cnt'] > 0) {
            $delSql = "DELETE FROM main WHERE hos_cd = :hos_cd";
            $delStmt = $dbh->prepare($delSql);
            $delStmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
            $delStmt->execute();
        }
    }

    // DB登録処理
    insert_hos(
        $dbh, $insert['op_flg'] ?? null, $insert['med_ass'] ?? null, $insert['hos_div'] ?? null, $insert['hos_cd'] ?? null, 
        $insert['hos_name'] ?? null, $insert['zipcode'] ?? null, $ad, $insert['tel'] ?? null, $insert['fax'] ?? null, 
        $insert['mail'] ?? null, $insert['are_cd'] ?? null, $insert['pre'] ?? null, $insert['area'] ?? null, 
        $insert['city'] ?? null, $insert['zone'] ?? null, $insert['town'] ?? null, $insert['str_num'] ?? null, 
        $insert['note'] ?? null, $insert['clo_day'] ?? null,
        $insert['chi_name'] ?? null, $insert['chi_spe'] ?? null, $insert['chi_year'] ?? null, $insert['chi_sch'] ?? null, $insert['chi_note'] ?? null,
        $insert['pre_name'] ?? null, $insert['pre_spe'] ?? null, $insert['pre_year'] ?? null, $insert['pre_sch'] ?? null, $insert['pre_note'] ?? null,
        $insert['con_hour'] ?? null, $insert['mon_am'] ?? null, $insert['mon_pm'] ?? null, $insert['tue_am'] ?? null, $insert['tue_pm'] ?? null, 
        $insert['wed_am'] ?? null, $insert['wed_pm'] ?? null, $insert['thr_am'] ?? null, $insert['thr_pm'] ?? null, 
        $insert['fri_am'] ?? null, $insert['fri_pm'] ?? null, $insert['sat_am'] ?? null, $insert['sat_pm'] ?? null, 
        $insert['sun_am'] ?? null, $insert['sun_pm'] ?? null, $insert['holiday'] ?? null,
        $insert['int_med'] ?? null, $insert['ped_med'] ?? null, $insert['sur_med'] ?? null, $insert['ort_med'] ?? null, $insert['oph_med'] ?? null, 
        $insert['ent_med'] ?? null, $insert['so_med'] ?? null, $insert['gyn_med'] ?? null, $insert['psy_med'] ?? null, $insert['den_med'] ?? null, $insert['etc_med'] ?? null,
        $insert['int_int'] ?? null, $insert['int_dig'] ?? null, $insert['int_uri'] ?? null, $insert['int_tum'] ?? null, $insert['int_res'] ?? null, 
        $insert['int_kid'] ?? null, $insert['int_blo'] ?? null, $insert['int_apo'] ?? null, $insert['int_cir'] ?? null, $insert['int_ner'] ?? null, $insert['int_inf'] ?? null,
        $insert['ped_ped'] ?? null, $insert['ped_sur'] ?? null, $insert['ped_neo'] ?? null,
        $insert['sur_sur'] ?? null, $insert['sur_lac'] ?? null, $insert['sur_ner'] ?? null, $insert['sur_nes'] ?? null, $insert['sur_dig'] ?? null, 
        $insert['sur_car'] ?? null, $insert['sur_ven'] ?? null,
        $insert['ort_rhe'] ?? null, $insert['ort_cos'] ?? null, $insert['ort_ort'] ?? null, $insert['ort_reh'] ?? null, $insert['ort_pla'] ?? null,
        $insert['oph_oph'] ?? null, $insert['ent_ent'] ?? null, $insert['ent_to'] ?? null, $insert['so_sky'] ?? null, $insert['so_org'] ?? null,
        $insert['gyn_gyn'] ?? null, $insert['gyn_obs'] ?? null, $insert['gyn_gyne'] ?? null, $insert['psy_psy'] ?? null, $insert['psy_psyc'] ?? null,
        $insert['den_den'] ?? null, $insert['den_cav'] ?? null, $insert['den_ref'] ?? null, $insert['den_ped'] ?? null,
        $insert['alle'] ?? null, $insert['pat'] ?? null, $insert['checkup'] ?? null, $insert['rad'] ?? null, $insert['cli'] ?? null, 
        $insert['ane'] ?? null, $insert['eme'] ?? null,
        $insert['bed'] ?? null, $insert['bed_reh'] ?? null, $insert['bed_tre'] ?? null, $insert['bed_main'] ?? null, $insert['bed_care'] ?? null, 
        $insert['bed_tra'] ?? null, $insert['bed_att'] ?? null, $insert['pt'] ?? null, $insert['ot'] ?? null, $insert['st'] ?? null, 
        $onf, $insert['dep_note'] ?? null, $insert['num_note'] ?? null, $insert['drct_note'] ?? null, 
        $insert['intr_note'] ?? null, $insert['tra_note'] ?? null, $insert['coop_note'] ?? null, $insert['con_note'] ?? null, "", ""
    );

    // 親族情報
    if(!empty($insert['rel_insert']) && is_array($insert['rel_insert'])){
        foreach($insert['rel_insert'] as $rel){
            rel_rowInsert($dbh, $insert['hos_cd'], $rel['name'] ?? null, $rel['conn'] ?? null, $rel['sch_name'] ?? null, $rel['ent_year'] ?? null, $rel['gra_year'] ?? null, $rel['rel_note'] ?? null);
        }
    }

    // 部門連絡先
    if(!empty($insert['fie_insert']) && is_array($insert['fie_insert'])){
        foreach($insert['fie_insert'] as $fie){
            fie_rowInsert($dbh, $insert['hos_cd'], $insert['hos_name'], $fie['fie_div'] ?? null, $fie['fie_name'] ?? null, $fie['fie_tel'] ?? null, $fie['fie_fax'] ?? null, $fie['fie_note'] ?? null);
        }
    }

    // カルナコネクト
    if(isset($insert['carna']) && $insert['carna'] === '1'){
        carna_Insert($dbh, $insert['hos_cd']);
    }

    // 連携パス
    if(!empty($insert['kurashiki_path'])){
        path_Insert($dbh, $insert['hos_cd'], 0, $insert['kurashiki_path']);
    }
    if(!empty($insert['okayama_path'])){
        path_Insert($dbh, $insert['hos_cd'], 1, $insert['okayama_path']);
    }

    // 医療連携懇話会
    sm_Delete($dbh, $insert['hos_cd'], 0);
    if(!empty($insert['kurashiki_sm']) && is_array($insert['kurashiki_sm'])){
        foreach($insert['kurashiki_sm'] as $sm){
            sm_Insert($dbh, $insert['hos_cd'], 0, trim($sm));
        }
    }
    sm_Delete($dbh, $insert['hos_cd'], 1);
    if(!empty($insert['okayama1_sm']) && is_array($insert['okayama1_sm'])){
        foreach($insert['okayama1_sm'] as $sm){
            sm_Insert($dbh, $insert['hos_cd'], 1, trim($sm));
        }
    }
    sm_Delete($dbh, $insert['hos_cd'], 2);
    if(!empty($insert['okayama2_sm']) && is_array($insert['okayama2_sm'])){
        foreach($insert['okayama2_sm'] as $sm){
            sm_Insert($dbh, $insert['hos_cd'], 2, trim($sm));
        }
    }

    // 診療内容
    medcare_Insert($dbh, $insert['hos_cd'], $insert['med_care'] ?? null, $insert['mcare_note'] ?? null);

    // ログ記録
    log_new($dbh, $insert['hos_cd'], $insert['hos_name'], $insert_log, $user_name, $user_id, $ins, $bel, $adm_user);

    unset($_SESSION['insert']);

    echo json_encode(['success' => true, 'message' => '登録完了']);
    exit();

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    exit();
} catch (Error $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    exit();
}
?>
