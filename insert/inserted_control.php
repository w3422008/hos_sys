<?php
/*
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
*/

require_once('../functions.php');
session_start();
$user_adm = $_SESSION['member']['adm_user'];
if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}


/* session */
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
        $mail=$_SESSION['insert']['mail'];
        //櫻間20230317
        $note=$_SESSION['insert']['note'];
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
        $sun_pm=$_SESSION['insert']['sun_pm'];
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
        //備考櫻間
            $drct_note=$_SESSION['insert']['drct_note']; //備考3

    //部門連絡先　※配列
        $fie_insert=$_SESSION['insert']['fie_insert'];
        //備考
            $num_note=$_SESSION['insert']['num_note']; //note

    //高橋20230610_後半タブinsert（SESSION）ここから
    $intr_note = $_SESSION['insert']['intr_note']; //備考5
    $tra_note = $_SESSION['insert']['tra_note']; //備考6
        //カルナコネクト
        $carna = $_SESSION['insert']['carna'];

        //連携パス
        $kurashiki_path = $_SESSION['insert']['kurashiki_path'];
        $okayama_path = $_SESSION['insert']['okayama_path'];
        
        $coop_note = $_SESSION['insert']['coop_note']; //備考7
         //コンタクト履歴
        $con_note = $_SESSION['insert']['con_note']; //備考8
        //医療連携懇話会　参加年度
            /*高橋20231121 懇話会追加 */
            if(isset($_SESSION['insert']['kurashiki_sm'])) { $kurashiki_sm = $_SESSION['insert']['kurashiki_sm']; }
            if(isset($_SESSION['insert']['okayama1_sm'])) { $okayama1_sm = $_SESSION['insert']['okayama1_sm']; }
            if(isset($_SESSION['insert']['okayama2_sm'])) { $okayama2_sm = $_SESSION['insert']['okayama2_sm']; }
            /*高橋20231121 懇話会追加 */



        //診療内容
        $med_care = $_SESSION['insert']['med_care'];
        $mcare_note = $_SESSION['insert']['mcare_note']; //備考9

    //高橋20230610_後半タブinsert（SESSION）ここまで
    
/* sessionここまで */


$user_id = $_SESSION['member']['user_id'];
$dbh = get_db_connect();
//櫻間20230511
    $user_adm = $_SESSION['member']['adm_user'];
    $datetime = date('Y-m-d H:i:s');
    $insert_log=$datetime;
    $data=insert_userlog($dbh,$user_id);
    foreach($data as $key => $var):
    $user_name=$var['user_name'];
    $ins=$var['ins'];
    $bel=$var['bel'];
    $adm_user=$var['adm_user']; 
endforeach; 
 //櫻間20230511   
 
    //記入されないもの
    $ad=$city.$zone.$town.$str_num;
//20231031櫻間
    $onf=0;
    $log_data="";
    $log_name="";


//櫻間20230317
//20231031櫻間
    //基本情報、診療時間・診療科等、理事長病院長情報、備考
        insert_hos($dbh,$op_flg,$med_ass,$hos_div,$hos_cd,$hos_name,$zipcode,$ad,$tel,$fax,$mail,$are_cd,$pre,$area,$city,$zone,$town,$str_num,$note,$clo_day,$chi_name,$chi_spe,$chi_year,$chi_sch,$chi_note,$pre_name,$pre_spe,$pre_year,$pre_sch,$pre_note,$con_hour,$mon_am,$mon_pm,$tue_am,$tue_pm,$wed_am,$wed_pm,$thr_am,$thr_pm,$fri_am,$fri_pm,$sat_am,$sat_pm,$sun_am,$sun_pm,$holiday,$int_med,$ped_med,$sur_med,$ort_med,$oph_med,$ent_med,$so_med,$gyn_med,$psy_med,$den_med,$etc_med, $int_int,$int_dig,$int_uri,$int_tum,$int_res,$int_kid,$int_blo,$int_apo,$int_cir,$int_ner,$int_inf,$ped_ped,$ped_sur,$ped_neo,$sur_sur,$sur_lac,$sur_ner,$sur_nes,$sur_dig,$sur_car,$sur_ven,$ort_rhe,$ort_cos,$ort_ort,$ort_reh,$ort_pla,$oph_oph,$ent_ent,$ent_to,$so_sky,$so_org,$gyn_gyn,$gyn_obs,$gyn_gyne,$psy_psy,$psy_psyc,$den_den,$den_cav,$den_ref,$den_ped,$alle,$pat,$checkup,$rad,$cli,$ane,$eme,$bed,$bed_reh,$bed_tre,$bed_main,$bed_care,$bed_tra,$bed_att,$pt,$ot,$st,$onf,$dep_note,$num_note,$drct_note,$intr_note,$tra_note,$coop_note,$con_note,$log_data,$log_name);
        //高橋20230627 後半タブ備考追加 intr_note,tra_note,coop_note
        //高橋20230704 mcare_note：削除
        

//高橋20221130
    //親族情報relative
    foreach($rel_insert as $key => $var){
        rel_rowInsert($dbh,$hos_cd,$var['name'],$var['conn'],$var['sch_name'],$var['ent_year'],$var['gra_year'],$var['rel_note']);
    }

    //部門連絡先field_junction
    foreach($fie_insert as $key => $var){
        fie_rowInsert($dbh,$hos_cd,$hos_name,$var['fie_div'],$var['fie_name'],$var['fie_tel'],$var['fie_fax'],$var['fie_note']);
    }



//高橋20230602_後半タブ ここから
    //連携状況
        //7-1 カルナコネクト
        if(isset($carna) && $carna === '1'){
            carna_Insert($dbh,$hos_cd); //「登録済」に
        }

    //高橋20230721
    //7-2 連携パス
        //附属病院
        if(!empty($kurashiki_path)){
            path_Insert($dbh, $hos_cd, 0, $kurashiki_path);
        }
        //総合医療センター
        if(!empty($okayama_path)){
            path_Insert($dbh, $hos_cd, 1, $okayama_path);
        }
    

    //7-3医療連携懇話会　参加年度
        /*高橋20231121 懇話会追加 */
            //附属病院
            sm_Delete($dbh, $hos_cd, 0);
            if(!empty($kurashiki_sm)){
                foreach($kurashiki_sm as $sm){
                sm_Insert($dbh, $hos_cd, 0, trim($sm));
                }
            }
            //総合医療センター
            sm_Delete($dbh, $hos_cd, 1);
            if(!empty($okayama1_sm)){
                foreach($okayama1_sm as $sm){
                sm_Insert($dbh, $hos_cd, 1, trim($sm));
                }
            }
            //高齢者医療センター
            sm_Delete($dbh, $hos_cd, 2);
            if(!empty($okayama2_sm)){
                foreach($okayama2_sm as $sm){
                    sm_Insert($dbh, $hos_cd, 2, trim($sm));
                }
            }
        /*高橋20231121 懇話会追加 */



    //9 診療内容
        medcare_Insert($dbh, $hos_cd, $med_care, $mcare_note); //⭐要注意！


//高橋20230602_後半タブ ここまで











//insert_log
//櫻間20230511
log_new($dbh,$hos_cd,$hos_name,$insert_log,$user_name,$user_id,$ins,$bel,$adm_user);
//櫻間20230511


//櫻間
if(isset($_SESSION)){
    unset($_SESSION['insert']);
}
include_once('inserted_view.php');
?>