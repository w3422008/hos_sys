<?php
require_once('../functions.php');
session_start();

if(empty($_SESSION['member'])) {
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$dbh = get_db_connect();

// ★ POST データをセッションに保存
$_SESSION['insert'] = [];

// 基本情報
$_SESSION['insert']['hos_cd'] = $_POST['hos_cd'] ?? '';
$_SESSION['insert']['op_flg'] = $_POST['op_flg'] ?? '';
$_SESSION['insert']['hos_div'] = $_POST['hos_div'] ?? '';
$_SESSION['insert']['hos_name'] = $_POST['hos_name'] ?? '';
$_SESSION['insert']['med_ass'] = $_POST['med_ass'] ?? '';
$_SESSION['insert']['zipcode'] = $_POST['zipcode'] ?? '';
$_SESSION['insert']['pre'] = $_POST['pre'] ?? '';
$_SESSION['insert']['city'] = $_POST['city'] ?? '';
$_SESSION['insert']['zone'] = $_POST['zone'] ?? '';
$_SESSION['insert']['town'] = $_POST['town'] ?? '';
$_SESSION['insert']['str_num'] = $_POST['str_num'] ?? '';
$_SESSION['insert']['tel'] = $_POST['tel'] ?? '';
$_SESSION['insert']['fax'] = $_POST['fax'] ?? '';
$_SESSION['insert']['mail'] = $_POST['mail'] ?? '';
$_SESSION['insert']['note'] = $_POST['note'] ?? '';

// 都道府県別の区域処理
if($_POST['pre'] === '岡山県') {
    $_SESSION['insert']['area'] = $_POST['area1'] ?? '';
    $_SESSION['insert']['are_cd'] = $_POST['are_cd1'] ?? '';
} elseif($_POST['pre'] === '広島県') {
    $_SESSION['insert']['area'] = $_POST['area2'] ?? '';
    $_SESSION['insert']['are_cd'] = $_POST['are_cd2'] ?? '';
}

// 休診日
$_SESSION['insert']['clo_day'] = ($_POST['op_flg'] === '0') ? ($_POST['clo_day'] ?? '') : '';

// ★ 診療時間処理
$days = ['mon', 'tue', 'wed', 'thr', 'fri', 'sat', 'sun'];
foreach($days as $day) {
    $_SESSION['insert']["{$day}_am"] = processDiagnosisTime($_POST["{$day}_am"] ?? '', $_POST["{$day}_am1"] ?? '');
    $_SESSION['insert']["{$day}_pm"] = processDiagnosisTime($_POST["{$day}_pm"] ?? '', $_POST["{$day}_pm1"] ?? '');
}
$_SESSION['insert']['holiday'] = processDiagnosisTime($_POST['holiday'] ?? '', $_POST['holiday1'] ?? '');

// ★ 医療分類処理
$medicalFields = [
    'int_int', 'int_dig', 'int_uri', 'int_tum', 'int_res', 'int_kid', 'int_blo', 'int_apo', 'int_cir', 'int_ner', 'int_inf',
    'ped_ped', 'ped_sur', 'ped_neo',
    'sur_sur', 'sur_lac', 'sur_ner', 'sur_nes', 'sur_dig', 'sur_car', 'sur_ven',
    'ort_rhe', 'ort_cos', 'ort_ort', 'ort_reh', 'ort_pla',
    'oph_oph', 'ent_ent', 'ent_to', 'so_sky', 'so_org',
    'gyn_gyn', 'gyn_obs', 'gyn_gyne', 'psy_psy', 'psy_psyc',
    'den_den', 'den_cav', 'den_ref', 'den_ped',
    'alle', 'pat', 'checkup', 'rad', 'cli', 'ane', 'eme'
];

foreach($medicalFields as $field) {
    $_SESSION['insert'][$field] = getCheckboxValue($_POST[$field] ?? null);
}

// ★ 医療分類の上位カテゴリ
$_SESSION['insert']['int_med'] = getMedicalCategory([
    $_SESSION['insert']['int_int'], $_SESSION['insert']['int_dig'], $_SESSION['insert']['int_uri'], $_SESSION['insert']['int_tum'],
    $_SESSION['insert']['int_res'], $_SESSION['insert']['int_kid'], $_SESSION['insert']['int_blo'], $_SESSION['insert']['int_apo'],
    $_SESSION['insert']['int_cir'], $_SESSION['insert']['int_ner'], $_SESSION['insert']['int_inf']
]);
$_SESSION['insert']['ped_med'] = getMedicalCategory([$_SESSION['insert']['ped_ped'], $_SESSION['insert']['ped_sur'], $_SESSION['insert']['ped_neo']]);
$_SESSION['insert']['sur_med'] = getMedicalCategory([$_SESSION['insert']['sur_sur'], $_SESSION['insert']['sur_lac'], $_SESSION['insert']['sur_ner'], $_SESSION['insert']['sur_nes'], $_SESSION['insert']['sur_dig'], $_SESSION['insert']['sur_car'], $_SESSION['insert']['sur_ven']]);
$_SESSION['insert']['ort_med'] = getMedicalCategory([$_SESSION['insert']['ort_rhe'], $_SESSION['insert']['ort_cos'], $_SESSION['insert']['ort_ort'], $_SESSION['insert']['ort_reh'], $_SESSION['insert']['ort_pla']]);
$_SESSION['insert']['oph_med'] = getMedicalCategory([$_SESSION['insert']['oph_oph']]);
$_SESSION['insert']['ent_med'] = getMedicalCategory([$_SESSION['insert']['ent_ent'], $_SESSION['insert']['ent_to']]);
$_SESSION['insert']['so_med'] = getMedicalCategory([$_SESSION['insert']['so_sky'], $_SESSION['insert']['so_org']]);
$_SESSION['insert']['gyn_med'] = getMedicalCategory([$_SESSION['insert']['gyn_gyn'], $_SESSION['insert']['gyn_obs'], $_SESSION['insert']['gyn_gyne']]);
$_SESSION['insert']['psy_med'] = getMedicalCategory([$_SESSION['insert']['psy_psy'], $_SESSION['insert']['psy_psyc']]);
$_SESSION['insert']['den_med'] = getMedicalCategory([$_SESSION['insert']['den_den'], $_SESSION['insert']['den_cav'], $_SESSION['insert']['den_ref'], $_SESSION['insert']['den_ped']]);
$_SESSION['insert']['etc_med'] = getMedicalCategory([$_SESSION['insert']['alle'], $_SESSION['insert']['pat'], $_SESSION['insert']['checkup'], $_SESSION['insert']['rad'], $_SESSION['insert']['cli'], $_SESSION['insert']['ane'], $_SESSION['insert']['eme']]);

// ★ 床情報
$_SESSION['insert']['bed'] = $_POST['bed'] ?? '';
$_SESSION['insert']['bed_reh'] = getCheckboxValue($_POST['bed_reh'] ?? null);
$_SESSION['insert']['bed_tre'] = getCheckboxValue($_POST['bed_tre'] ?? null);
$_SESSION['insert']['bed_main'] = getCheckboxValue($_POST['bed_main'] ?? null);
$_SESSION['insert']['bed_care'] = getCheckboxValue($_POST['bed_care'] ?? null);
$_SESSION['insert']['bed_tra'] = getCheckboxValue($_POST['bed_tra'] ?? null);
$_SESSION['insert']['bed_att'] = getCheckboxValue($_POST['bed_att'] ?? null);
$_SESSION['insert']['pt'] = getCheckboxValue($_POST['pt'] ?? null);
$_SESSION['insert']['ot'] = getCheckboxValue($_POST['ot'] ?? null);
$_SESSION['insert']['st'] = getCheckboxValue($_POST['st'] ?? null);
$_SESSION['insert']['con_hour'] = $_POST['con_hour'] ?? '';
$_SESSION['insert']['dep_note'] = $_POST['dep_note'] ?? '';

// ★ 理事長・病院長情報
$_SESSION['insert']['chi_name'] = $_POST['chi_name'] ?? '';
$_SESSION['insert']['chi_spe'] = $_POST['chi_spe'] ?? '';
$_SESSION['insert']['chi_year'] = $_POST['chi_year'] ?? '';
$_SESSION['insert']['chi_sch'] = $_POST['chi_sch'] ?? '';
$_SESSION['insert']['chi_note'] = $_POST['chi_note'] ?? '';
$_SESSION['insert']['pre_name'] = $_POST['pre_name'] ?? '';
$_SESSION['insert']['pre_spe'] = $_POST['pre_spe'] ?? '';
$_SESSION['insert']['pre_year'] = $_POST['pre_year'] ?? '';
$_SESSION['insert']['pre_sch'] = $_POST['pre_sch'] ?? '';
$_SESSION['insert']['pre_note'] = $_POST['pre_note'] ?? '';

// ★ 親族情報・部門連絡先
$_SESSION['insert']['rel_insert'] = $_POST['rel_insert'] ?? [];
$_SESSION['insert']['fie_insert'] = $_POST['fie_insert'] ?? [];
$_SESSION['insert']['drct_note'] = $_POST['drct_note'] ?? '';
$_SESSION['insert']['num_note'] = $_POST['num_note'] ?? '';

// ★ 後半タブ情報
$_SESSION['insert']['intr_note'] = $_POST['intr_note'] ?? '';
$_SESSION['insert']['tra_note'] = $_POST['tra_note'] ?? '';
$_SESSION['insert']['carna'] = getCheckboxValue($_POST['carna'] ?? null);
$_SESSION['insert']['kurashiki_path'] = $_POST['c_path1'] ?? [];
$_SESSION['insert']['okayama_path'] = $_POST['c_path2'] ?? [];
$_SESSION['insert']['coop_note'] = $_POST['coop_note'] ?? '';
$_SESSION['insert']['con_note'] = $_POST['con_note'] ?? '';
$_SESSION['insert']['med_care'] = $_POST['med_care'] ?? [];
$_SESSION['insert']['mcare_note'] = $_POST['mcare_note'] ?? '';

// ★ 医療連携懇話会処理
if(isset($_POST['kurashiki_sm']) && $_POST['kurashiki_sm'] !== '') {
    $kurashiki_sm = array_filter(array_unique(explode("\r\n", $_POST['kurashiki_sm'])));
    sort($kurashiki_sm);
    $_SESSION['insert']['kurashiki_sm'] = $kurashiki_sm;
}
if(isset($_POST['okayama1_sm']) && $_POST['okayama1_sm'] !== '') {
    $okayama1_sm = array_filter(array_unique(explode("\r\n", $_POST['okayama1_sm'])));
    sort($okayama1_sm);
    $_SESSION['insert']['okayama1_sm'] = $okayama1_sm;
}
if(isset($_POST['okayama2_sm']) && $_POST['okayama2_sm'] !== '') {
    $okayama2_sm = array_filter(array_unique(explode("\r\n", $_POST['okayama2_sm'])));
    sort($okayama2_sm);
    $_SESSION['insert']['okayama2_sm'] = $okayama2_sm;
}

// ★ 医療機関コードの重複チェック
$hosCdCheck = hos_cd_check($dbh, $_SESSION['insert']['hos_cd']);
foreach($hosCdCheck as $record) {
    if($_SESSION['insert']['hos_cd'] === $record['hos_cd']) {
        $_SESSION['insert']['err'] = 'その医療機関コードはすでに登録されています。';
        break;
    }
}

// ★ ビューを表示
extract($_SESSION['insert']);
include_once('./check_view.php');

/**
 * 診療時間を処理
 */
function processDiagnosisTime($office_hours, $day_of_surgery) {
    if($office_hours !== '' && $day_of_surgery !== '') {
        return '★';
    } elseif($day_of_surgery !== '') {
        return '★';
    } elseif($office_hours !== '') {
        return '●';
    }
    return '×';
}

// if((($_POST['mon_am'])!=='')&&($_POST['mon_am1'])!==''){
//     $mon_am ="★";
// }else{
//     if(($_POST['mon_am1'])!==''){
//         $mon_am = "★";
//     }elseif(($_POST['mon_am'])!==''){
//         $mon_am = "●";
//     }else{
//         $mon_am = "×";
//     }
    
// }
?>