<?php
//櫻間
$hos_cd='';
$user_id='';
$user_name='';
$hos_name='';
$op_flg='';
$hos_div='';
$note=''; //note
$clo_day='';
$chi_name='';
$chi_spe='';
$chi_year='';
$chi_sch='';
$chi_note='';
$pre_name='';
$pre_spe='';
$pre_year='';
$pre_sch='';
$pre_note='';
$con_hour='';
$mon_am='';
$mon_pm='';
$tue_am='';
$tue_pm='';
$wed_am='';
$wed_pm='';
$thr_am='';
$thr_pm='';
$fri_am='';
$fri_pm='';
$sat_am='';
$sat_pm='';
$sun_am='';
$sun_pm='';
$holiday='';
$int_int='';
$int_dig='';
$int_uri='';
$int_tum='';
$int_res='';
$int_kid='';
$int_blo='';
$int_apo='';
$int_cir='';
$int_ner='';
$int_inf='';
$ped_ped='';
$ped_sur='';
$ped_neo='';
$sur_sur='';
$sur_lac='';
$sur_ner='';
$sur_nes='';
$sur_dig='';
$sur_car='';
$sur_ven='';
$ort_rhe='';
$ort_cos='';
$ort_ort='';
$ort_reh='';
$ort_pla='';
$oph_oph='';
$ent_ent='';
$ent_to='';
$so_sky='';
$so_org='';
$gyn_gyn='';
$gyn_obs='';
$gyn_gyne='';
$psy_psy='';
$psy_psyc='';
$den_den='';
$den_cav='';
$den_ref='';
$den_ped='';
$alle='';
$pat='';
$checkup='';
$rad='';
$cli='';
$ane='';
$eme='';
$bed='';
$bed_reh='';
$bed_tre='';
$bed_main='';
$bed_care='';
$bed_tra='';
$bed_att='';
$pt='';
$ot='';
$st='';
$zipcode='';
$pre='';
$city='';
$are_cd='';
$area='';
$zone='';
$town='';
$str_num='';
$tel='';
$fax='';
//櫻間20230317
$mail='';
$dep_note=''; //note
$num_note=''; //note
$med_ass='';

//高橋
$drct_note = ''; //note

$rel_insert = array();
$rel_update = array();
$fie_update = array();
$fie_update = array();


//高橋20230602_後半タブ
$intr_note = ''; //note
$tra_note = ''; //note
$coop_note = ''; //note
$con_note = ''; //note
$mcare_note = ''; //note

$carna = '';
$kurashiki_path=array();
$okayama_path=array();

/* 高橋20231121 懇話会追加 */
$kurashiki_sm=array(); //0附属
$okayama1_sm=array(); //1総C
$okayama2_sm=array(); //2高齢C
/* 高橋20231121 懇話会追加 */

$med_care = array();
//高橋20230602_後半タブ



$hos_cd = $_SESSION['hos_cd'];
$user_id=$_SESSION["member"]['user_id'];
$user_name=$_SESSION["member"]['user_name'];
$hos_name=$_SESSION['update']['hos_name'];
$op_flg=$_SESSION['update']['op_flg'];
$hos_div=$_SESSION['update']['hos_div'];
$note=$_SESSION['update']['note'];  //note
$clo_day=$_SESSION['update']['clo_day'];
$chi_name=$_SESSION['update']['chi_name'];
$chi_spe=$_SESSION['update']['chi_spe'];
$chi_year=$_SESSION['update']['chi_year'];
$chi_sch=$_SESSION['update']['chi_sch'];
$chi_note=$_SESSION['update']['chi_note'];
$pre_name=$_SESSION['update']['pre_name'];
$pre_spe=$_SESSION['update']['pre_spe'];
$pre_year=$_SESSION['update']['pre_year'];
$pre_sch=$_SESSION['update']['pre_sch'];
$pre_note=$_SESSION['update']['pre_note'];
$con_hour=$_SESSION['update']['con_hour'];
$mon_am=$_SESSION['update']['mon_am'];
$mon_pm=$_SESSION['update']['mon_pm'];
$tue_am=$_SESSION['update']['tue_am'];
$tue_pm=$_SESSION['update']['tue_pm'];
$wed_am=$_SESSION['update']['wed_am'];
$wed_pm=$_SESSION['update']['wed_pm'];
$thr_am=$_SESSION['update']['thr_am'];
$thr_pm=$_SESSION['update']['thr_pm'];
$fri_am=$_SESSION['update']['fri_am'];
$fri_pm=$_SESSION['update']['fri_pm'];
$sat_am=$_SESSION['update']['sat_am'];
$sat_pm=$_SESSION['update']['sat_pm'];
$sun_am=$_SESSION['update']['sun_am'];
$sun_pm=$_SESSION['update']['sun_pm'];
$holiday=$_SESSION['update']['holiday'];
$int_int=$_SESSION['update']['int_int'];
$int_dig=$_SESSION['update']['int_dig'];
$int_uri=$_SESSION['update']['int_uri'];
$int_tum=$_SESSION['update']['int_tum'];
$int_res=$_SESSION['update']['int_res'];
$int_kid=$_SESSION['update']['int_kid'];
$int_blo=$_SESSION['update']['int_blo'];
$int_apo=$_SESSION['update']['int_apo'];
$int_cir=$_SESSION['update']['int_cir'];
$int_ner=$_SESSION['update']['int_ner'];
$int_inf=$_SESSION['update']['int_inf'];
$ped_ped=$_SESSION['update']['ped_ped'];
$ped_sur=$_SESSION['update']['ped_sur'];
$ped_neo=$_SESSION['update']['ped_neo'];
$sur_sur=$_SESSION['update']['sur_sur'];
$sur_lac=$_SESSION['update']['sur_lac'];
$sur_ner=$_SESSION['update']['sur_ner'];
$sur_nes=$_SESSION['update']['sur_nes'];
$sur_dig=$_SESSION['update']['sur_dig'];
$sur_car=$_SESSION['update']['sur_car'];
$sur_ven=$_SESSION['update']['sur_ven'];
$ort_rhe=$_SESSION['update']['ort_rhe'];
$ort_cos=$_SESSION['update']['ort_cos'];
$ort_ort=$_SESSION['update']['ort_ort'];
$ort_reh=$_SESSION['update']['ort_reh'];
$ort_pla=$_SESSION['update']['ort_pla'];
$oph_oph=$_SESSION['update']['oph_oph'];
$ent_ent=$_SESSION['update']['ent_ent'];
$ent_to=$_SESSION['update']['ent_to'];
$so_sky=$_SESSION['update']['so_sky'];
$so_org=$_SESSION['update']['so_org'];
$gyn_gyn=$_SESSION['update']['gyn_gyn'];
$gyn_obs=$_SESSION['update']['gyn_obs'];
$gyn_gyne=$_SESSION['update']['gyn_gyne'];
$psy_psy=$_SESSION['update']['psy_psy'];
$psy_psyc=$_SESSION['update']['psy_psyc'];
$den_den=$_SESSION['update']['den_den'];
$den_cav=$_SESSION['update']['den_cav'];
$den_ref=$_SESSION['update']['den_ref'];
$den_ped=$_SESSION['update']['den_ped'];
$alle=$_SESSION['update']['alle'];
$pat=$_SESSION['update']['pat'];
$checkup=$_SESSION['update']['checkup'];
$rad=$_SESSION['update']['rad'];
$cli=$_SESSION['update']['cli'];
$ane=$_SESSION['update']['ane'];
$eme=$_SESSION['update']['eme'];
$bed=$_SESSION['update']['bed'];
$bed_reh=$_SESSION['update']['bed_reh'];
$bed_tre=$_SESSION['update']['bed_tre'];
$bed_main=$_SESSION['update']['bed_main'];
$bed_care=$_SESSION['update']['bed_care'];
$bed_tra=$_SESSION['update']['bed_tra'];
$bed_att=$_SESSION['update']['bed_att'];
$pt=$_SESSION['update']['pt'];
$ot=$_SESSION['update']['ot'];
$st=$_SESSION['update']['st'];
$zipcode=$_SESSION['update']['zipcode'];
$are_cd=$_SESSION['update']['are_cd'];
$area=$_SESSION['update']['area'];
$pre=$_SESSION['update']['pre'];
$city=$_SESSION['update']['city'];
$zone=$_SESSION['update']['zone'];
$town=$_SESSION['update']['town'];
$str_num=$_SESSION['update']['str_num'];
$tel=$_SESSION['update']['tel'];
$fax=$_SESSION['update']['fax'];
//櫻間20230317
$mail=$_SESSION['update']['mail'];
$dep_note=$_SESSION['update']['dep_note'];  //note
$num_note=$_SESSION['update']['num_note'];  //note
$med_ass=$_SESSION['update']['med_ass'];


//高橋
    //($_SESSION['update']);
$drct_note = $_SESSION['update']['drct_note']; //note

//※配列
$rel_insert = $_SESSION['update']['rel_insert'];
$rel_update = $_SESSION['update']['rel_update'];

$fie_insert = $_SESSION['update']['fie_insert'];
$fie_update = $_SESSION['update']['fie_update'];




//高橋20230602_後半タブupdate（SESSION）ここから
$intr_note = $_SESSION['update']['intr_note'];
$tra_note = $_SESSION['update']['tra_note'];
$coop_note = $_SESSION['update']['coop_note'];
$con_note = $_SESSION['update']['con_note'];
$mcare_note = $_SESSION['update']['mcare_note'];

/* ７）連携状況 */
//カルナコネクト
$carna = $_SESSION['update']['carna'];

//連携パス
if(isset($_SESSION['update']['kurashiki_path'])){ $kurashiki_path = $_SESSION['update']['kurashiki_path']; }
if(isset($_SESSION['update']['okayama_path'])) { $okayama_path = $_SESSION['update']['okayama_path']; }

//医療連携懇話会　参加年度
    /*高橋20231121 懇話会追加 */
    if(isset($_SESSION['update']['kurashiki_sm'])) { $kurashiki_sm = $_SESSION['update']['kurashiki_sm']; }
    if(isset($_SESSION['update']['okayama1_sm'])) { $okayama1_sm = $_SESSION['update']['okayama1_sm']; }
    if(isset($_SESSION['update']['okayama2_sm'])) { $okayama2_sm = $_SESSION['update']['okayama2_sm']; }
    /*高橋20231121 懇話会追加 */

/* ８）コンタクト履歴　△7月1日の導入を見送り */

/* ９）診療内容 */
if(isset($_SESSION['update']['med_care'])){ $med_care = $_SESSION['update']['med_care']; }

//高橋20230602_後半タブupdate（SESSION）ここまで

