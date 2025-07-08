<?php
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');
$dbh = get_db_connect();

//櫻間
if(isset($_SESSION)==null){
    session_start();
    }

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

//櫻間
$user_adm = $_SESSION['member']['adm_user'];


//sessionがあれば変数に保存
if(isset($_SESSION['insert'])){	
    //基本情報
        $hos_cd=$_SESSION['insert']['hos_cd'];
        $hos_div=$_SESSION['insert']['hos_div'];
        $op_flg=$_SESSION['insert']['op_flg'];
        $clo_day=$_SESSION['insert']['clo_day'];
        $med_ass=$_SESSION['insert']['med_ass'];
        $are_cd=$_SESSION['insert']['are_cd'];
        $hos_name=$_SESSION['insert']['hos_name'];
        $zipcode=$_SESSION['insert']['zipcode'];
        $area=$_SESSION['insert']['area'];
        $pre=$_SESSION['insert']['pre'];
        $city=$_SESSION['insert']['city'];
        $zone=$_SESSION['insert']['zone'];
        $town=$_SESSION['insert']['town'];
        $str_num=$_SESSION['insert']['str_num'];
        $tel=$_SESSION['insert']['tel'];
        $fax=$_SESSION['insert']['fax'];
        //櫻間20230317
        $mail=$_SESSION['insert']['mail'];
        $note=$_SESSION['insert']['note'];
    //診療科目
        $bed=$_SESSION['insert']['bed'];
        $bed_main=$_SESSION['insert']['bed_main'];
        $bed_tre=$_SESSION['insert']['bed_tre'];
        $bed_reh=$_SESSION['insert']['bed_reh'];
        $bed_care=$_SESSION['insert']['bed_care'];
        $bed_tra=$_SESSION['insert']['bed_tra'];
        $bed_att=$_SESSION['insert']['bed_att'];
        $pt=$_SESSION['insert']['pt'];
        $ot=$_SESSION['insert']['ot'];
        $st=$_SESSION['insert']['st'];
        $con_hour=$_SESSION['insert']['con_hour'];

        $mon_am=$_SESSION['insert']['mon_am'];
        $mon_pm=$_SESSION['insert']['mon_pm'];
        $tue_am=$_SESSION['insert']['tue_am'];
        $tue_pm=$_SESSION['insert']['tue_pm'];
        $wed_am=$_SESSION['insert']['wed_am'];
        $wed_pm=$_SESSION['insert']['wed_pm'];
        $thr_am=$_SESSION['insert']['thr_am'];
        $thr_pm=$_SESSION['insert']['thr_pm'];
        $fri_am=$_SESSION['insert']['fri_am'];
        $fri_pm=$_SESSION['insert']['fri_pm'];
        $sat_am=$_SESSION['insert']['sat_am'];
        $sat_pm=$_SESSION['insert']['sat_pm'];
        $sun_am=$_SESSION['insert']['sun_am'];
        $sun_pm=$_SESSION['insert']['sun_pm'];
        $holiday=$_SESSION['insert']['holiday'];

        $mon_a=$_SESSION['insert']['mon_a'];
        $mon_p=$_SESSION['insert']['mon_p'];
        $tue_a=$_SESSION['insert']['tue_a'];
        $tue_p=$_SESSION['insert']['tue_p'];
        $wed_a=$_SESSION['insert']['wed_a'];
        $wed_p=$_SESSION['insert']['wed_p'];
        $thr_a=$_SESSION['insert']['thr_a'];
        $thr_p=$_SESSION['insert']['thr_p'];
        $fri_a=$_SESSION['insert']['fri_a'];
        $fri_p=$_SESSION['insert']['fri_p'];
        $sat_a=$_SESSION['insert']['sat_a'];
        $sat_p=$_SESSION['insert']['sat_p'];
        $sun_a=$_SESSION['insert']['sun_a'];
        $sun_p=$_SESSION['insert']['sun_p'];
        $holida=$_SESSION['insert']['holida'];

        $int_med=$_SESSION['insert']['int_med'];
        $ped_med=$_SESSION['insert']['ped_med'];
        $sur_med=$_SESSION['insert']['sur_med'];
        $ort_med=$_SESSION['insert']['ort_med'];
        $oph_med=$_SESSION['insert']['oph_med'];
        $ent_med=$_SESSION['insert']['ent_med'];
        $so_med=$_SESSION['insert']['so_med'];
        $gyn_med=$_SESSION['insert']['gyn_med'];
        $psy_med=$_SESSION['insert']['psy_med'];
        $den_med=$_SESSION['insert']['den_med'];
        $etc_med=$_SESSION['etc_med']['den_med'];


        $int_int=$_SESSION['insert']['int_int'];
        $int_dig=$_SESSION['insert']['int_dig'];
        $int_uri=$_SESSION['insert']['int_uri'];
        $int_tum=$_SESSION['insert']['int_tum'];
        $int_res=$_SESSION['insert']['int_res'];
        $int_kid=$_SESSION['insert']['int_kid'];
        $int_blo=$_SESSION['insert']['int_blo'];
        $int_apo=$_SESSION['insert']['int_apo'];
        $int_cir=$_SESSION['insert']['int_cir'];
        $int_ner=$_SESSION['insert']['int_ner'];
        $int_inf=$_SESSION['insert']['int_inf'];

        $ped_ped=$_SESSION['insert']['ped_ped'];
        $ped_sur=$_SESSION['insert']['ped_sur'];
        $ped_neo=$_SESSION['insert']['ped_neo'];

        $sur_sur=$_SESSION['insert']['sur_sur'];
        $sur_lac=$_SESSION['insert']['sur_lac'];
        $sur_ner=$_SESSION['insert']['sur_ner'];
        $sur_nes=$_SESSION['insert']['sur_nes'];
        $sur_dig=$_SESSION['insert']['sur_dig'];
        $sur_car=$_SESSION['insert']['sur_car'];
        $sur_ven=$_SESSION['insert']['sur_ven'];


        $ort_rhe=$_SESSION['insert']['ort_rhe'];
        $ort_cos=$_SESSION['insert']['ort_cos'];
        $ort_ort=$_SESSION['insert']['ort_ort'];
        $ort_reh=$_SESSION['insert']['ort_reh'];
        $ort_pla=$_SESSION['insert']['ort_pla'];

        $oph_oph=$_SESSION['insert']['oph_oph'];

        $ent_ent=$_SESSION['insert']['ent_ent'];
        $ent_to=$_SESSION['insert']['ent_to'];

        $so_sky=$_SESSION['insert']['so_sky'];
        $so_org=$_SESSION['insert']['so_org'];

        $gyn_gyn=$_SESSION['insert']['gyn_gyn'];
        $gyn_obs=$_SESSION['insert']['gyn_obs'];
        $gyn_gyne=$_SESSION['insert']['gyn_gyne'];

        $psy_psy=$_SESSION['insert']['psy_psy'];
        $psy_psyc=$_SESSION['insert']['psy_psyc'];


        $den_den=$_SESSION['insert']['den_den'];
        $den_cav=$_SESSION['insert']['den_cav'];
        $den_ref=$_SESSION['insert']['den_ref'];
        $den_ped=$_SESSION['insert']['den_ped'];

        $alle=$_SESSION['insert']['alle'];
        $pat=$_SESSION['insert']['pat'];
        $rad=$_SESSION['insert']['rad'];
        $cli=$_SESSION['insert']['cli'];
        $ane=$_SESSION['insert']['ane'];
        $eme=$_SESSION['insert']['eme'];
        $checkup=$_SESSION['insert']['checkup'];

        $dep_note=$_SESSION['insert']['dep_note'];


    //理事長・病院長情報
        //理事長
            $chi_name=$_SESSION['insert']['chi_name'];
            $chi_spe=$_SESSION['insert']['chi_spe'];
            $chi_year=$_SESSION['insert']['chi_year'];
            $chi_sch=$_SESSION['insert']['chi_sch'];
            $chi_note=$_SESSION['insert']['chi_note'];
        //病院長
            $pre_name=$_SESSION['insert']['pre_name'];
            $pre_spe=$_SESSION['insert']['pre_spe'];
            $pre_year=$_SESSION['insert']['pre_year'];
            $pre_sch=$_SESSION['insert']['pre_sch'];
            $pre_note=$_SESSION['insert']['pre_note'];
        //親族情報　※配列
            $rel_insert=$_SESSION['insert']['rel_insert'];

    //部門連絡先　※配列
        $fie_insert=$_SESSION['insert']['fie_insert'];
    //櫻間備考
    $num_note=$_SESSION['insert']['num_note'];
    $drct_note=$_SESSION['insert']['drct_note'];
    //櫻間

    //高橋20230610　後半タブinsert（SESSION）ここから
    $carna = $_SESSION['insert']['carna'];
    $kurashiki_path = $_SESSION['insert']['kurashiki_path']; 
    $okayama_path = $_SESSION['insert']['okayama_path'];

    $med_care = $_SESSION['insert']['med_care'];

    //備考
    $intr_note=$_SESSION['insert']['intr_note'];
    $tra_note=$_SESSION['insert']['tra_note'];
    $coop_note=$_SESSION['insert']['coop_note'];
    $con_note=$_SESSION['insert']['con_note'];
    $mcare_note=$_SESSION['insert']['mcare_note'];
    //高橋20230610　後半タブinsert（SESSION）ここまで
    
}


//高橋20230512　地域マスタ情報取得
$are_cds=get_area($dbh);

include_once('insert_header.php');
