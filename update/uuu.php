
<?php
/*
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
*/
session_start();
require_once('../functions.php');
require_once('./uuu_control.php');
//$data3 = $_SESSION['update']['data5'];
$dbh = get_db_connect();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

//logupdate($dbh,$hos_name,$hos_cd,$user_id,$user_name,$after1,$after2,$after3,$after4,$after5);
//櫻間
//ここまで




$datetime = date('Y-m-d H:i:s');
//櫻間
log_henkou($dbh,$hos_cd,$datetime,$user_name);

$data=update_null($dbh,$hos_cd);
foreach($data as $key => $var):

//$are_cd=$var['are_cd'];
$ad=$city.$zone.$town.$str_num;
//20231031櫻間
$onf=$var['onf'];
$log_data=$var['log_data'];
$log_name=$var['log_name'];
endforeach; 


//櫻間20230317
//20231031櫻間
update_main($dbh,$op_flg,$hos_div,$clo_day,$chi_name,$chi_spe,$chi_year,$chi_sch,$chi_note,$pre_name,$pre_spe,$pre_year,$pre_sch,$pre_note,$con_hour,$mon_am,$mon_pm,$tue_am,$tue_pm,$wed_am,$wed_pm,$thr_am,$thr_pm,$fri_am,$fri_pm,$sat_am,$sat_pm,$sun_am,$sun_pm,$holiday,$int_int,$int_dig,$int_uri,$int_tum,$int_res,$int_kid,$int_blo,$int_apo,$int_cir,$int_ner,$int_inf,$ped_ped,$ped_sur,$ped_neo,$sur_sur,$sur_lac,$sur_ner,$sur_nes,$sur_dig,$sur_car,$sur_ven,$ort_rhe,$ort_cos,$ort_ort,$ort_reh,$ort_pla,$oph_oph,$ent_ent,$ent_to,$so_sky,$so_org,$gyn_gyn,$gyn_obs,$gyn_gyne,$psy_psy,$psy_psyc,$den_den,$den_cav,$den_ref,$den_ped,$alle,$pat,$checkup,$rad,$cli,$ane,$eme,$bed,$bed_reh,$bed_tre,$bed_main,$bed_care,$bed_tra,$bed_att,$pt,$ot,$st,$hos_cd,$hos_name,$zipcode,$pre,$city,$zone,$town,$str_num,$tel,$fax,$mail,$med_ass,$note,$dep_note,$drct_note,$num_note,$intr_note,$tra_note,$coop_note,$con_note,$ad,$area,$onf,$log_data,$log_name,$are_cd);
//櫻間


//高橋親族情報 更新
    //既存行　update
        //削除は_rowDelete、変更は_rowUpdate
            foreach($rel_update as $key=>$var){
                if(!isset($var['name'])&&!isset($var['conn'])&&!isset($var['sch_name'])&&!isset($var['ent_year'])&&!isset($var['gra_year'])&&!isset($var['rel_note'])){
                    rel_rowDelete($dbh,$hos_cd,$var['rel_cd']);
                }else{
                    rel_rowUpdate($dbh,$hos_cd,$var['name'],$var['conn'],$var['sch_name'],$var['ent_year'],$var['gra_year'],$var['rel_note'], $var['rel_cd']);
                }
            }

    //追加行　insert
    foreach($rel_insert as $key=>$var){
        rel_rowInsert(
            $dbh, $hos_cd, $var['name'],$var['conn'],$var['sch_name'],$var['ent_year'],$var['gra_year'],$var['rel_note'] 
        );
    }



//高橋診療時間・部門連絡先 更新
    //既存行　update
        //削除は_rowDelete、変更は_rowUpdate
        foreach($fie_update as $key=>$var){
            if(!isset($var['fie_div'])&&!isset($var['fie_name'])&&!isset($var['fie_tel'])&&!isset($var['fie_fax'])&&!isset($var['fie_note'])){ 
                fie_rowDelete($dbh,$hos_cd,$var['fie_cd']);
            }else{
                fie_rowUpdate($dbh,$hos_cd,$hos_name,$var['fie_div'],$var['fie_name'],$var['fie_tel'],$var['fie_fax'],$var['fie_note'],$var['fie_cd']);
            }
        }


    //追加行　insert
    foreach($fie_insert as $key=>$var){
        fie_rowInsert($dbh,$hos_cd,$hos_name,$var['fie_div'],$var['fie_name'],$var['fie_tel'],$var['fie_fax'],$var['fie_note']);
    }



//高橋20230602_後半タブ ここから
    //連携状況
        //7-1 カルナコネクト
            carna_Delete($dbh,$hos_cd);
            if($carna === '1'){
                carna_Insert($dbh,$hos_cd); //「登録済」に
            }
        //7-2 連携パス
            //附属病院
            $ins=0; //附
            path_Delete($dbh, $hos_cd, $ins);
            if(!empty($kurashiki_path)){
                path_Insert($dbh, $hos_cd, $ins, $kurashiki_path);
            }
            //総合医療センター
            $ins=1; //総
            path_Delete($dbh, $hos_cd, $ins);
            if(!empty($okayama_path)){
                path_Insert($dbh, $hos_cd, $ins, $okayama_path);
            }

        //7-3医療連携懇話会　参加年度
            /*高橋20231121 懇話会追加 */
            //附属病院
            sm_Delete($dbh, $hos_cd, 0);
            if(!empty($kurashiki_sm)){
                ($kurashiki_sm);
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
        medcare_Delete($dbh,$hos_cd);
        //if(!empty($med_care)){
            medcare_Insert($dbh, $hos_cd, $med_care,$mcare_note); //⭐要注意！
        //}


//高橋20230602_後半タブ ここまで




    
//変更日時、更新者
$datetime = date('Y-m-d H:i:s');
log_henkou($dbh,$_SESSION['hos_cd'],$datetime,$_SESSION['member']['user_name']);


?>






<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>医療機関情報 変更 | 医療機関情報システム</title>
      <!--CSS/JS-->
        <!-- *全画面必須 ---------->
          <!--UIkit3-->
          <link rel="stylesheet" href="../css/uikit.min.css" />
          <script src="../js/uikit.min.js"></script>
          <script src="../js/uikit-icons.min.js"></script>
          <link rel="stylesheet" href="../css/uk-custom.css">
          <!--style.css-->
          <link rel="stylesheet" href="../css/style.css"/>
          <link rel="stylesheet" href="../css/tables.css"/>
          <link rel="stylesheet" href="../css/form_parts.css" />
          <link rel="stylesheet" href="../css/marker.css"/><!--:*marker CSS-->
          <!--*font awesome-->
          <link rel="stylesheet" href="../css/all.min.css" />
        <!--------------------* -->
          <link rel="stylesheet" href="../css/cards.css"/>
          <link rel="stylesheet" href="../css/tab.css"/><!--：タブ-->
          <style>
            .uk-input, .uk-select, .uk-textarea {
              border-color:#000;
            }
          </style>
      <!--js-->
</head>

<body>
    <!-- **header -->
    <?php include_once("../header.php"); ?>
    <header uk-sticky>
      <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="../search/checkbox_control.php">医療機関 検索</a></li>
            <li><a href="../detail/detail_control.php?cd=<?php echo html_escape ($hos_cd); ?>">医療機関 詳細</a></li>
            <li><span>医療機関情報 変更</span></li>
        </ul>
    </header>

    <!-- **main -->
    <main>
        <div class="uk-alert-success" uk-alert>
        <div class="uk-card-header">
            <h2>変更完了</h2>
            <p>変更完了：医療機関情報が変更されました。</p>
        </div>

        <!--button-->
        <div class="uk-flex uk-flex-center">
            <div><!--高橋詳細画面に戻る-->    
            <!--櫻間-->
                <a href="../detail/detail_control.php?cd=<?php echo html_escape ($hos_cd); ?>" class="uk-button uk-button-primary">詳細画面に戻る</a>
            </div>
        </div>
        </div>
    </main>
</body>
</html>
