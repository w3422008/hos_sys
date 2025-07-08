<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL);
//ユーザー定義関数ファイルfunctions.phpの読み込み
require_once('../functions.php');

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

//データベース接続
$dbh = get_db_connect();

//櫻間
$user_adm = $_SESSION['member']['adm_user'];


$int_int = '';
$int_dig = '';
$int_uri = '';
$int_tum = '';
$int_res = '';
$int_kid = '';
$int_blo = '';
$int_apo = '';
$int_cir = '';
$int_inf = '';
$int_ner = '';

$ped_ped = '';
$ped_sur = '';
$ped_neo = '';

$sur_sur = '';
$sur_lac = '';
$sur_ner = '';
$sur_nes = '';
$sur_dig = '';
$sur_car = '';
$sur_ven = '';

$ort_rhe = '';
$ort_cos = '';
$ort_ort = '';
$ort_reh = '';
$ort_pla = '';

$oph_oph = '';

$ent_ent = '';
$ent_to  = '';

$so_sky  = '';
$so_org  = '';

$gyn_gyn  = '';
$gyn_obs  = '';
$gyn_gyne  = '';

$psy_psy  = '';
$psy_psyc  = '';

$den_den  = '';
$den_cav  = '';
$den_ref  = '';
$den_ped  = '';

$alle  = '';
$pat  = '';
$checkup  = '';
$rad  = '';
$cli  = '';
$ane  = '';
$eme  = '';

//POSTで情報が飛んできた時だけ受け取る&セッションに入れる
if (isset($_POST['kakutei'])){
   //session_destroy();
$_SESSION['college'] = "";
$_SESSION['chi'] = "";
$_SESSION['pre'] = "";
//値に応じて表示する数を変える　大井
$_SESSION['display'] = '';

$hos_name = get_post('hos_name');
$_SESSION['hos_name'] = $hos_name;

//櫻間20221101
$entryPlan = get_post('entryPlan');
$_SESSION['entryPlan'] = $entryPlan;

$chi = "";
$pre = "";
$college = "";

if($entryPlan === 'hoge3'&&(get_post('college')!=='')){
    $college =get_post('college');
    $_SESSION['college'] = $college;
   $all=0;
$_SESSION['all'] = $all;
$all=$_SESSION['all'];
}elseif($entryPlan === 'hoge1'&&(get_post('chi')!=='')){
    $chi =get_post('chi');
    $_SESSION['chi'] = $chi;
    $all=0;
$_SESSION['all'] = $all;
$all=$_SESSION['all'];
}elseif($entryPlan === 'hoge2'&&(get_post('pre')!=='')){
    $pre =get_post('pre');
    $_SESSION['pre'] = $pre;
    $all=0;
$_SESSION['all'] = $all;
$all=$_SESSION['all'];
}elseif($entryPlan === 'hoge3'&&(get_post('college')=='')){
$err3='理事長・病院長出身校を入力してください。';
$_SESSION['err']['err3']=$err3;
$err3=$_SESSION['err']['err3'];
$college1 ="";
$_SESSION['err']['college'] = $college1;
$college1 = $_SESSION['err']['college'];
$college = "1";
$_SESSION['college'] = $college;

$chi1 ="1";
$_SESSION['err']['chi'] = $chi1;
$chi1 = $_SESSION['err']['chi'];
$pre1 ="1";
$_SESSION['err']['pre'] = $pre1;
$pre1 = $_SESSION['err']['pre'];

$all=0;
$_SESSION['all'] = $all;
$all=$_SESSION['all'];
}elseif($entryPlan === 'hoge1'&&(get_post('chi')=='')){
    $err1='理事長出身校を入力してください。';
    $_SESSION['err']['err1']=$err1;
    $err1=$_SESSION['err']['err1'];
    
    $college1 ="1";
    $_SESSION['err']['college'] = $college1;
    $college1 = $_SESSION['err']['college'];
    $chi1 ="";
    $_SESSION['err']['chi'] = $chi1;
    $chi1 = $_SESSION['err']['chi'];
    $chi = "1";
    $_SESSION['chi'] = $chi;
    
     $pre1 ="1";
    $_SESSION['err']['pre'] = $pre1;
    $pre1 = $_SESSION['err']['pre'];

    $all=0;
$_SESSION['all'] = $all;
$all=$_SESSION['all'];
}elseif($entryPlan === 'hoge2'&&(get_post('pre')=='')){
    $err2='病院長出身校を入力してください。';
    $_SESSION['err']['err2']=$err2;
    $err2=$_SESSION['err']['err2'];
    $college1 ="1";
    $_SESSION['err']['college'] = $college1;
    $college1 = $_SESSION['err']['college'];
    $chi1 ="1";
    $_SESSION['err']['chi'] = $chi1;
    $chi1 = $_SESSION['err']['chi'];
    $pre1 ="";
    $_SESSION['err']['pre'] = $pre1;
    $pre1 = $_SESSION['err']['pre'];
    $pre = "1";
    $_SESSION['pre'] = $pre;

    $all=0;
$_SESSION['all'] = $all;
$all=$_SESSION['all'];
}elseif($entryPlan === 'hoge0'){
$all=$entryPlan;
$_SESSION['all'] = $all;
$all=$_SESSION['all'];
}
//櫻間20221101

$hos_div = array();
$hos_div= $_POST['hos_div'];
unset($hos_div[0]);
$_SESSION['hos_div'] = $hos_div;
$count = 0;
$hos_diva = '';
 
foreach ($hos_div as $value) {
    if ($count == 0) {
        $hos_diva .= "'".$value."'";
    } else {
        $hos_diva .= ",". "'".$value."'";
    }
    $count++;
}
$_SESSION['hos_diva'] = $hos_diva;



$bed = array();
$bed= $_POST['bed'];
unset($bed[0]);
$_SESSION['bed'] = $bed;
$count50 = 0;
$beda = '';
 
foreach ($bed as $value) {
    if ($count50 == 0) {
        $beda .= "'".$value."'";
    } else {
        $beda .= ",". "'".$value."'";
    }
    $count50++;
}
$_SESSION['beda'] = $beda;


$condition =  array();
$condition = $_POST['condition'];
unset($condition[0]);
$count1 = 0;
$count0 = 0;
$conditiona=''; 
$_SESSION['condition'] = $condition;


foreach ($condition as $value) {
    $a='';
    if ($count0 == 0) {
        $a .= $value;
    } else {
        $a .= ",".$value;
    }
    $_SESSION['a']=$a;

    if ($count1 == 0) {
        $conditiona .= "'".$value."'";
    } else {
        $conditiona .= ",". "'".$value."'";
    }
    $count1++;
}
$_SESSION['conditiona'] = $conditiona;


//紹介・逆紹介
$year = get_post('year');
$_SESSION['year'] = $year;

$intro='';
$r_intro='';
$introduction = array();
$introduction = $_POST['introduction'];
unset($introduction[0]);

//櫻間20230616から
$_SESSION['introduction'] = $introduction;
$kura='';
$oka='';
$okakura ='';
$kawasaki =array();
$kawasaki = $_POST['kawasaki'];
unset($kawasaki[0]);
$_SESSION['kawasaki'] = $kawasaki;
//櫻間20230616まで



$year_intro='';
$year_r_intro='';
$yeary='';
$introa='';
$r_introa='';


foreach($introduction as $var):

    if($var === '紹介あり'){
        $intro = '1';
    }
    if($var === '逆紹介あり'){
        $r_intro = '1';
    }

endforeach;
$_SESSION['intro'] = $intro;
$_SESSION['r_intro'] = $r_intro;

//櫻間20230616から
foreach($kawasaki as $var):

    if($var === '1'){
        $kura = '1';
    }
    if($var === '2'){
        $oka = '1';
    }


endforeach; 

if($kura==='1' && $oka ==='1'){
    $kura = '';
    $oka = '';
    $okakura = '1';
}elseif($kura==='1' && $oka ===''){
    $kura = '1';
    $oka = '';
}elseif($kura==='' && $oka ==='1'){
    $kura = '';
    $oka = '1';  
}

$_SESSION['kura'] = $kura;
$_SESSION['oka'] = $oka;
$_SESSION['okakura'] = $okakura;


$intro_flag = '';
$r_intro_flag = '';

if(($year !=='') || ($intro !== '') || (!empty($kawasaki))){
    $intro_flag = '1';
    $_SESSION['intro_flag'] = $intro_flag;
  
}

if(($year !=='') || ($r_intro !== '') || (!empty($kawasaki))){
    $r_intro_flag = '1';
    $_SESSION['r_intro_flag'] = $r_intro_flag;
  
}


$_SESSION['yeary'] = $yeary;
$_SESSION['year_intro'] = $year_intro;
$_SESSION['year_r_intro'] = $year_r_intro;
$_SESSION['introa'] = $introa;
$_SESSION['r_introa'] = $r_introa;
//櫻間20230616まで


$week = array();
$week = $_POST['week'];
unset($week[0]);
$count18 = 0;
$weeka=''; 
$_SESSION['week'] = $week;
foreach ($week as $value) {
    //櫻間20221101
    if($value !== 'on'){
         //櫻間20221101
        if ($count18 == 0) {
            $weeka .= "'".$value."'";
        } else {
            $weeka .= ",". "'".$value."'";
        }
    }
        $count18++;
    }
    $_SESSION['weeka'] = $weeka;

$mon_am = '';
$mon_pm  = '';
$tue_am = '';
$tue_pm = '';
$wed_am = '';
$wed_pm = '';
$thr_am = '';
$thr_pm = '';
$fri_am = '';
$fri_pm = '';
$sat_am = '';
$sat_pm = '';
$sun_am = '';
$sun_pm = '';
$holiday = '';


if(isset($week)){
foreach ($week as $value):
    if ($value === '月am') {
        $mon_am = '●';
    }elseif($value === '月pm') {
        $mon_pm = '●';
    }elseif($value === '火am') {
        $tue_am = '●';
    }elseif($value === '火pm') {
        $tue_pm = '●';
    }elseif($value === '水am') {
        $wed_am = '●';
    }elseif($value === '水pm') {
        $wed_pm = '●';
    }elseif($value === '木am') {
        $thr_am = '●';
    }elseif($value === '木pm') {
        $thr_pm = '●';
    }elseif($value === '金am') {
        $fri_am = '●';
    }elseif($value === '金pm') {
        $fri_pm = '●';
    }elseif($value === '土am') {
        $sat_am = '●';
    }elseif($value === '土pm') {
        $sat_pm = '●';
    }elseif($value === '日am') {
        $sun_am = '●';
    }elseif($value === '日pm') {
        $sun_pm = '●';
    }elseif($value === '祝日') {
        $holiday= '●';
    }

endforeach;
}

$naika = array();
$naika = $_POST['naika'];
unset($naika[0]);;
$count8 = 0;
$naikaa=''; 
$_SESSION['naika'] = $naika;
foreach ($naika as $value) {
        if ($count8 == 0) {
            $naikaa .= "'".$value."'";
        } else {
            $naikaa .= ",". "'".$value."'";
        }
        $count8++;
    }
    $_SESSION['naikaa'] = $naikaa;


$syounika = array();
$syounika = $_POST['syounika'];
unset($syounika[0]);
$count9 = 0;
$syounikaa=''; 
$_SESSION['syounika'] = $syounika;
foreach ($syounika as $value) {
        if ($count9 == 0) {
            $syounikaa .= "'".$value."'";
        } else {
            $syounikaa .= ",". "'".$value."'";
        }
        $count9++;
    }
    $_SESSION['syounikaa'] = $syounikaa;
   
    foreach ($syounika as $value) {
        $naika[] = $value;
    }
    

$geka = array();
$geka = $_POST['geka'];
unset($geka[0]);
$count10 = 0;
$gekaa=''; 
$_SESSION['geka'] = $geka;
foreach ($geka as $value) {
        if ($count10 == 0) {
            $gekaa .= "'".$value."'";
        } else {
            $gekaa .= ",". "'".$value."'";
        }
        $count10++;
    }
    $_SESSION['gekaa'] = $gekaa;


    foreach ($geka as $value) {
        $naika[] = $value;
    }
    

$seikei = array();
$seikei = $_POST['seikei'];
unset($seikei[0]);
$count11 = 0;
$seikeia=''; 
$_SESSION['seikei'] = $seikei;
foreach ($seikei as $value) {
        if ($count11 == 0) {
            $seikeia .= "'".$value."'";
        } else {
            $seikeia .= ",". "'".$value."'";
        }
        $count11++;
    }
    $_SESSION['seikeia'] = $seikeia;
 
        foreach ($seikei as $value) {
        $naika[] = $value;
    }
    
$ganka = array();
$ganka = $_POST['ganka'];
unset($ganka[0]);
$count12 = 0;
$gankaa=''; 
$_SESSION['ganka'] = $ganka;
foreach ($ganka as $value) {
        if ($count12 == 0) {
            $gankaa .= "'".$value."'";
        } else {
            $gankaa .= ",". "'".$value."'";
        }
        $count12++;
    }
 
    $_SESSION['gankaa'] = $gankaa;

 
    foreach ($ganka as $value) {
        $naika[] = $value;
    }
    
$zibiinkou = array();
$zibiinkou = $_POST['zibiinkou'];
unset($zibiinkou[0]);
$count13 = 0;
$zibiinkoua=''; 
$_SESSION['zibiinkou'] = $zibiinkou;
foreach ($zibiinkou as $value) {
        if ($count13 == 0) {
            $zibiinkoua .= "'".$value."'";
        } else {
            $zibiinkoua .= ",". "'".$value."'";
        }
        $count13++;
    }

    $_SESSION['zibiinkoua'] = $zibiinkoua;

 
    foreach ($zibiinkou as $value) {
        $naika[] = $value;
    }
    
$hifuka = array();
$hifuka = $_POST['hifuka'];
unset($hifuka[0]);
$count14 = 0;
$hifukaa=''; 
$_SESSION['hifuka'] = $hifuka;
foreach ($hifuka as $value) {
        if ($count14 == 0) {
            $hifukaa .= "'".$value."'";
        } else {
            $hifukaa .= ",". "'".$value."'";
        }
        $count14++;
    }

    
    foreach ($hifuka as $value) {
        $naika[] = $value;
    }

    $_SESSION['hifukaa'] = $hifukaa;
    
$sanfuzin = array();
$sanfuzin = $_POST['sanfuzin'];
unset($sanfuzin[0]);
$count15 = 0;
$sanfuzina=''; 
$_SESSION['sanfuzin'] = $sanfuzin;
foreach ($sanfuzin as $value) {
        if ($count15 == 0) {
            $sanfuzina .= "'".$value."'";
        } else {
            $sanfuzina .= ",". "'".$value."'";
        }
        $count15++;
    }

    $_SESSION['sanfuzina'] = $sanfuzina;


    foreach ($sanfuzin as $value) {
        $naika[] = $value;
    }
    
$seisin = array();
$seisin = $_POST['seisin'];
unset($seisin[0]);
$count16 = 0;
$seisina=''; 
$_SESSION['seisin'] = $seisin;
foreach ($seisin as $value) {
        if ($count16 == 0) {
            $seisina .= "'".$value."'";
        } else {
            $seisina .= ",". "'".$value."'";
        }
        $count16++;
    }

    $_SESSION['seisina'] = $seisina;

    foreach ($seisin as $value) {
        $naika[] = $value;
    }
    

$sika = array();
$sika = $_POST['sika'];
unset($sika[0]);
$count17 = 0;
$sikaa=''; 
$_SESSION['sika'] = $sika;
foreach ($sika as $value) {
        if ($count17 == 0) {
            $sikaa .= "'".$value."'";
        } else {
            $sikaa .= ",". "'".$value."'";
        }
        $count17++;
    }
    $_SESSION['sikaa'] = $sikaa;
    
    foreach ($sika as $value) {
        $naika[] = $value;
    }
    

$sonota = array();
$sonota = $_POST['sonota'];
unset($sonota[0]);
$count18 = 0;
$sonotaa=''; 
$_SESSION['sonota'] = $sonota;
foreach ($sonota as $value) {
        if ($count18 == 0) {
            $sonotaa .= "'".$value."'";
        } else {
            $sonotaa .= ",". "'".$value."'";
        }
        $count18++;
    }


    $_SESSION['sonotaa'] = $sonotaa;

    foreach ($sonota as $value) {
        $naika[] = $value;
    }
    

    $_SESSION['naika'] = $naika;
    

$nantou = array();
$nantoua='';
$nantou = $_POST['nantou'];
unset($nantou[0]);
$count2 = 0;
$_SESSION['nantou'] = $nantou;
foreach ($nantou as $value) {
    if ($count2 == 0) {
        $nantoua .= "'".$value."'";
    } else {
        $nantoua .= ",". "'".$value."'";
    }
    $count2++;
}
$_SESSION['nantoua'] = $nantoua;

$nansei = array();
$nansei = $_POST['nansei'];
unset($nansei[0]);
$count3 = 0;
$nanseia='';
$_SESSION['nansei'] = $nansei;
foreach ($nansei as $value) {
    if ($count3 == 0) {
        $nanseia .= "'".$value."'";
    } else {
        $nanseia .= ",". "'".$value."'";
    }
    $count3++;
};
$_SESSION['nanseia'] = $nanseia;

$takahashiniimi = array();
$takahashiniimi = $_POST['takahashiniimi'];
unset($takahashiniimi[0]);
$count4 = 0;
$takahashiniimia='';
$_SESSION['takahashiniimi'] = $takahashiniimi;
foreach ($takahashiniimi as $value) {
    if ($count4 == 0) {
        $takahashiniimia .= "'".$value."'";
    } else {
        $takahashiniimia .= ",". "'".$value."'";
    }
    $count4++;
}
$_SESSION['takahashiniimia'] = $takahashiniimia;


$maniwa = array();
$maniwa = $_POST['maniwa'];
unset($maniwa[0]);
$count5 = 0;
$maniwaa='';
$_SESSION['maniwa'] = $maniwa;
foreach ($maniwa as $value) {
    if ($count5 == 0) {
        $maniwaa .= "'".$value."'";
    } else {
        $maniwaa .= ",". "'".$value."'";
    }
    $count5++;
}


$_SESSION['maniwaa'] = $maniwaa;

$tuyamaaida = array();
$tuyamaaida = $_POST['tuyamaaida'];
unset($tuyamaaida[0]);
$count6 = 0;
$tuyamaaidaa='';
$_SESSION['tuyamaaida'] = $tuyamaaida;
foreach ($tuyamaaida as $value) {
    if ($count6 == 0) {
        $tuyamaaidaa .= "'".$value."'";
    } else {
        $tuyamaaidaa .= ",". "'".$value."'";
    }
    $count6++;
}

$_SESSION['tuyamaaidaa'] = $tuyamaaidaa;

$taken = array();
$taken = $_POST['taken'];
unset($taken[0]);
$count7= 0;
$takena='';
$_SESSION['taken'] = $taken;
foreach ($taken as $value) {
    if ($count7 == 0) {
        $takena .= "'".$value."'";
    } else {
        $takena .= ",". "'".$value."'";
    }
    $count7++;
}
$_SESSION['takena'] = $takena;
$area='';
$zip='';
$area = get_post('area');
$zip= get_post('zip');

$_SESSION['area'] = $area;
$_SESSION['zip'] = $zip;

//医師会

$nantou1 = array();
$nantoua1='';
$nantou1 = $_POST['nantou1'];
unset($nantou1[0]);
$count19 = 0;
$_SESSION['nantou1'] = $nantou1;
foreach ($nantou1 as $value) {
    if ($count19 == 0) {
        $nantoua1 .= "'".$value."'";
    } else {
        $nantoua1 .= ",". "'".$value."'";
    }
    $count19++;
}
$_SESSION['nantoua1'] = $nantoua1;

$nansei1 = array();
$nansei1 = $_POST['nansei1'];
unset($nansei1[0]);
$count20 = 0;
$nanseia1='';
$_SESSION['nansei1'] = $nansei1;
foreach ($nansei1 as $value) {
    if ($count20 == 0) {
        $nanseia1 .= "'".$value."'";
    } else {
        $nanseia1 .= ",". "'".$value."'";
    }
    $count20++;
};
$_SESSION['nanseia1'] = $nanseia1;

$takahashi = array();
$takahashi = $_POST['takahashi'];
unset($takahashi[0]);
$count21 = 0;
$takahashia='';
$_SESSION['takahashi'] = $takahashi;
foreach ($takahashi as $value) {
    if ($count21 == 0) {
        $takahashia .= "'".$value."'";
    } else {
        $takahashia .= ",". "'".$value."'";
    }
    $count21++;
}
$_SESSION['takahashia'] = $takahashia;


$maniwa1 = array();
$maniwa1 = $_POST['maniwa1'];
unset($maniwa1[0]);
$count22 = 0;
$maniwaa1='';
$_SESSION['maniwa1'] = $maniwa1;
foreach ($maniwa1 as $value) {
    if ($count22 == 0) {
        $maniwaa1 .= "'".$value."'";
    } else {
        $maniwaa1 .= ",". "'".$value."'";
    }
    $count22++;
}
$_SESSION['maniwaa1'] = $maniwaa1;

$tuyama = array();
$tuyama = $_POST['tuyama'];
unset($tuyama[0]);
$count23 = 0;
$tuyamaa='';
$_SESSION['tuyama'] = $tuyama;
foreach ($tuyama as $value) {
    if ($count23 == 0) {
        $tuyamaa .= "'".$value."'";
    } else {
        $tuyamaa .= ",". "'".$value."'";
    }
    $count23++;
}
$_SESSION['tuyamaa'] = $tuyamaa;


//大井
$data1= delete_data($dbh);
//櫻間20230616から
//櫻間20221101
$data2= get_result($dbh,$hos_name,$college,$chi,$pre,$entryPlan,$hos_diva,$beda,$conditiona,$nantoua,$nanseia,$takahashiniimia,$maniwaa,$tuyamaaidaa,$takena,$area,$zip,$int_int,$int_dig,$int_uri,$int_tum,$int_ner,$int_res,$int_kid,$int_blo,$int_apo,$int_cir,$int_inf,$ped_ped,$ped_sur,$ped_neo,$sur_sur,$sur_lac,$sur_ner,$sur_nes,$sur_dig,$sur_car,$sur_ven,$ort_rhe,$ort_cos,$ort_ort,$ort_reh,$ort_pla,$oph_oph,$ent_ent,$ent_to ,$so_sky ,$so_org ,$gyn_gyn ,$gyn_obs,$gyn_gyne,$psy_psy,$psy_psyc,$den_den,$den_cav,$den_ref,$den_ped,$alle,$pat,$checkup,$rad,$cli,$ane,$eme,$mon_am,$mon_pm ,$tue_am,$tue_pm,$wed_am,$wed_pm,$thr_am,$thr_pm,$fri_am,$fri_pm,$sat_am,$sat_pm,$sun_am,$sun_pm,$holiday,$nantoua1,$nanseia1,$takahashia,$maniwaa1,$tuyamaa,$year,$introa,$r_introa,$year_intro,$year_r_intro,$yeary,$naika,$bed,$kura,$oka,$okakura,$intro_flag,$r_intro_flag,$intro,$r_intro);

$data= get_data($dbh,$introa,$r_introa,$year_intro,$year_r_intro,$yeary,$intro_flag,$r_intro_flag,$intro,$r_intro,$kura,$oka,$okakura,$year);
//櫻間20230616まで
//大井

$_SESSION['pagedata'] = $data;
}

$hos_name = $_SESSION['hos_name'];

$college = $_SESSION['college'];

if(isset($_SESSION['pre'])){
$pre = $_SESSION['pre'];
}
if(isset($_SESSION['chi'])){
$chi = $_SESSION['chi'];
}
$hos_div = $_SESSION['hos_div'];
$hos_diva = $_SESSION['hos_diva'];
$bed=$_SESSION['bed'];
$beda=$_SESSION['beda'];
$condition = $_SESSION['condition'];
$conditiona = $_SESSION['conditiona'];
$year = $_SESSION['year'];
$intro = $_SESSION['intro'];
$r_intro = $_SESSION['r_intro'];
//櫻間20230616から
$kura = $_SESSION['kura'];
$oka = $_SESSION['oka']; 
$okakura = $_SESSION['okakura'];
if(isset($_SESSION['intro_flag'])){
    $intro_flag = $_SESSION['intro_flag'];
}else{
    $intro_flag = '';
}
if(isset($_SESSION['r_intro_flag'])){
$r_intro_flag = $_SESSION['r_intro_flag'];
}else{
    $r_intro_flag = '';
}
//櫻間20230616まで
$introa = $_SESSION['introa'];
$r_introa = $_SESSION['r_introa'];

$week = $_SESSION['week'];
$weeka = $_SESSION['weeka'];
$nantoua = $_SESSION['nantoua'];
$nanseia = $_SESSION['nanseia'];
$takahashiniimia = $_SESSION['takahashiniimia'];
$maniwaa = $_SESSION['maniwaa'];
$tuyamaaidaa = $_SESSION['tuyamaaidaa'];
$takena = $_SESSION['takena'];
$area = $_SESSION['area'];
$zip = $_SESSION['zip'];
$naikaa = $_SESSION['naikaa'];
$syounikaa = $_SESSION['syounikaa'];
$gekaa = $_SESSION['gekaa'];
$seikeia = $_SESSION['seikeia'];
$gankaa = $_SESSION['gankaa'];
$zibiinkoua = $_SESSION['zibiinkoua'];
$hifukaa = $_SESSION['hifukaa'];
$sanfuzina = $_SESSION['sanfuzina'];
$seisina = $_SESSION['seisina'];
$sikaa = $_SESSION['sikaa'];
$sonotaa = $_SESSION['sonotaa'];
$a=$_SESSION['a'];
$nantoua1= $_SESSION['nantoua1'];
$nanseia1= $_SESSION['nanseia1'];
$takahashia= $_SESSION['takahashia'];
$maniwaa1= $_SESSION['maniwaa1'];
$tuyamaa= $_SESSION['tuyamaa'];
$entryPlan = $_SESSION['entryPlan'];

$year_intro = $_SESSION['year_intro'];
$year_r_intro = $_SESSION['year_r_intro'];
$yeary = $_SESSION['yeary'];

$naika = $_SESSION['naika'];

$data = $_SESSION['pagedata'];
//値に応じて表示する数を変える　大井
if(isset($_POST['display'])){
    $display = $_POST['display'];
    $_SESSION['display'] = $display;
    $books_num = $_SESSION['books_num'];
}
$display = $_SESSION['display'];
//櫻間20230616から
if($user_adm  === '1'){
    $all=$_SESSION['all'];
    }
//櫻間20230616まで
//大井
//ビューview.phpの読み出し

if (isset($_POST['detail'])){

    $mon_am = '';
    $mon_pm  = '';
    $tue_am = '';
    $tue_pm = '';
    $wed_am = '';
    $wed_pm = '';
    $thr_am = '';
    $thr_pm = '';
    $fri_am = '';
    $fri_pm = '';
    $sat_am = '';
    $sat_pm = '';
    $sun_am = '';
    $sun_pm = '';
    $holiday = '';

    if(isset($week)){
        foreach ($week as $value):
            if ($value === '月am') {
                $mon_am = '●';
            }elseif($value === '月pm') {
                $mon_pm = '●';
            }elseif($value === '火am') {
                $tue_am = '●';
            }elseif($value === '火pm') {
                $tue_pm = '●';
            }elseif($value === '水am') {
                $wed_am = '●';
            }elseif($value === '水pm') {
                $wed_pm = '●';
            }elseif($value === '木am') {
                $thr_am = '●';
            }elseif($value === '木pm') {
                $thr_pm = '●';
            }elseif($value === '金am') {
                $fri_am = '●';
            }elseif($value === '金pm') {
                $fri_pm = '●';
            }elseif($value === '土am') {
                $sat_am = '●';
            }elseif($value === '土pm') {
                $sat_pm = '●';
            }elseif($value === '日am') {
                $sun_am = '●';
            }elseif($value === '日pm') {
                $sun_pm = '●';
            }elseif($value === '祝日') {
                $holiday= '●';
            }
        
        endforeach;
    }
    

//大井
$data1= delete_data($dbh);
//櫻間20230616から
//櫻間20221101
$data2= get_result($dbh,$hos_name,$college,$chi,$pre,$entryPlan,$hos_diva,$beda,$conditiona,$nantoua,$nanseia,$takahashiniimia,$maniwaa,$tuyamaaidaa,$takena,$area,$zip,$int_int,$int_dig,$int_uri,$int_tum,$int_ner,$int_res,$int_kid,$int_blo,$int_apo,$int_cir,$int_inf,$ped_ped,$ped_sur,$ped_neo,$sur_sur,$sur_lac,$sur_ner,$sur_nes,$sur_dig,$sur_car,$sur_ven,$ort_rhe,$ort_cos,$ort_ort,$ort_reh,$ort_pla,$oph_oph,$ent_ent,$ent_to ,$so_sky ,$so_org ,$gyn_gyn ,$gyn_obs,$gyn_gyne,$psy_psy,$psy_psyc,$den_den,$den_cav,$den_ref,$den_ped,$alle,$pat,$checkup,$rad,$cli,$ane,$eme,$mon_am,$mon_pm ,$tue_am,$tue_pm,$wed_am,$wed_pm,$thr_am,$thr_pm,$fri_am,$fri_pm,$sat_am,$sat_pm,$sun_am,$sun_pm,$holiday,$nantoua1,$nanseia1,$takahashia,$maniwaa1,$tuyamaa,$year,$introa,$r_introa,$year_intro,$year_r_intro,$yeary,$naika,$bed,$kura,$oka,$okakura,$intro_flag,$r_intro_flag,$intro,$r_intro);

$data= get_data($dbh,$introa,$r_introa,$year_intro,$year_r_intro,$yeary,$intro_flag,$r_intro_flag,$intro,$r_intro,$kura,$oka,$okakura,$year);

}

//櫻間20230616まで 
//櫻間
if(isset($err1)||isset($err2)||isset($err3)){
    include_once('checkbox_control.php');
}else{
    if($user_adm  === '1'){
        include_once('result_view.php');
    }elseif($user_adm  === '2'){
        include_once('result_view.php');
    }else{
        include_once('user_result_view.php');
    
    }
}



