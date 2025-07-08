<?php
session_start();

require_once('../functions.php');

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}


/* POST */

$op_flg=$_POST['op_flg'];
//櫻間
$_SESSION['update']['hos_div'] =$_POST['hos_div'];
$note=$_POST['note'];
if($op_flg ==='0'){
$clo_day =$_POST['clo_day'];
}else{
    $clo_day ='';
}
//櫻間


    /* 理事長・病院長情報 */
    //理事長
    $chi_name =$_POST['chi_name'];
    $chi_spe =$_POST['chi_spe'];
    $chi_year =$_POST['chi_year'];
    $chi_sch =$_POST['chi_sch'];
    $chi_note =$_POST['chi_note'];
    //病院長
    $pre_name =$_POST['pre_name'];
    $pre_spe =$_POST['pre_spe'];
    $pre_year =$_POST['pre_year'];
    $pre_sch =$_POST['pre_sch'];
    $pre_note =$_POST['pre_note'];

    

//櫻間
if((($_POST['mon_am'])!=='')&&($_POST['mon_am1'])!==''){
    $mon_am ="★";
}else{
    if(($_POST['mon_am1'])!==''){
        $mon_am = "★";
    }elseif(($_POST['mon_am'])!==''){
        $mon_am = "●";
    }else{
        $mon_am = "×";
    }
       
    }

if((($_POST['mon_pm'])!=='')&&($_POST['mon_pm1'])!==''){
    $mon_pm ="★";
}else{
    if(($_POST['mon_pm1'])!==''){
        $mon_pm = "★";
    }elseif(($_POST['mon_pm'])!==''){
        $mon_pm = "●";
    }else{
        $mon_pm = "×";
    }
}
if((($_POST['tue_am'])!=='')&&($_POST['tue_am1'])!==''){
    $tue_am ="★";
}else{
    if(($_POST['tue_am1'])!==''){
        $tue_am = "★";
    }elseif(($_POST['tue_am'])!==''){
        $tue_am= "●";
    }else{
        $tue_am = "×";
    }
}
if((($_POST['tue_pm'])!=='')&&($_POST['tue_pm1'])!==''){
    $tue_pm ="★";
}else{
    if(($_POST['tue_pm1'])!==''){
        $tue_pm = "★";
    }elseif(($_POST['tue_pm'])!==''){
        $tue_pm= "●";
    }else{
        $tue_pm = "×";
    }
}
if((($_POST['wed_am'])!=='')&&($_POST['wed_am1'])!==''){
    $wed_am ="★";
}else{
    if(($_POST['wed_am1'])!==''){
        $wed_am = "★";
    }elseif(($_POST['wed_am'])!==''){
        $wed_am= "●";
    }else{
        $wed_am = "×";
    }
}
if((($_POST['wed_pm'])!=='')&&($_POST['wed_pm1'])!==''){
    $wed_pm ="★";
}else{
    if(($_POST['wed_pm1'])!==''){
        $wed_pm = "★";
    }elseif(($_POST['wed_pm'])!==''){
        $wed_pm= "●";
    }else{
        $wed_pm = "×";
    }
}
if((($_POST['thr_am'])!=='')&&($_POST['thr_am1'])!==''){
    $thr_am ="★";
}else{
    if(($_POST['thr_am1'])!==''){
        $thr_am = "★";
    }elseif(($_POST['thr_am'])!==''){
        $thr_am= "●";
    }else{
        $thr_am = "×";
    }
}
if((($_POST['thr_pm'])!=='')&&($_POST['thr_pm1'])!==''){
    $thr_pm ="★";
}else{
    if(($_POST['thr_pm1'])!==''){
        $thr_pm = "★";
    }elseif(($_POST['thr_pm'])!==''){
        $thr_pm= "●";
    }else{
        $thr_pm = "×";
    }
}
if((($_POST['fri_am'])!=='')&&($_POST['fri_am1'])!==''){
    $fri_am ="★";
}else{
    if(($_POST['fri_am1'])!==''){
        $fri_am = "★";
    }elseif(($_POST['fri_am'])!==''){
        $fri_am= "●";
    }else{
        $fri_am = "×";
    }
}
if((($_POST['fri_pm'])!=='')&&($_POST['fri_pm1'])!==''){
    $fri_pm ="★";
}else{
    if(($_POST['fri_pm1'])!==''){
        $fri_pm = "★";
    }elseif(($_POST['fri_pm'])!==''){
        $fri_pm= "●";
    }else{
        $fri_pm = "×";
    }
}
if((($_POST['sat_am'])!=='')&&($_POST['sat_am1'])!==''){
    $sat_am ="★";
}else{
    if(($_POST['sat_am1'])!==''){
        $sat_am = "★";
    }elseif(($_POST['sat_am'])!==''){
        $sat_am= "●";
    }else{
        $sat_am = "×";
    }
}

if((($_POST['sat_pm'])!=='')&&($_POST['sat_pm1'])!==''){
    $sat_pm ="★";
}else{
    if(($_POST['sat_pm1'])!==''){
        $sat_pm = "★";
    }elseif(($_POST['sat_pm'])!==''){
        $sat_pm= "●";
    }else{
        $sat_pm = "×";
    }
}
if((($_POST['sun_am'])!=='')&&($_POST['sun_am1'])!==''){
    $sun_am ="★";
}else{
    if(($_POST['sun_am1'])!==''){
        $sun_am = "★";
    }elseif(($_POST['sun_am'])!==''){
        $sun_am= "●";
    }else{
        $sun_am = "×";
    }
}
if((($_POST['sun_pm'])!=='')&&($_POST['sun_pm1'])!==''){
    $sun_pm ="★";
}else{
    if(($_POST['sun_pm1'])!==''){
        $sun_pm = "★";
    }elseif(($_POST['sun_pm'])!==''){
        $sun_pm= "●";
    }else{
        $sun_pm = "×";
    }
}
if((($_POST['holiday'])!=='')&&($_POST['holiday1'])!==''){
    $holiday ="★";
}else{
    if(($_POST['holiday1'])!==''){
        $holiday = "★";
    }elseif(($_POST['holiday'])!==''){
        $holiday= "●";
    }else{
        $holiday = "×";
    }
}




if(($_POST['int_int'])==='1'){
    $int_int ='1';
}else{
    $int_int = "";
}
if(($_POST['int_dig'])==='1'){
    $int_dig ='1';
}else{
    $int_dig = "";
}
if(($_POST['int_uri'])==='1'){
    $int_uri ='1';
}else{
    $int_uri = "";
}
if(($_POST['int_tum'])==='1'){
    $int_tum ='1';
}else{
    $int_tum = "";
}
if(($_POST['int_res'])==='1'){
    $int_res ='1';
}else{
    $int_res = "";
}
if(($_POST['int_kid'])==='1'){
    $int_kid ='1';
}else{
    $int_kid = "";
}
if(($_POST['int_blo'])==='1'){
    $int_blo ='1';
}else{
    $int_blo = "";
}
if(($_POST['int_apo'])==='1'){
    $int_apo ='1';
}else{
    $int_apo = "";
}
if(($_POST['int_cir'])==='1'){
    $int_cir ='1';
}else{
    $int_cir = "";
}
if(($_POST['int_ner'])==='1'){
    $int_ner ='1';
}else{
    $int_ner = "";
}
if(($_POST['int_inf'])==='1'){
    $int_inf ='1';
}else{
    $int_inf = "";
}
if(($_POST['ped_ped'])==='1'){
    $ped_ped ='1';
}else{
    $ped_ped = "";
}
if(($_POST['ped_sur'])==='1'){
    $ped_sur ='1';
}else{
    $ped_sur = "";
}
if(($_POST['ped_neo'])==='1'){
    $ped_neo ='1';
}else{
    $ped_neo = "";
}
if(($_POST['sur_sur'])==='1'){
    $sur_sur ='1';
}else{
    $sur_sur = "";
}
if(($_POST['sur_lac'])==='1'){
    $sur_lac ='1';
}else{
    $sur_lac = "";
}
if(($_POST['sur_ner'])==='1'){
    $sur_ner ='1';
}else{
    $sur_ner = "";
}
if(($_POST['sur_nes'])==='1'){
    $sur_nes ='1';
}else{
    $sur_nes = "";
}
if(($_POST['sur_dig'])==='1'){
    $sur_dig ='1';
}else{
    $sur_dig = "";
}
if(($_POST['sur_car'])==='1'){
    $sur_car ='1';
}else{
    $sur_car = "";
}
if(($_POST['sur_ven'])==='1'){
    $sur_ven ='1';
}else{
    $sur_ven = "";
}
if(($_POST['ort_rhe'])==='1'){
    $ort_rhe ='1';
}else{
    $ort_rhe = "";
}
if(($_POST['ort_cos'])==='1'){
    $ort_cos ='1';
}else{
    $ort_cos = "";
}
if(($_POST['ort_ort'])==='1'){
    $ort_ort ='1';
}else{
    $ort_ort = "";
}
if(($_POST['ort_reh'])==='1'){
    $ort_reh ='1';
}else{
    $ort_reh = "";
}
if(($_POST['ort_pla'])==='1'){
    $ort_pla ='1';
}else{
    $ort_pla = "";
}
if(($_POST['oph_oph'])==='1'){
    $oph_oph ='1';
}else{
    $oph_oph = "";
}
if(($_POST['ent_ent'])==='1'){
    $ent_ent ='1';
}else{
    $ent_ent = "";
}
if(($_POST['ent_to'])==='1'){
    $ent_to ='1';
}else{
    $ent_to = "";
}
if(($_POST['so_sky'])==='1'){
    $so_sky ='1';
}else{
    $so_sky = "";
}
if(($_POST['so_org'])==='1'){
    $so_org ='1';
}else{
    $so_org = "";
}
if(($_POST['gyn_gyn'])==='1'){
    $gyn_gyn ='1';
}else{
    $gyn_gyn = "";
}
if(($_POST['gyn_obs'])==='1'){
    $gyn_obs ='1';
}else{
    $gyn_obs = "";
}
if(($_POST['gyn_gyne'])==='1'){
    $gyn_gyne ='1';
}else{
    $gyn_gyne = "";
}
if(($_POST['psy_psy'])==='1'){
    $psy_psy ='1';
}else{
    $psy_psy = "";
}
if(($_POST['psy_psyc'])==='1'){
    $psy_psyc ='1';
}else{
    $psy_psyc = "";
}
if(($_POST['den_den'])==='1'){
    $den_den ='1';
}else{
    $den_den = "";
}
if(($_POST['den_cav'])==='1'){
    $den_cav ='1';
}else{
    $den_cav = "";
}
if(($_POST['den_ref'])==='1'){
    $den_ref ='1';
}else{
    $den_ref = "";
}
if(($_POST['den_ped'])==='1'){
    $den_ped ='1';
}else{
    $den_ped = "";
}
if(($_POST['alle'])==='1'){
    $alle ='1';
}else{
    $alle = "";
}
if(($_POST['pat'])==='1'){
    $pat ='1';
}else{
    $pat = "";
}
if(($_POST['checkup'])==='1'){
    $checkup ='1';
}else{
    $checkup = "";
}
if(($_POST['rad'])==='1'){
    $rad ='1';
}else{
    $rad = "";
}
if(($_POST['cli'])==='1'){
    $cli ='1';
}else{
    $cli = "";
}
if(($_POST['ane'])==='1'){
    $ane ='1';
}else{
    $ane = "";
}
if(($_POST['eme'])==='1'){
    $eme ='1';
}else{
    $eme = "";
}
//櫻間
$bed=$_POST['bed'];
if(isset($_POST['bed_reh'])){
    $bed_reh ='1';
}else{
    $bed_reh = "";
}
if(isset($_POST['bed_tre'])){
    $bed_tre ='1';
}else{
    $bed_tre = "";
}

if(isset($_POST['bed_main'])){
    $bed_main ='1';
}else{
    $bed_main = "";
}

if(isset($_POST['bed_care'])){
    $bed_care ='1';
}else{
    $bed_care = "";
}


if(isset($_POST['bed_tra'])){
    $bed_tra ='1';
}else{
    $bed_tra = "";
}

if(isset($_POST['bed_att'])){
    $bed_att='1';
}else{
    $bed_att = "";
}
if(isset($_POST['pt'])){
    $pt='1';
}else{
    $pt = "";
}

if(isset($_POST['ot'])){
    $ot='1';
}else{
    $ot = "";
}
if(isset($_POST['st'])){
    $st='1';
}else{
    $st = "";
}
$hos_cd = $_SESSION['hos_cd'];



//高橋20221130
//relativeテーブル　※配列
    //update
    $rel_update=array();
    if(isset($_POST['rel_update'])){
    $rel_update=$_POST['rel_update'];
    }

    //insert
    $rel_insert=array();
    if(isset($_POST['rel_insert'])){
    $rel_insert=$_POST['rel_insert'];
    }

/* 部門連絡先 */
//field_junctionテーブル　※配列
    //update
    $fie_update=array();
    if(isset($_POST['fie_update'])){
    $fie_update=$_POST['fie_update'];
    }
    //insert
    $fie_insert=array();
    if(isset($_POST['fie_insert'])){
    $fie_insert=$_POST['fie_insert'];
    }



//備考
$drct_note = $_POST['drct_note'];
$num_note = $_POST['num_note'];




//高橋20230602_後半タブupdate（POST）ここから
$intr_note = $_POST['intr_note'];
$tra_note = $_POST['tra_note'];
$coop_note = $_POST['coop_note'];
$con_note = $_POST['con_note'];
$mcare_note = $_POST['mcare_note'];

    //7-1 カルナコネクト
        if(isset($_POST['carna'])){ $carna = $_POST['carna']; }else{ $carna = ''; }
    //7-2 連携パス
        $kurashiki_path=array();
        $okayama_path=array();
        if(isset($_POST['c_path1'])){ $kurashiki_path = $_POST['c_path1']; }
        if(isset($_POST['c_path2'])){ $okayama_path = $_POST['c_path2']; }
    //7-3 医療連携懇話会　参加年度
        /* 高橋20231121 懇話会追加 */
            $kurashiki_sm=array(); //0附属
            $okayama1_sm=array(); //1総C
            $okayama2_sm=array(); //2高齢C

            if($_POST['kurashiki_sm']!==''){ $kurashiki_sm = explode("\r\n",$_POST['kurashiki_sm']); }
                if(!empty($kurashiki_sm)){
                    $kurashiki_sm=array_unique($kurashiki_sm);
                    $kurashiki_sm=array_filter($kurashiki_sm);
                    sort($kurashiki_sm); //昇順
                }
            if($_POST['okayama1_sm']!==''){ $okayama1_sm = explode("\r\n",$_POST['okayama1_sm']); }
                if(!empty($okayama1_sm)){
                    $okayama1_sm=array_unique($okayama1_sm);
                    $okayama1_sm=array_filter($okayama1_sm);
                    sort($okayama1_sm); //昇順
                }
            if($_POST['okayama2_sm']!==''){ $okayama2_sm = explode("\r\n",$_POST['okayama2_sm']); }
                if(!empty($okayama2_sm)){
                    $okayama2_sm=array_unique($okayama2_sm);
                    $okayama2_sm=array_filter($okayama2_sm);
                    sort($okayama2_sm); //昇順
                }
        /* 高橋20231121 懇話会追加 */

    //8-コンタクト履歴　△7月1日の導入を見送り

    //9-診療内容
        $med_care=array();
        if(isset($_POST['med_care'])){ $med_care = $_POST['med_care']; }

//高橋20230602_後半タブupdate（POST）ここまで




/* SESSION */
$_SESSION['update']['dep_note']=$_POST['dep_note'];

$_SESSION['update']['op_flg']=$_POST['op_flg'];
$_SESSION['update']['med_ass']=$_POST['med_ass'];
$_SESSION['update']['hos_name']=$_POST['hos_name'];
$hos_name='';
$hos_name=$_SESSION['update']['hos_name'];
$_SESSION['update']['zipcode']=$_POST['zipcode'];

/* 高橋20230512　ここから */
//$_SESSION['update']['are_cd']=$_POST['are_cd'];
//$_SESSION['update']['area']=$_POST['area'];
     if($_POST['pre']==="岡山県"){
        $_SESSION['update']['area']=$_POST['area1'];
        $_SESSION['update']['are_cd']=$_POST['are_cd1'];
    }elseif($_POST['pre']==="広島県"){
        $_SESSION['update']['area']=$_POST['area2'];
        $_SESSION['update']['are_cd']=$_POST['are_cd2'];
    }
/* 高橋20230512　ここまで */

$_SESSION['update']['pre']=$_POST['pre'];
$_SESSION['update']['city']=$_POST['city'];
$_SESSION['update']['zone']=$_POST['zone'];
$_SESSION['update']['town']=$_POST['town'];
$_SESSION['update']['str_num']=$_POST['str_num'];
$_SESSION['update']['tel']=$_POST['tel'];
$_SESSION['update']['fax']=$_POST['fax'];
//櫻間20230317
$_SESSION['update']['mail']=$_POST['mail'];


$_SESSION['update']['note']=$_POST['note'];
if($_SESSION['update']['op_flg'] ==='0'){
$_SESSION['update']['clo_day']=$_POST['clo_day'];
}else{
    $_SESSION['update']['clo_day']='';
}

$_SESSION['update']['chi_name']=$chi_name;
$_SESSION['update']['chi_spe']=$chi_spe;
$_SESSION['update']['chi_year']=$chi_year;
$_SESSION['update']['chi_sch']=$chi_sch;
$_SESSION['update']['chi_note']=$chi_note;
$_SESSION['update']['pre_name']=$pre_name;
$_SESSION['update']['pre_spe']=$pre_spe;
$_SESSION['update']['pre_year']=$pre_year;
$_SESSION['update']['pre_sch']=$pre_sch;
$_SESSION['update']['pre_note']=$pre_note;

$_SESSION['update']['drct_note'] = $drct_note;
$_SESSION['update']['num_note'] = $num_note;


//高橋20221130

//親族情報テーブル
$_SESSION['update']['rel_insert'] = $rel_insert;
$_SESSION['update']['rel_update'] = $rel_update;
//部門連絡先テーブル
$_SESSION['update']['fie_insert'] = $fie_insert;
$_SESSION['update']['fie_update'] = $fie_update;



$_SESSION['update']['con_hour']=$_POST['con_hour'];
$_SESSION['update']['mon_am']=$mon_am;
$_SESSION['update']['mon_pm']=$mon_pm;
$_SESSION['update']['tue_am']=$tue_am;
$_SESSION['update']['tue_pm']=$tue_pm;
$_SESSION['update']['wed_am']=$wed_am;
$_SESSION['update']['wed_pm']=$wed_pm;
$_SESSION['update']['thr_am']=$thr_am;
$_SESSION['update']['thr_pm']=$thr_pm;
$_SESSION['update']['fri_am']=$fri_am;
$_SESSION['update']['fri_pm']=$fri_pm;
$_SESSION['update']['sat_am']=$sat_am;
$_SESSION['update']['sat_pm']=$sat_pm;
$_SESSION['update']['sun_am']=$sun_am;
$_SESSION['update']['sun_pm']=$sun_pm;
$_SESSION['update']['holiday']=$holiday;
$_SESSION['update']['int_int']=$int_int;
$_SESSION['update']['int_dig']=$int_dig;
$_SESSION['update']['int_uri']=$int_uri;
$_SESSION['update']['int_tum']=$int_tum;
$_SESSION['update']['int_res']=$int_res;
$_SESSION['update']['int_kid']=$int_kid;
$_SESSION['update']['int_blo']=$int_blo;
$_SESSION['update']['int_apo']=$int_apo;
$_SESSION['update']['int_cir']=$int_cir;
$_SESSION['update']['int_ner']=$int_ner;
$_SESSION['update']['int_inf']=$int_inf;
$_SESSION['update']['ped_ped']=$ped_ped;
$_SESSION['update']['ped_sur']=$ped_sur;
$_SESSION['update']['ped_neo']=$ped_neo;
$_SESSION['update']['sur_sur']=$sur_sur;
$_SESSION['update']['sur_lac']=$sur_lac;
$_SESSION['update']['sur_ner']=$sur_ner;
$_SESSION['update']['sur_nes']=$sur_nes;
$_SESSION['update']['sur_dig']=$sur_dig;
$_SESSION['update']['sur_car']=$sur_car;
$_SESSION['update']['sur_ven']=$sur_ven;
$_SESSION['update']['ort_rhe']=$ort_rhe;
$_SESSION['update']['ort_cos']=$ort_cos;
$_SESSION['update']['ort_ort']=$ort_ort;
$_SESSION['update']['ort_reh']=$ort_reh;
$_SESSION['update']['ort_pla']=$ort_pla;
$_SESSION['update']['oph_oph']=$oph_oph;
$_SESSION['update']['ent_ent']=$ent_ent;
$_SESSION['update']['ent_to']=$ent_to;
$_SESSION['update']['so_sky']=$so_sky;
$_SESSION['update']['so_org']=$so_org;
$_SESSION['update']['gyn_gyn']=$gyn_gyn;
$_SESSION['update']['gyn_obs']=$gyn_obs;
$_SESSION['update']['gyn_gyne']=$gyn_gyne;
$_SESSION['update']['psy_psy']=$psy_psy;
$_SESSION['update']['psy_psyc']=$psy_psyc;
$_SESSION['update']['den_den']=$den_den;
$_SESSION['update']['den_cav']=$den_cav;
$_SESSION['update']['den_ref']=$den_ref;
$_SESSION['update']['den_ped']=$den_ped;
$_SESSION['update']['alle']=$alle;
$_SESSION['update']['pat']=$pat;
$_SESSION['update']['checkup']=$checkup;
$_SESSION['update']['rad']=$rad;
$_SESSION['update']['cli']=$cli;
$_SESSION['update']['ane']=$ane;
$_SESSION['update']['eme']=$eme;
$_SESSION['update']['bed']=$_POST['bed'];
$_SESSION['update']['bed_reh']=$bed_reh;
$_SESSION['update']['bed_tre']=$bed_tre;
$_SESSION['update']['bed_main']=$bed_main;
$_SESSION['update']['bed_care']=$bed_care;
$_SESSION['update']['bed_tra']=$bed_tra;
$_SESSION['update']['bed_att']=$bed_att;
$_SESSION['update']['pt']=$pt;
$_SESSION['update']['ot']=$ot;
$_SESSION['update']['st']=$st;



//高橋20230602_後半タブupdate（SESSION）ここから
$_SESSION['update']['intr_note'] = $intr_note;
$_SESSION['update']['tra_note'] = $tra_note;
$_SESSION['update']['coop_note'] = $coop_note;
$_SESSION['update']['con_note'] = $con_note;
$_SESSION['update']['mcare_note'] = $mcare_note;

    //7-1 カルナコネクト
        $_SESSION['update']['carna'] = $carna;

    //7-2 連携パス
        if(!empty($kurashiki_path)){ $_SESSION['update']['kurashiki_path'] = $kurashiki_path; }
        if(!empty($okayama_path)){ $_SESSION['update']['okayama_path'] = $okayama_path; }

    //7-3 医療連携懇話会　参加年度
        /*高橋20231121 懇話会追加 */
        if(!empty($kurashiki_sm)){ $_SESSION['update']['kurashiki_sm'] = $kurashiki_sm; }
        if(!empty($okayama1_sm)){ $_SESSION['update']['okayama1_sm'] = $okayama1_sm; }
        if(!empty($okayama2_sm)){ $_SESSION['update']['okayama2_sm'] = $okayama2_sm; }
        /*高橋20231121 懇話会追加 */


    //8 コンタクト履歴　△7月1日の導入を見送り

    //9 診療内容
    if(!empty($med_care)){ $_SESSION['update']['med_care'] = $med_care; }

//高橋20230602_後半タブupdate（SESSION）ここまで


 //高橋　viewの読み出し
include_once('update_view/kakunin_view.php');?>
