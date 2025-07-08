<?php
//櫻間
$bed=$_SESSION['update']['bed'];
$bed_main=$_SESSION['update']['bed_main'];
$bed_tre=$_SESSION['update']['bed_tre'];
$bed_reh=$_SESSION['update']['bed_reh'];
$bed_care=$_SESSION['update']['bed_care'];
$bed_tra=$_SESSION['update']['bed_tra'];
$bed_att=$_SESSION['update']['bed_att'];
$pt=$_SESSION['update']['pt'];
$ot=$_SESSION['update']['ot'];
$st=$_SESSION['update']['st'];
$con_hour=$_SESSION['update']['con_hour'];

$mon_am=$_SESSION['update']['mon_am'];
$mon_pm=$_SESSION['update']['mon_pm'];
$tue_am=$_SESSION['update']['tue_am'];
$tue_pm=$_SESSION['update']['tue_pm'];
$wed_am_am=$_SESSION['update']['wed_am'];
$wed_pm=$_SESSION['update']['wed_pm'];
$thr_am=$_SESSION['update']['thr_am'];
$thr_pm=$_SESSION['update']['thr_pm'];
$fri_am=$_SESSION['update']['fri_am'];
$fri_pm=$_SESSION['update']['fri_pm'];
$sat_am=$_SESSION['update']['sat_am'];
$sat_pm=$_SESSION['update']['sat_pm'];
$sun_am=$_SESSION['update']['sun_am'];
$san_pm=$_SESSION['update']['sun_pm'];
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
$rad=$_SESSION['update']['rad'];
$cli=$_SESSION['update']['cli'];
$ane=$_SESSION['update']['ane'];
$eme=$_SESSION['update']['eme'];
$checkup=$_SESSION['update']['checkup'];

$dep_note=$_SESSION['update']['dep_note'];


$data = detail($dbh,$hos_cd) ;
