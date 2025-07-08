<?php
//嶋津20230105
require_once('../functions.php');
session_start();
$user_adm = $_SESSION['member']['adm_user'];
if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

/* --- POST --- */
    //基本情報
        $op_flg=$_POST['op_flg'];
        $hos_div=$_POST['hos_div'];
        $hos_cd=$_POST['hos_cd'];        
        if($op_flg ==='0'){
            $clo_day =$_POST['clo_day'];
            }else{
                $clo_day ='';
            }
            $med_ass=$_POST['med_ass'];
            $hos_name=$_POST['hos_name'];
            $zipcode=$_POST['zipcode'];

            /* 高橋20230513　ここから */
            //$are_cd=$_POST['are_cd'];
            //$area=$_POST['area'];
            if($_POST['pre']==="岡山県"){
                $area=$_POST['area1'];
                $are_cd=$_POST['are_cd1'];
            }elseif($_POST['pre']==="広島県"){
                $area=$_POST['area2'];
                $are_cd=$_POST['are_cd2'];
            }
            /* 高橋20230513　ここまで */

            $pre=$_POST['pre'];
            $city=$_POST['city'];
            $zone=$_POST['zone'];
            $town=$_POST['town'];
            $str_num=$_POST['str_num'];
            $tel=$_POST['tel'];
            $fax=$_POST['fax'];
             //櫻間20230317
             $mail=$_POST['mail'];

            $note=$_POST['note'];   //備考1
//嶋津20230105
$dbh = get_db_connect();
$hos_cd_check = hos_cd_check($dbh,$hos_cd);
foreach($hos_cd_check as $key => $var):
    if($hos_cd === $var['hos_cd']){
        $err="その医療機関コードはすでに登録されています。";
}
endforeach;

    //診療時間・診療科等
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
            $mon_a=$_POST['mon_am'];
        $_SESSION['insert']['mon_a']=$mon_a;    
        $mon_a=$_SESSION['insert']['mon_a'];
        
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
        $mon_p= $_POST['mon_pm'];
        $_SESSION['insert']['mon_p']=$mon_p;    
        $mon_p=$_SESSION['insert']['mon_p'];


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
        $tue_a= $_POST['tue_am'];
        $_SESSION['insert']['tue_a']=$tue_a;    
        $tue_a=$_SESSION['insert']['tue_a'];

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
        $tue_p= $_POST['tue_pm'];
        $_SESSION['insert']['tue_p']=$tue_p;    
        $tue_p=$_SESSION['insert']['tue_p'];

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
        $wed_a= $_POST['wed_am'];
        $_SESSION['insert']['wed_a']=$wed_a;    
        $wed_a=$_SESSION['insert']['wed_a'];

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
        $wed_p= $_POST['wed_pm'];
        $_SESSION['insert']['wed_p']=$wed_p;    
        $wed_p=$_SESSION['insert']['wed_p'];

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
            $thr_a=$_POST['thr_am'];
        $_SESSION['insert']['thr_a']=$thr_a;    
        $thr_a=$_SESSION['insert']['thr_a'];
    
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

        $thr_p= $_POST['thr_pm'];
        $_SESSION['insert']['thr_p']=$thr_p;    
        $thr_p=$_SESSION['insert']['thr_p'];

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

        $fri_a= $_POST['fri_am'];
        $_SESSION['insert']['fri_a']=$fri_a;    
        $fri_a=$_SESSION['insert']['fri_a'];

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

        $fri_p= $_POST['fri_pm'];
        $_SESSION['insert']['fri_p']=$fri_p;    
        $fri_p=$_SESSION['insert']['fri_p'];

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
        
        
        $sat_a= $_POST['sat_am'];
        $_SESSION['insert']['sat_a']=$sat_a;    
        $sat_a=$_SESSION['insert']['sat_a'];

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
        $sat_p= $_POST['sat_pm'];
        $_SESSION['insert']['sat_p']=$sat_p;    
        $sat_p=$_SESSION['insert']['sat_p'];

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
        $sun_a= $_POST['sun_am'];
        $_SESSION['insert']['sun_a']=$sun_a;    
        $sun_a=$_SESSION['insert']['sun_a'];

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

            $sun_p=$_POST['sun_pm'];   
        $_SESSION['insert']['sun_p']=$sun_p;    
        $sun_p=$_SESSION['insert']['sun_p'];
        
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
        
        $holida= $_POST['holiday'];
        $_SESSION['insert']['holida']=$holida;    
        $holida=$_SESSION['insert']['holida'];



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

        if(($int_int == '1')||($int_dig == '1')||($int_uri == '1')||($int_tum == '1')||($int_res == '1')||($int_kid == '1')||($int_blo == '1')||($int_apo == '1')||($int_cir == '1')||($int_ner == '1')||($int_inf == '1')){
            $int_med ='1';
        }else{
            $int_med = "";
        }

        if(($ped_ped == '1')||($ped_sur == '1')||($ped_neo == '1')){
            $ped_med ='1';
        }else{
            $ped_med = "";
        }
        if(($sur_sur == '1')||($sur_lac == '1')||($sur_ner == '1')||($sur_nes == '1')||($sur_dig == '1')||($sur_car == '1')||($sur_ven == '1')){
            $sur_med ='1';
        }else{
            $sur_med = "";
        }
        if(($ort_rhe == '1')||($ort_cos == '1')||($ort_ort == '1')||($ort_reh == '1')||($ort_pla == '1')){
            $ort_med ='1';
        }else{
            $ort_med = "";
        }
        if(($oph_oph == '1')){
            $oph_med ='1';
        }else{
            $oph_med = "";
        }
        if(($ent_ent == '1')||($ent_to == '1')){
            $ent_med ='1';
        }else{
            $ent_med = "";
        }
        if(($so_sky == '1')||($so_org == '1')){
            $so_med ='1';
        }else{
            $so_med = "";
        }
        if(($gyn_gyn == '1')||($gyn_obs == '1')||($gyn_gyne == '1')){
            $gyn_med ='1';
        }else{
            $gyn_med = "";
        }
        if(($psy_psy == '1')||($psy_psyc == '1')){
            $psy_med ='1';
        }else{
            $psy_med = "";
        }
        if(($den_den == '1')||($den_cav == '1')||($den_ref == '1')||($den_ped == '1')){
            $den_med ='1';
        }else{
            $den_med = "";
        }
        if(($alle == '1')||($pat == '1')||($checkup == '1')||($rad == '1')||($cli == '1')||($ane == '1')||($eme == '1')){
            $etc_med ='1';
        }else{
            $etc_med = "";
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
        $dep_note=$_POST['dep_note'];   //備考2
        $con_hour=$_POST['con_hour'];

    //理事長・病院長情報
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
    
        //親族情報　※配列
            // **insert
                $rel_insert=array();
                if(isset($_POST['rel_insert'])){
                    $rel_insert=$_POST['rel_insert'];
                }
        //備考
            //櫻間
            $drct_note = $_POST['drct_note'];   //備考3
        

    //部門連絡先　※配列
        // **insert
            $fie_insert=array();
            if(isset($_POST['fie_insert'])){
                $fie_insert=$_POST['fie_insert'];
            }
        //備考櫻間
            $num_note = $_POST['num_note']; //備考4



    //高橋20230610_後半タブinsert（POST）ここから
        //5 紹介・逆紹介
        $intr_note=$_POST['intr_note']; //備考5
        //6 院外支援・研修
        $tra_note=$_POST['tra_note']; //備考6

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

        $coop_note=$_POST['coop_note']; //備考7

        //8-コンタクト履歴　△7月1日の導入を見送り

        $con_note=$_POST['con_note']; //備考8
        //9-診療内容
            $med_care=array();
            if(isset($_POST['med_care'])){ $med_care = $_POST['med_care']; }

        $mcare_note=$_POST['mcare_note']; //備考9


    //高橋20230610_後半タブinsert（POST）ここまで


/* --- POSTここまで --- */



/* --- SESSIONに保存 --- */
    //基本情報
        $_SESSION['insert']['hos_cd']=$hos_cd;
        $_SESSION['insert']['op_flg']=$op_flg;
        $_SESSION['insert']['med_ass']=$med_ass;
        $_SESSION['insert']['are_cd']=$are_cd;
        $_SESSION['insert']['hos_div']=$hos_div;
        $_SESSION['insert']['hos_name']=$hos_name;
        $_SESSION['insert']['zipcode']=$zipcode;
        $_SESSION['insert']['area']=$area;
        $_SESSION['insert']['pre']=$pre;
        $_SESSION['insert']['city']=$city;
        $_SESSION['insert']['zone']=$zone;
        $_SESSION['insert']['town']=$town;
        $_SESSION['insert']['str_num']=$str_num;
        $_SESSION['insert']['tel']=$tel;
        $_SESSION['insert']['fax']=$fax;
        //櫻間20230317
        $_SESSION['insert']['mail']=$mail;
        $_SESSION['insert']['note']=$note;
        if($_SESSION['insert']['op_flg'] ==='0'){
        $_SESSION['insert']['clo_day']=$clo_day;
        }else{
            $_SESSION['insert']['clo_day']='';
        }

    //診療時間・診療科等
        $_SESSION['insert']['con_hour']=$con_hour;
        $_SESSION['insert']['mon_am']=$mon_am;
        $_SESSION['insert']['mon_pm']=$mon_pm;
        $_SESSION['insert']['tue_am']=$tue_am;
        $_SESSION['insert']['tue_pm']=$tue_pm;
        $_SESSION['insert']['wed_am']=$wed_am;
        $_SESSION['insert']['wed_pm']=$wed_pm;
        $_SESSION['insert']['thr_am']=$thr_am;
        $_SESSION['insert']['thr_pm']=$thr_pm;
        $_SESSION['insert']['fri_am']=$fri_am;
        $_SESSION['insert']['fri_pm']=$fri_pm;
        $_SESSION['insert']['sat_am']=$sat_am;
        $_SESSION['insert']['sat_pm']=$sat_pm;
        $_SESSION['insert']['sun_am']=$sun_am;
        $_SESSION['insert']['sun_pm']=$sun_pm;
        $_SESSION['insert']['holiday']=$holiday;

        $_SESSION['insert']['int_med']=$int_med;
        $_SESSION['insert']['ped_med']=$ped_med;
        $_SESSION['insert']['sur_med']=$sur_med;
        $_SESSION['insert']['ort_med']=$ort_med;
        $_SESSION['insert']['oph_med']=$oph_med;
        $_SESSION['insert']['ent_med']=$ent_med;
        $_SESSION['insert']['so_med']=$so_med;
        $_SESSION['insert']['gyn_med']=$gyn_med;
        $_SESSION['insert']['psy_med']=$psy_med;
        $_SESSION['insert']['den_med']=$den_med;
        $_SESSION['etc_med']['den_med']=$etc_med;

        $_SESSION['insert']['int_int']=$int_int;
        $_SESSION['insert']['int_dig']=$int_dig;
        $_SESSION['insert']['int_uri']=$int_uri;
        $_SESSION['insert']['int_tum']=$int_tum;
        $_SESSION['insert']['int_res']=$int_res;
        $_SESSION['insert']['int_kid']=$int_kid;
        $_SESSION['insert']['int_blo']=$int_blo;
        $_SESSION['insert']['int_apo']=$int_apo;
        $_SESSION['insert']['int_cir']=$int_cir;
        $_SESSION['insert']['int_ner']=$int_ner;
        $_SESSION['insert']['int_inf']=$int_inf;
        $_SESSION['insert']['ped_ped']=$ped_ped;
        $_SESSION['insert']['ped_sur']=$ped_sur;
        $_SESSION['insert']['ped_neo']=$ped_neo;
        $_SESSION['insert']['sur_sur']=$sur_sur;
        $_SESSION['insert']['sur_lac']=$sur_lac;
        $_SESSION['insert']['sur_ner']=$sur_ner;
        $_SESSION['insert']['sur_nes']=$sur_nes;
        $_SESSION['insert']['sur_dig']=$sur_dig;
        $_SESSION['insert']['sur_car']=$sur_car;
        $_SESSION['insert']['sur_ven']=$sur_ven;
        $_SESSION['insert']['ort_rhe']=$ort_rhe;
        $_SESSION['insert']['ort_cos']=$ort_cos;
        $_SESSION['insert']['ort_ort']=$ort_ort;
        $_SESSION['insert']['ort_reh']=$ort_reh;
        $_SESSION['insert']['ort_pla']=$ort_pla;
        $_SESSION['insert']['oph_oph']=$oph_oph;
        $_SESSION['insert']['ent_ent']=$ent_ent;
        $_SESSION['insert']['ent_to']=$ent_to;
        $_SESSION['insert']['so_sky']=$so_sky;
        $_SESSION['insert']['so_org']=$so_org;
        $_SESSION['insert']['gyn_gyn']=$gyn_gyn;
        $_SESSION['insert']['gyn_obs']=$gyn_obs;
        $_SESSION['insert']['gyn_gyne']=$gyn_gyne;
        $_SESSION['insert']['psy_psy']=$psy_psy;
        $_SESSION['insert']['psy_psyc']=$psy_psyc;
        $_SESSION['insert']['den_den']=$den_den;
        $_SESSION['insert']['den_cav']=$den_cav;
        $_SESSION['insert']['den_ref']=$den_ref;
        $_SESSION['insert']['den_ped']=$den_ped;
        $_SESSION['insert']['alle']=$alle;
        $_SESSION['insert']['pat']=$pat;
        $_SESSION['insert']['checkup']=$checkup;
        $_SESSION['insert']['rad']=$rad;
        $_SESSION['insert']['cli']=$cli;
        $_SESSION['insert']['ane']=$ane;
        $_SESSION['insert']['eme']=$eme;
        $_SESSION['insert']['bed']=$bed;
        $_SESSION['insert']['bed_reh']=$bed_reh;
        $_SESSION['insert']['bed_tre']=$bed_tre;
        $_SESSION['insert']['bed_main']=$bed_main;
        $_SESSION['insert']['bed_care']=$bed_care;
        $_SESSION['insert']['bed_tra']=$bed_tra;
        $_SESSION['insert']['bed_att']=$bed_att;
        $_SESSION['insert']['pt']=$pt;
        $_SESSION['insert']['ot']=$ot;
        $_SESSION['insert']['st']=$st;
        $_SESSION['insert']['dep_note']=$dep_note;

    //理事長・病院長情報
        //理事長
            $_SESSION['insert']['chi_name']=$chi_name;
            $_SESSION['insert']['chi_spe']=$chi_spe;
            $_SESSION['insert']['chi_year']=$chi_year;
            $_SESSION['insert']['chi_sch']=$chi_sch;
            $_SESSION['insert']['chi_note']=$chi_note;
        //病院長
            $_SESSION['insert']['pre_name']=$pre_name;
            $_SESSION['insert']['pre_spe']=$pre_spe;
            $_SESSION['insert']['pre_year']=$pre_year;
            $_SESSION['insert']['pre_sch']=$pre_sch;
            $_SESSION['insert']['pre_note']=$pre_note;
        //親族情報　※配列
            $_SESSION['insert']['rel_insert'] = $rel_insert;
        //備考櫻間
            $_SESSION['insert']['drct_note'] = $drct_note; //備考3

    //部門連絡先　※配列
        $_SESSION['insert']['fie_insert'] = $fie_insert;
        //備考櫻間
            $_SESSION['insert']['num_note'] = $num_note; //備考4



    //高橋20230610_後半タブinsert（SESSION）ここから
    $_SESSION['insert']['intr_note'] = $intr_note; //備考5
    $_SESSION['insert']['tra_note'] = $tra_note; //備考6

        //7-1 カルナコネクト
        $_SESSION['insert']['carna'] = $carna;

        //7-2 連携パス
        $_SESSION['insert']['kurashiki_path'] = $kurashiki_path;
        $_SESSION['insert']['okayama_path'] = $okayama_path;

        //7-3 医療連携懇話会　参加年度
            /*高橋20231121 懇話会追加 */
            if(!empty($kurashiki_sm)){ $_SESSION['insert']['kurashiki_sm'] = $kurashiki_sm; }
            if(!empty($okayama1_sm)){ $_SESSION['insert']['okayama1_sm'] = $okayama1_sm; }
            if(!empty($okayama2_sm)){ $_SESSION['insert']['okayama2_sm'] = $okayama2_sm; }
            /*高橋20231121 懇話会追加 */

        $_SESSION['insert']['coop_note'] = $coop_note; //備考7

        //8 コンタクト履歴　△7月1日の導入を見送り
        $_SESSION['insert']['con_note'] = $con_note; //備考8
        //9 診療内容
        $_SESSION['insert']['med_care'] = $med_care; 
        $_SESSION['insert']['mcare_note'] = $mcare_note; //備考9

    //高橋20230610_後半タブinsert（SESSION）ここまで

            
/* --- SESSIONに保存ここまで --- */


/* --- 変数に保存 --- */
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
        $note=$_SESSION['insert']['note'];  //備考1

    //診療時間・診療科等
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
        $san_pm=$_SESSION['insert']['sun_pm'];
        $holiday=$_SESSION['insert']['holiday'];



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

        $dep_note=$_SESSION['insert']['dep_note'];  //備考2


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
        //備考櫻間
            $drct_note=$_SESSION['insert']['drct_note']; //備考3

    //部門連絡先　※配列
        $fie_insert=$_SESSION['insert']['fie_insert'];
        //備考櫻間
            $num_note=$_SESSION['insert']['num_note']; //備考4



    //高橋20230610_後半タブinsert（変数）ここから
    $intr_note = $_SESSION['insert']['intr_note']; //備考5
    $tra_note = $_SESSION['insert']['tra_note']; //備考6

        //7-1 カルナコネクト
        $carna = $_SESSION['insert']['carna'];

        //7-2 連携パス
            if(!empty($_SESSION['insert']['kurashiki_path'])){ $kurashiki_path = $_SESSION['insert']['kurashiki_path']; }
            if(!empty($_SESSION['insert']['okayama_path'])){ $okayama_path = $_SESSION['insert']['okayama_path']; }

        //7-3 医療連携懇話会　参加年度
            //social_meetingテーブル

        $coop_note = $_SESSION['insert']['coop_note']; //備考7

        //8 コンタクト履歴　△7月1日の導入を見送り
        $con_note = $_SESSION['insert']['con_note']; //備考7
        //9 診療内容
        if(!empty($_SESSION['insert']['med_care'])){ $med_care = $_SESSION['insert']['med_care']; }
        $mcare_note = $_SESSION['insert']['mcare_note']; //備考9

    //高橋20230610_後半タブinsert（変数）ここまで


/* --- 変数に保存　ここまで --- */

include_once('./check_view.php');