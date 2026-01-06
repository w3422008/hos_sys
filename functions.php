<?php

/* ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE); */

require_once('config.php');

//出力前に特殊文字を変換する
function html_escape($word){
	return htmlspecialchars($word, ENT_QUOTES, 'UTF-8');
}

//POSTデータを取得する
function get_post($key){
    if(isset($_POST[$key])){
        $var = strval($_POST[$key]);
        return $var;
    }
}

//データベースに接続する
function get_db_connect() {
	try{
		$dsn =  DSN;
		$user = DB_USER;
		$password = DB_PASSWORD;
	
		$dbh = new PDO($dsn, $user, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $dbh;
	}catch (PDOException $e){
		   echo($e->getMessage());
		   die();
	}
}

// 権限ごとに背景色を指定（header、ユーザ管理）
function get_adm_label($rights){
    if($rights === '1'){
        return '<label class="uk-label uk-label-danger">管理者</label>';
    }elseif($rights === '0'){
        return '<label class="uk-label uk-label-success">一般</label>';
    }elseif($rights === '2'){
        return '<label class="uk-label uk-label-primary">一般（事務）</label>';
    }elseif($rights === '3'){
        return '<label class="uk-label SysAdmin">システム管理者</label>';
    }
}

// 権限ごとにテキストを指定
function get_adm_txt($adm){
    if($adm === '1'){
        return '管理者';
    }elseif($adm === '0'){
        return '一般';
    }elseif($adm === '2'){
        return '一般（事務）';
    }elseif($adm === '3'){
        return 'システム管理者';
    }
}

//search
//検索画面チェックボックス表示
//診療科目
function get_Internal_medicine($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=1 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};


function get_pediatrics($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=2";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;
};


function get_surgery($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=3 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;
};


function get_orthopedics($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=4 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;
};


function get_ophthalmology($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=5 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;
};

function get_otolaryngology($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=6 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;
};

function get_dermatology_urology($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=7 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;
};


function get_gynecology($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=8 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;
};



function get_psychiatry($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=9 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;
};

function get_dentistry($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=10 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;
};


function get_etcetera($dbh){
    $sql="SELECT dep_name, dep_cd FROM department WHERE sec_cd=11 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;
};

// 地域

function get_southeast($dbh){
    $sql="SELECT area1 FROM area WHERE are_cd=1 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};


function get_southwest($dbh){
    $sql="SELECT area1 FROM area WHERE are_cd=2 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};



function get_takahashi_niimi($dbh){
    $sql="SELECT area1 FROM area WHERE are_cd=3 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};



function get_maniwa($dbh){
    $sql="SELECT area1 FROM area WHERE are_cd=4 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};



function get_tuyama_aida($dbh){
    $sql="SELECT area1 FROM area WHERE are_cd=5 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};



function get_taken($dbh){
    $sql="SELECT area1 FROM area WHERE are_cd=6 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};

// 医師会


function get_d_southeast($dbh){
    $sql="SELECT med_ass FROM med_ass WHERE are_cd=1 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};



function get_d_southwest($dbh){
    $sql="SELECT med_ass FROM med_ass WHERE are_cd=2 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};


function get_d_takahashi_niimi($dbh){
    $sql="SELECT med_ass FROM med_ass WHERE are_cd=3 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};



function get_d_maniwa($dbh){
    $sql="SELECT med_ass FROM med_ass WHERE are_cd=4 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};


function get_d_tuyama_aida($dbh){
    $sql="SELECT med_ass FROM med_ass WHERE are_cd=5 ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

};

//大井
function delete_data($dbh){
    $sql="delete from tmp1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

};



//検索
//櫻間
function get_result($dbh,$hos_name,$college,$chi,$pre,$entryPlan,$hos_diva,$beda,$conditiona,$nantoua,$nanseia,$takahashiniimia,$maniwaa,$tuyamaaidaa,$takena,$area,$zip,$int_int,$int_dig,$int_uri,$int_tum,$int_ner,$int_res,$int_kid,$int_blo,$int_apo,$int_cir,$int_inf,$ped_ped,$ped_sur,$ped_neo,$sur_sur,$sur_lac,$sur_ner,$sur_nes,$sur_dig,$sur_car,$sur_ven,$ort_rhe,$ort_cos,$ort_ort,$ort_reh,$ort_pla,$oph_oph,$ent_ent,$ent_to,$so_sky,$so_org,$gyn_gyn,$gyn_obs,$gyn_gyne,$psy_psy,$psy_psyc,$den_den,$den_cav,$den_ref,$den_ped,$alle,$pat,$checkup,$rad,$cli,$ane,$eme,$mon_am,$mon_pm ,$tue_am,$tue_pm,$wed_am,$wed_pm,$thr_am,$thr_pm,$fri_am,$fri_pm,$sat_am,$sat_pm,$sun_am,$sun_pm,$holiday,$nantoua1,$nanseia1,$takahashia,$maniwaa1,$tuyamaa,$year,$introa,$r_introa,$year_intro,$year_r_intro,$yeary,$naika,$bed,$kura,$oka,$okakura,$intro_flag,$r_intro_flag,$intro,$r_intro){

    $sql="INSERT INTO tmp1
    select * from ( 
        SELECT *
        ,(case when (select year from intro where main.hos_cd=intro.hos_cd
        " ;
 
 //櫻間20230616ここから
     //紹介
     if($intro_flag === '1') $sql .= " AND (" ;
     if($year !== '') $sql .= " intro.year = :year" ;
     if($year !== '' && ($intro ==='1' || $oka==='1' || $kura==='1'|| $okakura==='1')){ $sql .= " AND" ;}
     if($intro ==='1') $sql .= " intr >= 1" ;
     if($intro ==='1' && ( $oka==='1' || $kura==='1' || $okakura==='1')) $sql .= " AND" ;
     if($oka ==='1') $sql .= " ins = '1'" ;
     if($kura ==='1') $sql .= " ins = '0'" ;
     if($okakura ==='1') $sql .= " (ins = '1' OR ins='0')" ;
     if($intro_flag === '1') $sql .= " )" ; 
  
         $sql .= " limit 1)>1 then 1 else 0 end) as intr
         ,(case when (select year from invers_intro where main.hos_cd=invers_intro.hos_cd" ;
 
         if($r_intro_flag === '1') $sql .= " AND (" ;
         if($year !== '') $sql .= " invers_intro.year = :year" ;
         if($year !== '' && ($r_intro ==='1' || $oka==='1' || $kura==='1'|| $okakura==='1')){ $sql .= " AND" ;}
         if($r_intro ==='1') $sql .= " invr_intr >= 1" ;
         if($r_intro ==='1' && ( $oka==='1' || $kura==='1' || $okakura==='1')) $sql .= " AND" ;
         if($oka ==='1') $sql .= " ins = '1'" ;
         if($kura ==='1') $sql .= " ins = '0'" ;
         if($okakura ==='1') $sql .= " (ins = '1' OR ins='0')" ;
         if($r_intro_flag=== '1') $sql .= " )" ;
         $sql .= " limit 1)>1 then 1 else 0 end) as invr_intr 
         FROM main 
         WHERE 1=1 
     " ;
  
     if($hos_name) $sql .= " AND hos_name LIKE :hos_name " ;
     if($college !== '' && $entryPlan === 'hoge3') $sql .= " AND chi_sch LIKE :college AND pre_sch LIKE :college" ;
     if($chi !== '' && $entryPlan === 'hoge1') $sql .= " AND chi_sch LIKE :chi" ;
     if($pre !== '' && $entryPlan === 'hoge2') $sql .= " AND pre_sch LIKE :pre" ;
     if($hos_diva) $sql .= " AND hos_div IN (".$hos_diva.")" ;
 
 
 
     if(!empty($bed)){
         if ($bed['1'] === '一般') {
             $sql .=  " AND  ( bed_main = '1'" ;
         }elseif($bed['1'] === '療養') {
             $sql .=  " AND (  bed_tre = '1'" ;
         }elseif($bed['1'] === '回復期リハ') {
             $sql .=  " AND  ( bed_reh = '1'" ;
         }elseif($bed['1'] === '地域包括ケア') {
             $sql .=  " AND (  bed_care = '1'" ;
         }elseif($bed['1'] === '障害者') {
             $sql .=  " AND (  bed_tra = '1'" ;
         }elseif($bed['1'] === '緩和ケア') {
             $sql .=  " AND (  bed_att = '1'" ;
         }
 
     unset($bed['1']);
 
         if(isset($bed)){
             foreach($bed as $var):
                 if ($var === '一般') {
                     $sql .=  " OR bed_main = '1'" ;
                 }elseif($var === '療養') {
                     $sql .=  " OR bed_tre = '1'" ;
                 }elseif($var === '回復期リハ') {
                     $sql .=  " OR bed_reh = '1'" ;
                 }elseif($var === '地域包括ケア') {
                     $sql .=  " OR bed_care = '1'" ;
                 }elseif($var === '障害者') {
                     $sql .=  " OR bed_tra = '1'" ;
                 }elseif($var === '緩和ケア') {
                     $sql .=  " OR bed_att = '1'" ;
                 }
             endforeach;  
 
         }
         if(isset($bed)){
             $sql .=  " ) " ;
 
         }
     }

     if($conditiona) $sql .= " AND op_flg IN (".$conditiona.")" ;
//櫻間20230616まで    
 

if($nantoua) $sql .= " AND ( area IN (".$nantoua.")" ;

    if($nantoua !== ''){
        if($nanseia) $sql .= " OR area IN (".$nanseia.")" ;
    }else{
        if($nanseia) $sql .= " AND ( area IN (".$nanseia.")" ;
    }

    if($nantoua !== '' || $nanseia !== ''){
        if($takahashiniimia) $sql .= " OR area IN (".$takahashiniimia.")" ;
    }else{
        if($takahashiniimia) $sql .= " AND ( area IN (".$takahashiniimia.")" ;
    }

    if($nantoua !== '' || $nanseia !== ''||$takahashiniimia !==''){
        if($maniwaa) $sql .= " OR area IN (".$maniwaa.")" ;
    }else{
        if($maniwaa) $sql .= " AND ( area IN (".$maniwaa.")" ;
    }

    if($nantoua !== '' || $nanseia !== ''||$takahashiniimia !==''||$maniwaa !==''){
        if($tuyamaaidaa) $sql .= " OR area IN (".$tuyamaaidaa.")" ;
    }else{
        if($tuyamaaidaa) $sql .= " AND ( area IN (".$tuyamaaidaa.")" ;
    }

    if($nantoua !== '' || $nanseia !== ''||$takahashiniimia !==''||$maniwaa !==''||$tuyamaaidaa !==''){
        if($takena) $sql .= " OR pre IN (".$takena.")" ;
    }else{
        if($takena) $sql .= " AND ( pre IN (".$takena.")" ;
    }

    if($nantoua !== '' || $nanseia !== ''||$takahashiniimia !==''||$maniwaa !==''||$tuyamaaidaa !==''||$takena !== ''){
        $sql .= " )" ;
    }

    if($area) $sql .= " AND ad LIKE :area " ;
    if($zip) $sql .= " AND zipcode LIKE :zip";
    if(!empty($naika)){


         if ($naika['1'] === '内科') {
            $sql .=  " AND ( int_int = '1'" ;
        }elseif($naika['1'] === '呼吸器内科') {
            $sql .=  " AND ( int_res = '1'" ;
        }elseif($naika['1'] === '循環器内科') {
            $sql .=  " AND ( int_cir = '1'" ;
        }elseif($naika['1'] === '消化器内科') {
            $sql .=  " AND ( int_dig = '1'" ;
        }elseif($naika['1'] === '腎臓内科') {
            $sql .=  " AND ( int_kid = '1'" ;
        }elseif($naika['1'] === '神経内科') {
            $sql .=  " AND ( int_ner = '1'" ;
        }elseif($naika['1'] === '糖尿病内科(代謝内科)') {
            $sql .=  " AND ( int_uri = '1'" ;
        }elseif($naika['1'] === '血液内科') {
            $sql .=  " AND ( int_blo = '1'" ;
        }elseif($naika['1'] === '感染症内科') {
            $sql .=  " AND ( int_inf = '1'" ;
        }elseif($naika['1'] === '臨床腫瘍科') {
            $sql .=  " AND ( int_tum = '1'" ;
        }elseif($naika['1'] === '脳卒中科') {
            $sql .=  " AND ( int_apo = '1'" ;
        }elseif ($naika['1'] === '小児科') {                  
            $sql .=  " AND ( ped_ped = '1'";
        }elseif($naika['1'] === '小児外科') {                  
            $sql .=  " AND ( ped_sur = '1'";
        }elseif($naika['1'] === '新生児科') {                 
            $sql .=  " AND ( ped_neo = '1'";
        }elseif($naika['1'] === '外科'){
            $sql .= "AND ( sur_sur = '1'";
            
        }elseif($naika['1'] === '呼吸器外科'){
            $sql .= "AND ( sur_nes = '1'";
            
        }elseif($naika['1'] === '循環器外科（心臓・血管外科)'){
            $sql .= "AND ( sur_car = '1'";
            
        }elseif($naika['1'] === '乳腺外科'){
            $sql .= "AND ( sur_lac = '1'";
            
        }elseif($naika['1'] === '消化器外科'){
            $sql .= "AND ( sur_dig = '1'";
            
        }elseif($naika['1'] === '肛門外科'){
            $sql .= "AND ( sur_ven = '1'";
            
        }elseif($naika['1'] === '脳神経外科'){
            $sql .= "AND ( sur_ner = '1'";
            
        }elseif($naika['1'] === 'リウマチ科'){
            $sql .= "AND ( ort_rhe = '1'";
            
        }elseif($naika['1'] === '整形外科'){
            $sql .= "AND ( ort_ort = '1'";
            
        }elseif($naika['1'] === '形成外科'){
            $sql .= "AND ( ort_pla = '1'";
            
        }elseif($naika['1'] === '美容外科'){
            $sql .= "AND ( ort_cos = '1'";
            
        }elseif($naika['1'] === 'リハビリテーション科'){
            $sql .= "AND ( ort_reh = '1'";
            
        }elseif($naika['1'] === '眼科'){
            $sql .= "AND ( oph_oph = '1'";
            
        }elseif($naika['1'] === '耳鼻いんこう科'){
            $sql .= "AND ( ent_ent = '1'";
            
        }elseif($naika['1'] === '気管食道科'){
            $sql .= "AND ( ent_to = '1'";
            
        }elseif($naika['1'] === '皮膚科'){
            $sql .= "AND ( so_sky = '1'";
            
        }elseif($naika['1'] === '泌尿器科'){
            $sql .= "AND ( so_org = '1'";
            
        }elseif($naika['1'] === '産婦人科'){
            $sql .= "AND ( gyn_gyn = '1'";
            
        }elseif($naika['1'] === '産科'){
            $sql .= "AND ( gyn_obs = '1'";
            
        }elseif($naika['1'] === '婦人科'){
            $sql .= "AND ( gyn_gyne = '1'";
            
        }elseif($naika['1'] === '精神科'){
            $sql .= "AND ( psy_psy = '1'";
            
        }elseif($naika['1'] === '心療内科'){
            $sql .= "AND ( psy_psyc = '1'";
            
        }elseif($naika['1'] === '歯科'){
            $sql .= "AND ( den_den = '1'";
            
        }elseif($naika['1'] === '矯正歯科'){
            $sql .= "AND ( den_ref = '1'";
            
        }elseif($naika['1'] === '小児歯科'){
            $sql .= "AND ( den_ped = '1'";
            
        }elseif($naika['1'] === '歯科口腔外科'){
            $sql .= "AND ( dent_cav = '1'";
            
        }elseif($naika['1'] === 'アレルギー科'){
            $sql .= "AND ( alle = '1'";
            
        }elseif($naika['1'] === '放射線科'){
            $sql .= "AND ( rad = '1'";
            
        }elseif($naika['1'] === '麻酔科'){
            $sql .= "AND ( ane = '1'";
            
        }elseif($naika['1'] === '病理診断科'){
            $sql .= "AND ( pat = '1'";
            
        }elseif($naika['1'] === '臨床検査科'){
            $sql .= "AND ( cli = '1'";
            
        }elseif($naika['1'] === '救急科'){
            $sql .= "AND ( eme = '1'";
            
        }elseif($naika['1'] === '健康診断'){
            $sql .= "AND ( checkup = '1'";
        }
        

        if(isset($naika)){
            foreach($naika as $var):
                if ($var === '内科') {
                    $sql .=  " OR int_int = '1'" ;
                }elseif($var === '呼吸器内科') {
                    $sql .=  " OR int_res = '1'" ;
                }elseif($var === '循環器内科') {
                    $sql .=  " OR int_cir = '1'" ;
                }elseif($var === '消化器内科') {
                    $sql .=  " OR int_dig = '1'" ;
                }elseif($var === '腎臓内科') {
                    $sql .=  " OR int_kid = '1'" ;
                }elseif($var === '神経内科') {
                    $sql .=  " OR int_ner = '1'" ;
                }elseif($var === '糖尿病内科(代謝内科)') {
                    $sql .=  " OR int_uri = '1'" ;
                }elseif($var === '血液内科') {
                    $sql .=  " OR int_blo = '1'" ;
                }elseif($var === '感染症内科') {
                    $sql .=  " OR int_inf = '1'" ;
                }elseif($var === '臨床腫瘍科') {
                    $sql .=  " OR int_tum = '1'" ;
                }elseif($var === '脳卒中科') {
                    $sql .=  " OR int_apo = '1'" ;
                }elseif($var === '小児科'){
                    $sql .= " OR ped_ped = '1'";
                    
                    }elseif($var === '小児外科'){
                    $sql .= " OR ped_sur = '1'";
                    
                    }elseif($var === '新生児科'){
                    $sql .= " OR ped_neo = '1'";
                    
                    }elseif($var === '外科'){
                    $sql .= " OR sur_sur = '1'";
                    
                    }elseif($var === '呼吸器外科'){
                    $sql .= " OR sur_nes = '1'";
                    
                    }elseif($var === '循環器外科（心臓・血管外科)'){
                    $sql .= " OR sur_car = '1'";
                    
                    }elseif($var === '乳腺外科'){
                    $sql .= " OR sur_lac = '1'";
                    
                    }elseif($var === '消化器外科'){
                    $sql .= " OR sur_dig = '1'";
                    
                    }elseif($var === '肛門外科'){
                    $sql .= " OR sur_ven = '1'";
                    
                    }elseif($var === '脳神経外科'){
                    $sql .= " OR sur_ner = '1'";
                    
                    }elseif($var === 'リウマチ科'){
                    $sql .= " OR ort_rhe = '1'";
                    
                    }elseif($var === '整形外科'){
                    $sql .= " OR ort_ort = '1'";
                    
                    }elseif($var === '形成外科'){
                    $sql .= " OR ort_pla = '1'";
                    
                    }elseif($var === '美容外科'){
                    $sql .= " OR ort_cos = '1'";
                    
                    }elseif($var === 'リハビリテーション科'){
                    $sql .= " OR ort_reh = '1'";
                    
                    }elseif($var === '眼科'){
                    $sql .= " OR oph_oph = '1'";
                    
                    }elseif($var === '耳鼻いんこう科'){
                    $sql .= " OR ent_ent = '1'";
                    
                    }elseif($var === '気管食道科'){
                    $sql .= " OR ent_to = '1'";
                    
                    }elseif($var === '皮膚科'){
                    $sql .= " OR so_sky ='1'";
                    
                    }elseif($var === '泌尿器科'){
                    $sql .= " OR so_org = '1'";
                    
                    }elseif($var === '産婦人科'){
                    $sql .= " OR gyn_gyn = '1'";
                    
                    }elseif($var === '産科'){
                    $sql .= " OR gyn_obs = '1'";
                    
                    }elseif($var === '婦人科'){
                    $sql .= " OR gyn_gyne = '1'";
                    
                    }elseif($var === '精神科'){
                    $sql .= " OR psy_psy = '1'";
                    
                    }elseif($var === '心療内科'){
                    $sql .= " OR psy_psyc ='1'";
                    
                    }elseif($var === '歯科'){
                    $sql .= " OR den_den = '1'";
                    
                    }elseif($var === '矯正歯科'){
                    $sql .= " OR den_ref ='1'";
                    
                    }elseif($var === '小児歯科'){
                    $sql .= " OR den_ped ='1'";
                    
                    }elseif($var === '歯科口腔外科'){
                    $sql .= " OR den_cav ='1'";
                    
                    }elseif($var === 'アレルギー科'){
                    $sql .= " OR alle = '1'";
                    
                    }elseif($var === '放射線科'){
                    $sql .= " OR rad = '1'";
                    
                    }elseif($var === '麻酔科'){
                    $sql .= " OR ane = '1'";
                    
                    }elseif($var === '病理診断科'){
                    $sql .= " OR pat = '1'";
                    
                    }elseif($var === '救急科'){
                    $sql .= " OR eme = '1'";
                    
                    }elseif($var === '健康診断'){
                    $sql .= " OR checkup = '1'";
                    }


                
            endforeach;  

        }


    if ($naika['1'] === '内科') {
        $sql .=  ")" ;
    }elseif($naika['1'] === '呼吸器内科') {
        $sql .=  ")" ;
    }elseif($naika['1'] === '循環器内科') {
        $sql .=  ")" ;
    }elseif($naika['1'] === '消化器内科') {
        $sql .=  ")" ;
    }elseif($naika['1'] === '腎臓内科') {
        $sql .=  ")" ;
    }elseif($naika['1'] === '神経内科') {
        $sql .=  ")" ;
    }elseif($naika['1'] === '糖尿病内科(代謝内科)') {
        $sql .=  ")" ;
    }elseif($naika['1'] === '血液内科') {
        $sql .=  ")" ;
    }elseif($naika['1'] === '感染症内科') {
        $sql .=  ")" ;
    }elseif($naika['1'] === '臨床腫瘍科') {
        $sql .=  ")" ;
    }elseif($naika['1'] === '脳卒中科') {
        $sql .=  ")" ;
    }elseif ($naika['1'] === '小児科') {                  
        $sql .=  ")";
    }elseif($naika['1'] === '小児外科') {                  
        $sql .=  ")";
    }elseif($naika['1'] === '新生児科') {                 
        $sql .=  ")";
    }elseif($naika['1'] === '外科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '呼吸器外科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '循環器外科（心臓・血管外科)'){
        $sql .= ")";
        
    }elseif($naika['1'] === '乳腺外科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '消化器外科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '肛門外科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '脳神経外科'){
        $sql .= ")";
        
    }elseif($naika['1'] === 'リウマチ科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '整形外科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '形成外科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '美容外科'){
        $sql .= ")";
        
    }elseif($naika['1'] === 'リハビリテーション科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '眼科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '耳鼻いんこう科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '気管食道科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '皮膚科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '泌尿器科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '産婦人科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '産科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '婦人科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '精神科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '心療内科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '歯科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '矯正歯科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '小児歯科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '歯科口腔外科'){
        $sql .= ")";
        
    }elseif($naika['1'] === 'アレルギー科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '放射線科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '麻酔科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '病理診断科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '臨床検査科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '救急科'){
        $sql .= ")";
        
    }elseif($naika['1'] === '健康診断'){
        $sql .= ")";
    }
    unset($naika['1']);
    }

    if($mon_am === '●') $sql .=  " AND mon_am = '●'" ;
    if($mon_pm === '●') $sql .=  " AND mon_pm = '●'" ;
    if($tue_am === '●') $sql .=  " AND tue_am = '●'" ;
    if($tue_pm === '●') $sql .=  " AND tue_pm = '●'" ;
    if($wed_am === '●') $sql .=  " AND wed_am = '●'" ;
    if($wed_pm === '●') $sql .=  " AND wed_pm = '●'" ;
    if($thr_am === '●') $sql .=  " AND thr_am = '●'" ;
    if($thr_pm === '●') $sql .=  " AND thr_pm = '●'" ;
    if($fri_am === '●') $sql .=  " AND fri_am = '●'" ;
    if($fri_pm === '●') $sql .=  " AND fri_pm = '●'" ;
    if($sat_am === '●') $sql .=  " AND sat_am = '●'" ;
    if($sat_pm === '●') $sql .=  " AND sat_pm = '●'" ;
    if($sun_am === '●') $sql .=  " AND sun_am = '●'" ;
    if($sun_pm === '●') $sql .=  " AND sun_pm = '●'" ;
    if($holiday === '●') $sql .=  " AND holiday = '●'" ;



    if($nantoua1) $sql .= " AND ( med_ass IN (".$nantoua1.")" ;

    if($nantoua1 !== ''){
        if($nanseia1) $sql .= " OR med_ass IN (".$nanseia1.")" ;
    }else{
        if($nanseia1) $sql .= " AND ( med_ass IN (".$nanseia1.")" ;
    }

    if($nantoua1 !== '' || $nanseia1 !== ''){
        if($takahashia) $sql .= " OR med_ass IN (".$takahashia.")" ;
    }else{
        if($takahashia) $sql .= " AND ( med_ass IN (".$takahashia.")" ;
    }

    if($nantoua1 !== '' || $nanseia1 !== ''||$takahashia !==''){
        if($maniwaa1) $sql .= " OR med_ass IN (".$maniwaa1.")" ;
    }else{
        if($maniwaa1) $sql .= " AND ( med_ass IN (".$maniwaa1.")" ;
    }

    if($nantoua1 !== '' || $nanseia1 !== ''||$takahashia !==''||$maniwaa1 !==''){
        if($tuyamaa) $sql .= " OR med_ass IN (".$tuyamaa.")" ;
    }else{
        if($tuyamaa) $sql .= " AND ( med_ass IN (".$tuyamaa.")" ;
    }

    if($nantoua1 !== '' || $nanseia1 !== ''||$takahashia !==''||$maniwaa1 !==''||$tuyamaa !==''){
          $sql .= " )" ;
    }

    $sql .=" AND onf =0 " ;
 
    $sql .= " ) as TBL " ;
 //echo $sql;
     $stmt = $dbh->prepare($sql);
     
     if($hos_name) $stmt -> bindValue(':hos_name', '%'.$hos_name.'%', PDO::PARAM_STR);


     if($college) $stmt -> bindValue(':college', '%'.$college.'%', PDO::PARAM_STR);
     if($chi) $stmt -> bindValue(':chi', '%'.$chi.'%', PDO::PARAM_STR);
     if($pre) $stmt -> bindValue(':pre', '%'.$pre.'%', PDO::PARAM_STR);
     if($area) $stmt -> bindValue(':area', '%'.$area.'%', PDO::PARAM_STR);
     if($zip) $stmt -> bindValue(':zip', $zip.'%', PDO::PARAM_STR);
     if($year) $stmt -> bindValue(':year',$year, PDO::PARAM_INT);


    $stmt->execute(); 


 }
 
 
 function get_data($dbh,$introa,$r_introa,$year_intro,$year_r_intro,$yeary,$intro_flag,$r_intro_flag,$intro,$r_intro,$kura,$oka,$okakura,$year){
    $sql="select * from tmp1 WHERE 1=1 ";
    if($intro === '1' && $r_intro === '') {
       $sql .= " AND intr >= 1" ;
    }elseif($intro === '' && $r_intro === '1'){
       $sql .= " AND invr_intr >= 1" ;
    }elseif($intro === '1' && $r_intro === '1'){
       $sql .= " AND intr >= 1 OR invr_intr >= 1" ;
    }elseif($intro === '' && $r_intro === '' && $kura === '1'){
        $sql .= "AND intr > 0 OR invr_intr > 0" ;
    }elseif($intro === '' && $r_intro === '' && $oka === '1'){
        $sql .= "AND intr > 0 OR invr_intr > 0" ;
    }elseif($intro === '' && $r_intro === '' && $okakura === '1'){
        $sql .= "AND intr > 0 OR invr_intr > 0" ;
    }elseif($intro === '' && $r_intro === '' && $year !== ''){
        $sql .= "AND intr > 0 OR invr_intr > 0" ;
    }

//echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
     $count30 = $stmt->rowCount();

    $data = array();
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         $data[] = $row;
     }
 
 return $data;
 
 };
 //櫻間20230616まで
 //大井


//detail
//詳細表示
function detail($dbh,$hos_cd){

    $sql="SELECT * FROM main WHERE hos_cd=:hos_cd";

    $stmt = $dbh->prepare($sql);
    
    if($hos_cd) $stmt -> bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->execute(); 

    $data = array();
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         $data[] = $row;
     }
 
 return $data;
 }
 

/*20221105 高橋function変更しました （ここから）*/

//詳細 病院長・理事長情報
function detail_director($dbh,$hos_cd){
    $sql="SELECT hos_cd, hos_name, chi_name, chi_spe, chi_year, chi_sch, chi_note, pre_name, pre_spe, pre_year, pre_sch, pre_note FROM main WHERE hos_cd=:hos_cd";
    $stmt = $dbh->prepare($sql);
    $stmt -> bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->execute(); 
    $data = array();
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         $data[] = $row;
     }
return $data;
}

//親族情報 表示

function detail_relative($dbh,$hos_cd){
    $sql="SELECT `hos_cd`, `name`, `conn`, `sch_name`, `ent_year`, `gra_year`, `note`, `rel_cd` FROM `relative` WHERE `hos_cd`=:hos_cd and delete_flg = 0 " ;
    $stmt = $dbh->prepare($sql);
    $stmt -> bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->execute(); 
    $data = array();
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         $data[] = $row;
     }
return $data;
}

//部門連絡先 表示
function detail_num($dbh,$hos_cd){
    $sql="SELECT * FROM `field_junction` WHERE `hos_cd` = :hos_cd and delete_flg = 0";
    $stmt = $dbh->prepare($sql);
    if($hos_cd) $stmt -> bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->execute(); 

    $data = array();
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         $data[] = $row;
     }
return $data;
}
 //外来
 function gairai($dbh,$hos_cd){

    $sql="SELECT * FROM `field_junction` WHERE `hos_cd` = :hos_cd AND `fie_div` = '外来'";

    $stmt = $dbh->prepare($sql);
    
    if($hos_cd) $stmt -> bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->execute(); 

    $data = array();
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         $data[] = $row;
     }
 
 return $data;
 }
 //連携
 function renkei($dbh,$hos_cd){

    $sql="SELECT * FROM `field_junction` WHERE `hos_cd` = :hos_cd AND `fie_div` = '連携'";

    $stmt = $dbh->prepare($sql);
    
    if($hos_cd) $stmt -> bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->execute(); 

    $data = array();
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         $data[] = $row;
     }
 
 return $data;
 }
 //その他
 function sonota($dbh,$hos_cd){

    $sql="SELECT * FROM `field_junction` WHERE `hos_cd` = :hos_cd AND `fie_div` = 'その他'";

    $stmt = $dbh->prepare($sql);
    
    if($hos_cd) $stmt -> bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->execute(); 

    $data = array();
     while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
         $data[] = $row;
     }
 
 return $data;
 }
/*高橋function変更しました （ここまで）*/


/* 20230513高橋　後半タブ詳細表示　（ここから） */

//5-紹介・逆紹介(1) $Yearsの取得
function get_10Years(){
    $year = date("Y"); //現在の年を取得
    
    //過去10年
    $Years = array();
    for($num = 0; $num <= 9; $num++){
    $Years[$num] = $year-$num;
    }
    sort($Years); //配列の要素を昇順に並び替え
return $Years;
}


//5-紹介・逆紹介(2) 表示
//附属病院
//紹介
    function detail_intr($dbh,$hos_cd){
        $Years=get_10Years(); //＊過去10年配列$Years
        $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列
        $sql="SELECT fie_name
        ,(
            SELECT SUM(intr) FROM intro AS A 
            WHERE A.fie_name=intro.fie_name AND hos_cd=:hos_cd 
            AND year IN (".$str_Years.") 
        ) AS sALL";

        foreach($Years as $y){
            $sql .= ",( SELECT SUM(intr) FROM intro AS A 
                WHERE A.fie_name=intro.fie_name
                AND year ='".$y."' AND hos_cd=:hos_cd
            ) AS '".$y."'";
        }

        $sql .= " FROM intro WHERE hos_cd=:hos_cd and ins='0' GROUP  BY fie_name";

        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
    //echo $sql;
    return $data;
    }
        function SUMs_intr($dbh,$hos_cd){
            $Years=get_10Years(); //＊過去10年配列$Years
            $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列
            $sql="SELECT hos_cd 
            ,(
                SELECT SUM(intr) FROM intro AS A 
                WHERE hos_cd=:hos_cd 
                AND year IN (".$str_Years.") 
            ) AS sALL";

            foreach($Years as $y){
                $sql .= ",( SELECT SUM(intr) FROM intro AS A 
                    WHERE year ='".$y."' AND hos_cd=:hos_cd
                ) AS '".$y."'";
            }

            $sql .= " FROM intro WHERE hos_cd=:hos_cd and ins='0' GROUP BY hos_cd";
            
            $stmt = $dbh->prepare($sql);
            $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
            $stmt->execute();
            $data = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
        //echo $sql;
        return $data;
        }

//逆紹介
    function detail_invintr($dbh,$hos_cd){
        $Years=get_10Years(); //＊過去10年配列$Years
        $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列
        $sql="SELECT fie_name
        ,(
            SELECT SUM(invr_intr) FROM invers_intro AS A 
            WHERE A.fie_name=invers_intro.fie_name AND hos_cd=:hos_cd 
            AND year IN (".$str_Years.") 
        ) AS sALL";

        foreach($Years as $y){
            $sql .= ",( SELECT SUM(invr_intr) FROM invers_intro AS A 
                WHERE A.fie_name=invers_intro.fie_name
                AND year ='".$y."' AND hos_cd=:hos_cd
            ) AS '".$y."'";
        }

        $sql .= " FROM invers_intro WHERE hos_cd=:hos_cd and ins='0' GROUP BY fie_name";

        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
    //echo $sql;
    return $data;
    }
        function SUMs_invintr($dbh,$hos_cd){
            $Years=get_10Years(); //＊過去10年配列$Years
            $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列    
            $sql="SELECT hos_cd 
            ,(
                SELECT SUM(invr_intr) FROM invers_intro AS A 
                WHERE hos_cd=:hos_cd 
                AND year IN (".$str_Years.") 
            ) AS sALL";
        
            foreach($Years as $y){
                $sql .= ",( SELECT SUM(invr_intr) FROM invers_intro AS A 
                    WHERE year ='".$y."' AND hos_cd=:hos_cd
                ) AS '".$y."'";
            }
        
            $sql .= " FROM invers_intro WHERE hos_cd=:hos_cd and ins='0' GROUP BY hos_cd";
        
            $stmt = $dbh->prepare($sql);
            $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
            $stmt->execute();
            $data = array();
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
        //echo $sql;
        return $data;
        }

//総合医療センター        
//紹介
function detail_intr1($dbh,$hos_cd){
    $Years=get_10Years(); //＊過去10年配列$Years
    $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列
    $sql="SELECT fie_name
    ,(
        SELECT SUM(intr) FROM intro AS A 
        WHERE A.fie_name=intro.fie_name AND hos_cd=:hos_cd 
        AND year IN (".$str_Years.") 
    ) AS sALL";

    foreach($Years as $y){
        $sql .= ",( SELECT SUM(intr) FROM intro AS A 
            WHERE A.fie_name=intro.fie_name
            AND year ='".$y."' AND hos_cd=:hos_cd
        ) AS '".$y."'";
    }

    $sql .= " FROM intro WHERE hos_cd=:hos_cd and ins='1' GROUP  BY fie_name";

    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
//echo $sql;
return $data;
}
    function SUMs_intr1($dbh,$hos_cd){
        $Years=get_10Years(); //＊過去10年配列$Years
        $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列
        $sql="SELECT hos_cd 
        ,(
            SELECT SUM(intr) FROM intro AS A 
            WHERE hos_cd=:hos_cd 
            AND year IN (".$str_Years.") 
        ) AS sALL";

        foreach($Years as $y){
            $sql .= ",( SELECT SUM(intr) FROM intro AS A 
                WHERE year ='".$y."' AND hos_cd=:hos_cd
            ) AS '".$y."'";
        }

        $sql .= " FROM intro WHERE hos_cd=:hos_cd and ins='1' GROUP BY hos_cd";
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
    //echo $sql;
    return $data;
    }

//逆紹介
function detail_invintr1($dbh,$hos_cd){
    $Years=get_10Years(); //＊過去10年配列$Years
    $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列
    $sql="SELECT fie_name
    ,(
        SELECT SUM(invr_intr) FROM invers_intro AS A 
        WHERE A.fie_name=invers_intro.fie_name AND hos_cd=:hos_cd 
        AND year IN (".$str_Years.") 
    ) AS sALL";

    foreach($Years as $y){
        $sql .= ",( SELECT SUM(invr_intr) FROM invers_intro AS A 
            WHERE A.fie_name=invers_intro.fie_name
            AND year ='".$y."' AND hos_cd=:hos_cd
        ) AS '".$y."'";
    }

    $sql .= " FROM invers_intro WHERE hos_cd=:hos_cd and ins='1' GROUP BY fie_name";

    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
//echo $sql;
return $data;
}
    function SUMs_invintr1($dbh,$hos_cd){
        $Years=get_10Years(); //＊過去10年配列$Years
        $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列    
        $sql="SELECT hos_cd 
        ,(
            SELECT SUM(invr_intr) FROM invers_intro AS A 
            WHERE hos_cd=:hos_cd 
            AND year IN (".$str_Years.") 
        ) AS sALL";
    
        foreach($Years as $y){
            $sql .= ",( SELECT SUM(invr_intr) FROM invers_intro AS A 
                WHERE year ='".$y."' AND hos_cd=:hos_cd
            ) AS '".$y."'";
        }
    
        $sql .= " FROM invers_intro WHERE hos_cd=:hos_cd and ins='1' GROUP BY hos_cd";
    
        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
    //echo $sql;
    return $data;
    }

//高齢者医療センター        
//紹介
function detail_intr2($dbh,$hos_cd){
    $Years=get_10Years(); //＊過去10年配列$Years
    $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列
    $sql="SELECT fie_name
    ,(
        SELECT SUM(intr) FROM intro AS A 
        WHERE A.fie_name=intro.fie_name AND hos_cd=:hos_cd 
        AND year IN (".$str_Years.") 
    ) AS sALL";

    foreach($Years as $y){
        $sql .= ",( SELECT SUM(intr) FROM intro AS A 
            WHERE A.fie_name=intro.fie_name
            AND year ='".$y."' AND hos_cd=:hos_cd
        ) AS '".$y."'";
    }

    $sql .= " FROM intro WHERE hos_cd=:hos_cd and ins='2' GROUP  BY fie_name";

    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
//echo $sql;
return $data;
}
    function SUMs_intr2($dbh,$hos_cd){
        $Years=get_10Years(); //＊過去10年配列$Years
        $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列
        $sql="SELECT hos_cd 
        ,(
            SELECT SUM(intr) FROM intro AS A 
            WHERE hos_cd=:hos_cd 
            AND year IN (".$str_Years.") 
        ) AS sALL";

        foreach($Years as $y){
            $sql .= ",( SELECT SUM(intr) FROM intro AS A 
                WHERE year ='".$y."' AND hos_cd=:hos_cd
            ) AS '".$y."'";
        }

        $sql .= " FROM intro WHERE hos_cd=:hos_cd and ins='2' GROUP BY hos_cd";
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
    //echo $sql;
    return $data;
    }

//逆紹介
function detail_invintr2($dbh,$hos_cd){
    $Years=get_10Years(); //＊過去10年配列$Years
    $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列
    $sql="SELECT fie_name
    ,(
        SELECT SUM(invr_intr) FROM invers_intro AS A 
        WHERE A.fie_name=invers_intro.fie_name AND hos_cd=:hos_cd 
        AND year IN (".$str_Years.") 
    ) AS sALL";

    foreach($Years as $y){
        $sql .= ",( SELECT SUM(invr_intr) FROM invers_intro AS A 
            WHERE A.fie_name=invers_intro.fie_name
            AND year ='".$y."' AND hos_cd=:hos_cd
        ) AS '".$y."'";
    }

    $sql .= " FROM invers_intro WHERE hos_cd=:hos_cd and ins='2' GROUP BY fie_name";

    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
//echo $sql;
return $data;
}
    function SUMs_invintr2($dbh,$hos_cd){
        $Years=get_10Years(); //＊過去10年配列$Years
        $str_Years = implode(',', $Years);//＊過去10年カンマつなぎの文字列    
        $sql="SELECT hos_cd 
        ,(
            SELECT SUM(invr_intr) FROM invers_intro AS A 
            WHERE hos_cd=:hos_cd 
            AND year IN (".$str_Years.") 
        ) AS sALL";
    
        foreach($Years as $y){
            $sql .= ",( SELECT SUM(invr_intr) FROM invers_intro AS A 
                WHERE year ='".$y."' AND hos_cd=:hos_cd
            ) AS '".$y."'";
        }
    
        $sql .= " FROM invers_intro WHERE hos_cd=:hos_cd and ins='2' GROUP BY hos_cd";
    
        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
    //echo $sql;
    return $data;
    }
        

//6-兼業 表示
function detail_training($dbh,$hos_cd){
    $sql = "
    SELECT 
    t.hos_cd, t.year, t.ins, t.tra_name, t.dep, t.position, t.name, t.start, t.end, t.dia_div, t.date, p.`order`
    FROM training AS t
    JOIN positions AS p ON t.position = p.position
    WHERE t.hos_cd = :hos_cd
    ORDER BY t.year DESC, t.dep DESC, p.`order` ASC;
    ";

    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(':hos_cd', $hos_cd,PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
return $data;
} 

//7-連携状況 表示
    //カルナコネクト
    function detail_carna($dbh,$hos_cd){
        $sql="SELECT hos_cd FROM carna_connect 
        WHERE delete_flg=0 AND hos_cd=:hos_cd";
        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data = $row;
        }
    return $data;
    }

    //連携パス
    function detail_cPath($dbh,$hos_cd,$ins){
        $sql="SELECT hos_cd,`cp0`,`cp1`,`cp2`,`cp3`,`cp4`,`cp5`,`cp6`,`cp7`,`cp8` 
        FROM c_path WHERE delete_flg=0 AND hos_cd=:hos_cd AND ins=:ins";
        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->bindvalue(':ins', $ins, PDO::PARAM_INT);
        $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data = $row;
        }
    return $data;
    }

    //医療連携懇話会　参加年度
    function detail_socialMeeting($dbh,$hos_cd,$ins){
        $sql="SELECT hos_cd, ins, `year` 
        FROM social_meeting WHERE delete_flg=0 AND ins=:ins AND hos_cd=:hos_cd;";
        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->bindvalue(':ins', $ins, PDO::PARAM_INT);
        $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
    return $data;
    }

/* 20231218コンタクト履歴 降順表示修正  中尾*/
//8-コンタクト履歴（附属、センター）
function detail_contact($dbh,$hos_cd){
    // 元のSQL（日付条件を元に戻す）
    $sql="SELECT * ,DATE_FORMAT(date,'%c月%e日') as MMDD  FROM contact WHERE hos_cd=:hos_cd and `date` >= DATE_ADD(NOW(), interval -3 year) order by date desc;";
    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    
    // データが見つからない場合、先頭ゼロを除去して再検索
    if (empty($data)) {
        $hos_cd_trimmed = ltrim($hos_cd, '0'); // 先頭のゼロを除去
        if ($hos_cd_trimmed !== $hos_cd && $hos_cd_trimmed !== '') {
            $stmt2 = $dbh->prepare($sql);
            $stmt2->bindvalue(':hos_cd', $hos_cd_trimmed, PDO::PARAM_STR);
            $stmt2->execute();
            while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
        }
    }
    
return $data;
}

//9-診療内容 表示
//20230704高橋修正
function detail_medCare($dbh,$hos_cd){
    //$sql="SELECT * FROM medcare WHERE delete_flg=0 AND hos_cd=:hos_cd;";
    $sql="SELECT hos_cd,
    med_1,med_2,med_3,med_4,med_5,med_6,med_7,med_8,med_9,med_10,
    med_11,med_12,med_13,med_14,med_15,med_16,med_17,med_18,med_19,med_20,
    med_21,med_22,med_23,med_24,med_25,med_26,med_27,med_28,med_29,med_30,
    med_31,med_32,med_33,med_34,med_35,med_36,med_37,med_38,med_39,med_40,
    med_41,med_42,med_43,med_44,med_45,med_46,med_47,med_48,med_49,med_50,
    med_51,med_52,med_53,med_54,med_55,med_56,med_57,med_58,med_59,med_60,
    med_61,med_62,med_63,med_64,med_65,med_66,med_67,med_68,med_69,med_70,
    med_71,med_72,med_73,med_74,med_75,med_76,med_77,med_78,med_79,med_80,
    med_81,med_82,med_83,med_84,med_85,med_86,med_87,med_88,med_89,med_90,
    med_91,med_92,med_93,med_94,med_95,med_96,med_97,med_98,med_99,med_100,
    med_101,med_102,med_103,med_104,med_105,med_106,med_107,med_108,med_109,med_110,
    med_111,med_112,med_113,med_114,med_115,med_116,med_117,med_118,med_119,med_120,
    med_121,med_122,med_123,med_124,med_125,med_126,med_127,med_128,med_129,med_130,
    med_131,med_132,med_133,med_134,med_135,med_136,med_137,med_138,med_139,med_140,
    med_141,med_142,med_143,med_144,med_145,med_146,med_147,med_148,med_149,med_150,
    med_151,med_152,med_153,med_154,med_155,med_156,med_157,med_158,med_159,med_160,
    med_161,med_162,med_163,med_164,
    med_note 
    FROM medcare WHERE delete_flg=0 AND hos_cd=:hos_cd;";
    $stmt = $dbh->prepare($sql);
    $stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
return $data;
}
    //診療内容マスタ
    function medCare($dbh,$med_div){
        $sql = "SELECT med_code, med_div, med_dep, med_det FROM medcare_mst WHERE med_div = :med_div";
        $stmt = $dbh->prepare($sql);
        $stmt->bindvalue(':med_div', $med_div, PDO::PARAM_STR);
        $stmt->execute(); 
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
    return $data;
    }

/* 20230513高橋　後半タブ詳細表示　（ここまで） */


//高橋　地域取得
function get_area($dbh){
    $sql = "SELECT sec_cd, area2, city, zone, town FROM area";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(); 
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
return $data;

}

//高橋　医師会データリスト取得
function get_ass($dbh){
    $sql = "SELECT med_ass FROM med_ass";
    $stmt = $dbh->prepare($sql);
    $stmt->execute(); 
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
return $data;
}


//user
//1つのデータだけ表示
function user_info($dbh,$user_id){
    $sql = "SELECT * FROM user WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt -> bindValue(':user_id', $user_id,PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
return $data;

}
//櫻間

//嶋津
//入力した情報をDBに入れる
function insert_user($dbh,$user_id,$user_name,$ins,$bel,$pw,$adm_user,$start,$end,$onf,$up_date) {
    
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (user_id, user_name, ins, bel, pw, adm_user,start,end,onf,up_date) VALUES (:user_id,:user_name,:ins,:bel,:pw,:adm_user,:start,:end,:onf,:up_date)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->bindValue(':ins', $ins, PDO::PARAM_STR);
    $stmt->bindValue(':bel', $bel, PDO::PARAM_STR);
    $stmt->bindValue(':pw', $pw, PDO::PARAM_STR);
    $stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_INT);
    $stmt->bindValue(':start', $start, PDO::PARAM_STR);
    $stmt->bindValue(':end', $end, PDO::PARAM_STR);
    $stmt->bindValue(':onf', $onf, PDO::PARAM_INT);
    $stmt->bindValue(':up_date', $up_date, PDO::PARAM_STR);
    $stmt->execute();

}


//✅20230102高橋 全データ表示-利用中ユーザ
function get_result1($dbh) {
    $sql = "SELECT `user_id`, `user_name`, ins, bel, pw, adm_user, `start`, up_date, onf FROM user WHERE onf = 0";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
return $data;
}

//✅20230102高橋 全データ表示-停止中ユーザ
function get_result2($dbh) {
    $sql = "SELECT `user_id`, `user_name`, ins, bel, pw, adm_user, `end`, onf FROM user WHERE onf = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

//✅20230102高橋 全データ表示-全ユーザ 20230102高橋追加
function get_result3($dbh) {
    $sql = "SELECT * FROM user WHERE 1=1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}




//1つのデータだけ表示
function get_data1($dbh,$user_id){
    $sql = "SELECT * FROM user WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt -> bindValue(':user_id', $user_id,PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

//ユーザー名更新
function update_user_name($dbh,$user_id,$user_name){
    $sql = "UPDATE user SET user_name = :user_name WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
}

//施設更新
function update_ins($dbh,$user_id,$ins){
    $sql = "UPDATE user SET ins = :ins WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':ins', $ins, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
}

//所属更新
function update_bel($dbh,$user_id,$bel){
    $sql = "UPDATE user SET bel = :bel WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':bel', $bel, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
}

//パスワード更新
function update_pw($dbh,$user_id,$pw){
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $sql = "UPDATE user SET pw = :pw WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':pw', $pw, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
}

//権限更新
function update_adm_user($dbh,$user_id,$adm_user){
    $sql = "UPDATE user SET  adm_user= :adm_user WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':adm_user', $adm_user, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
}

//最終更新日更新
function update_up_date($dbh,$user_id,$up_date){
    $sql = "UPDATE user SET up_date = :up_date WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':up_date', $up_date, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
}

//終了日更新
function update_end($dbh,$user_id,$end){
    $sql = "UPDATE user SET end = :end WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':end', $end, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
}

//ユーザー非表示更新
function update_onf($dbh,$user_id,$onf){
    $sql = "UPDATE user SET onf = :onf WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->bindValue(':onf', $onf, PDO::PARAM_STR);
    $stmt->execute();
}

//ユーザー削除
function deletion_user($dbh,$user_id){
    $sql = "DELETE FROM user WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue('user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
}

//db_helper

//ユーザー情報チェック
function user_check($dbh,$user_id) {
    $sql = "SELECT user_id FROM user WHERE user_id = :user_id LIMIT 1";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

//20231031櫻間

function select_member($dbh, $user_id, $pw){
    $sql = 'SELECT * FROM `user` WHERE `user_id` = :id LIMIT 1';
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':id', $user_id, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if(password_verify($pw, $data['pw'])){
            return $data;
        }else{
            return false;
        }
        return false;
    }
}

//20231031櫻間

//全データ表示
function result1($dbh) {
    $sql = "SELECT hos_cd, hos_name FROM main WHERE onf = 0";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

//全データ表示
function result2($dbh) {
    $sql = "SELECT hos_cd, hos_name FROM main WHERE onf = 1";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}


//1つのデータだけ表示
function gget_data($dbh,$hos_cd){
    $sql = "SELECT hos_cd, hos_name FROM main WHERE hos_cd = :hos_cd";
    $stmt = $dbh->prepare($sql);
    $stmt -> bindValue(':hos_cd', $hos_cd,PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
return $data;
}


//医療機関停止
function update_onf1($dbh,$hos_cd,$onf){
    $sql = "UPDATE main SET onf = :onf WHERE hos_cd = :hos_cd";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':onf', $onf, PDO::PARAM_STR);
    $stmt->execute();
}

//医療機関削除

//基本情報テーブル
function deletion_user1($dbh,$hos_cd){
    $sql = "DELETE FROM main WHERE hos_cd = :hos_cd";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue('hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
}

//親族情報テーブル
function deletion_user2($dbh,$hos_cd){
    $sql = "DELETE FROM relative WHERE hos_cd = :hos_cd";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue('hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
}

//部門連絡先テーブル
function deletion_user3($dbh,$hos_cd){
    $sql = "DELETE FROM field_junction WHERE hos_cd = :hos_cd";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue('hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
}

//20230704高橋 診療内容テーブル
function deletion_user4($dbh,$hos_cd){
    $sql = "DELETE FROM medcare WHERE hos_cd = :hos_cd";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue('hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
}


?>


<?php
/*更新 */
//基本情報note関係だけ消してます
//櫻間20230317
//20231031櫻間
function update_main($dbh,$op_flg,$hos_div,$clo_day,$chi_name,$chi_spe,$chi_year,$chi_sch,$chi_note,$pre_name,$pre_spe,$pre_year,$pre_sch,$pre_note,$con_hour,$mon_am,$mon_pm,$tue_am,$tue_pm,$wed_am,$wed_pm,$thr_am,$thr_pm,$fri_am,$fri_pm,$sat_am,$sat_pm,$sun_am,$sun_pm,$holiday,$int_int,$int_dig,$int_uri,$int_tum,$int_res,$int_kid,$int_blo,$int_apo,$int_cir,$int_ner,$int_inf,$ped_ped,$ped_sur,$ped_neo,$sur_sur,$sur_lac,$sur_ner,$sur_nes,$sur_dig,$sur_car,$sur_ven,$ort_rhe,$ort_cos,$ort_ort,$ort_reh,$ort_pla,$oph_oph,$ent_ent,$ent_to,$so_sky,$so_org,$gyn_gyn,$gyn_obs,$gyn_gyne,$psy_psy,$psy_psyc,$den_den,$den_cav,$den_ref,$den_ped,$alle,$pat,$checkup,$rad,$cli,$ane,$eme,$bed,$bed_reh,$bed_tre,$bed_main,$bed_care,$bed_tra,$bed_att,$pt,$ot,$st,$hos_cd,$hos_name,$zipcode,$pre,$city,$zone,$town,$str_num,$tel,$fax,$mail,$med_ass,$note,$dep_note,$drct_note,$num_note,$intr_note,$tra_note,$coop_note,$con_note,$ad,$area,$onf,$log_data,$log_name,$are_cd){

$sql="UPDATE `main` SET op_flg =:op_flg ,hos_div =:hos_div , clo_day =:clo_day , chi_name = :chi_name , chi_spe = :chi_spe , chi_year =:chi_year , chi_sch = :chi_sch , chi_note =:chi_note , pre_name =:pre_name , pre_spe = :pre_spe , pre_year = :pre_year , pre_sch =:pre_sch , pre_note = :pre_note , con_hour =:con_hour , mon_am =:mon_am , mon_pm =:mon_pm , tue_am =:tue_am , tue_pm =:tue_pm , wed_am =:wed_am , wed_pm =:wed_pm , thr_am =:thr_am , thr_pm = :thr_pm , fri_am = :fri_am ,fri_pm = :fri_pm , sat_am =:sat_am , sat_pm =:sat_pm , sun_am = :sun_am , sun_pm =:sun_pm , holiday =:holiday , int_int =:int_int , int_dig =:int_dig , int_uri =:int_uri , int_tum =:int_tum , int_res =:int_res , int_kid =:int_kid , int_blo =:int_blo , int_apo =:int_apo , int_cir =:int_cir , int_ner =:int_ner , int_inf =:int_inf , ped_ped =:ped_ped , ped_sur =:ped_sur , ped_neo =:ped_neo , sur_sur =:sur_sur , sur_lac =:sur_lac , sur_ner =:sur_ner , sur_nes =:sur_nes , sur_dig =:sur_dig , sur_car =:sur_car , sur_ven =:sur_ven , ort_rhe =:ort_rhe , ort_cos =:ort_cos , ort_ort =:ort_ort , ort_reh=:ort_reh , ort_pla =:ort_pla , oph_oph =:oph_oph , ent_ent =:ent_ent ,ent_to =:ent_to ,so_sky =:so_sky ,so_org =:so_org ,gyn_gyn =:gyn_gyn ,gyn_obs =:gyn_obs ,gyn_gyne =:gyn_gyne ,psy_psy =:psy_psy ,psy_psyc =:psy_psyc ,den_den =:den_den ,den_cav =:den_cav ,den_ref =:den_ref ,den_ped =:den_ped ,alle =:alle ,pat =:pat,checkup =:checkup , rad =:rad , cli =:cli , ane =:ane , eme =:eme , bed =:bed , bed_reh =:bed_reh , bed_tre =:bed_tre , bed_main =:bed_main , bed_care =:bed_care , bed_tra =:bed_tra , bed_att =:bed_att , pt =:pt , ot =:ot , st =:st,hos_name =:hos_name, zipcode =:zipcode, pre =:pre, city =:city, zone =:zone, town =:town, str_num =:str_num, tel =:tel, fax =:fax,email =:mail, med_ass =:med_ass, note =:note ,drct_note =:drct_note , dep_note =:dep_note , num_note =:num_note,intr_note = :intr_note,tra_note = :tra_note,coop_note = :coop_note,con_note = :con_note,are_cd=:are_cd,onf=:onf, log_data=:log_data, log_name=:log_name,ad=:ad,area=:area WHERE hos_cd =:hos_cd ";


 $stmt = $dbh->prepare($sql);

  $stmt->bindValue(':op_flg',$op_flg, PDO::PARAM_INT);
  $stmt->bindValue(':hos_div',$hos_div, PDO::PARAM_STR);
  $stmt->bindValue(':med_ass',$med_ass, PDO::PARAM_STR);
  $stmt->bindValue(':clo_day',$clo_day, PDO::PARAM_STR);
  $stmt->bindValue(':are_cd',$are_cd, PDO::PARAM_INT);
  $stmt->bindValue(':ad',$ad, PDO::PARAM_STR);
  $stmt->bindValue(':area',$area, PDO::PARAM_STR);


  //病院長理事長
  $stmt->bindValue(':chi_name',$chi_name, PDO::PARAM_STR);
  $stmt->bindValue(':chi_spe',$chi_spe, PDO::PARAM_STR);
  $stmt->bindValue(':chi_year',$chi_year, PDO::PARAM_STR);
  $stmt->bindValue(':chi_sch',$chi_sch, PDO::PARAM_STR);
  $stmt->bindValue(':chi_note',$chi_note, PDO::PARAM_STR);
  $stmt->bindValue(':pre_name',$pre_name, PDO::PARAM_STR);
  $stmt->bindValue(':pre_spe',$pre_spe, PDO::PARAM_STR);
  $stmt->bindValue(':pre_year',$pre_year, PDO::PARAM_STR);
  $stmt->bindValue(':pre_sch',$pre_sch, PDO::PARAM_STR);
  $stmt->bindValue(':pre_note',$pre_note, PDO::PARAM_STR);

  $stmt->bindValue(':con_hour',$con_hour, PDO::PARAM_STR);
  $stmt->bindValue(':mon_am',$mon_am, PDO::PARAM_STR);
  $stmt->bindValue(':mon_pm',$mon_pm, PDO::PARAM_STR);
  $stmt->bindValue(':tue_am',$tue_am, PDO::PARAM_STR);
  $stmt->bindValue(':tue_pm',$tue_pm, PDO::PARAM_STR);
  $stmt->bindValue(':wed_am',$wed_am, PDO::PARAM_STR);
  $stmt->bindValue(':wed_pm',$wed_pm, PDO::PARAM_STR);
  $stmt->bindValue(':thr_am',$thr_am, PDO::PARAM_STR);
  $stmt->bindValue(':thr_pm',$thr_pm, PDO::PARAM_STR);
  $stmt->bindValue(':fri_am',$fri_am, PDO::PARAM_STR);
  $stmt->bindValue(':fri_pm',$fri_pm, PDO::PARAM_STR);
  $stmt->bindValue(':sat_am',$sat_am, PDO::PARAM_STR);
  $stmt->bindValue(':sat_pm',$sat_pm, PDO::PARAM_STR);
  $stmt->bindValue(':sun_am',$sun_am, PDO::PARAM_STR);
  $stmt->bindValue(':sun_pm',$sun_pm, PDO::PARAM_STR);
  $stmt->bindValue(':holiday',$holiday, PDO::PARAM_STR);

  $stmt->bindValue(':int_int',$int_int, PDO::PARAM_STR);
  $stmt->bindValue(':int_dig',$int_dig, PDO::PARAM_STR);
  $stmt->bindValue(':int_uri',$int_uri, PDO::PARAM_STR);
  $stmt->bindValue(':int_tum',$int_tum, PDO::PARAM_STR);
  $stmt->bindValue(':int_res',$int_res, PDO::PARAM_STR);
  $stmt->bindValue(':int_kid',$int_kid, PDO::PARAM_STR);
  $stmt->bindValue(':int_blo',$int_blo, PDO::PARAM_STR);
  $stmt->bindValue(':int_apo',$int_apo, PDO::PARAM_STR);
  $stmt->bindValue(':int_cir',$int_cir, PDO::PARAM_STR);
  $stmt->bindValue(':int_ner',$int_ner, PDO::PARAM_STR);
  $stmt->bindValue(':int_inf',$int_inf, PDO::PARAM_STR);
  $stmt->bindValue(':ped_ped',$ped_ped, PDO::PARAM_STR);
  $stmt->bindValue(':ped_sur',$ped_sur, PDO::PARAM_STR);
  $stmt->bindValue(':ped_neo',$ped_neo, PDO::PARAM_STR);
  $stmt->bindValue(':sur_sur',$sur_sur, PDO::PARAM_STR);
  $stmt->bindValue(':sur_lac',$sur_lac, PDO::PARAM_STR);
  $stmt->bindValue(':sur_ner',$sur_ner, PDO::PARAM_STR);
  $stmt->bindValue(':sur_nes',$sur_nes, PDO::PARAM_STR);
  $stmt->bindValue(':sur_dig',$sur_dig, PDO::PARAM_STR);
  $stmt->bindValue(':sur_car',$sur_car, PDO::PARAM_STR);
  $stmt->bindValue(':sur_ven',$sur_ven, PDO::PARAM_STR);
  $stmt->bindValue(':ort_rhe',$ort_rhe, PDO::PARAM_STR);
  $stmt->bindValue(':ort_cos',$ort_cos, PDO::PARAM_STR);
  $stmt->bindValue(':ort_ort',$ort_ort, PDO::PARAM_STR);
  $stmt->bindValue(':ort_reh',$ort_reh, PDO::PARAM_STR);
  $stmt->bindValue(':ort_pla',$ort_pla, PDO::PARAM_STR);
  $stmt->bindValue(':oph_oph',$oph_oph, PDO::PARAM_STR);
  $stmt->bindValue(':ent_ent',$ent_ent, PDO::PARAM_STR);
  $stmt->bindValue(':ent_to',$ent_to, PDO::PARAM_STR);
  $stmt->bindValue(':so_sky',$so_sky, PDO::PARAM_STR);
  $stmt->bindValue(':so_org',$so_org, PDO::PARAM_STR);
  $stmt->bindValue(':gyn_gyn',$gyn_gyn, PDO::PARAM_STR);
  $stmt->bindValue(':gyn_obs',$gyn_obs, PDO::PARAM_STR);
  $stmt->bindValue(':gyn_gyne',$gyn_gyne, PDO::PARAM_STR);
  $stmt->bindValue(':psy_psy',$psy_psy, PDO::PARAM_STR);
  $stmt->bindValue(':psy_psyc',$psy_psyc, PDO::PARAM_STR);
  $stmt->bindValue(':den_den',$den_den, PDO::PARAM_STR);
  $stmt->bindValue(':den_cav',$den_cav, PDO::PARAM_STR);
  $stmt->bindValue(':den_ref',$den_ref, PDO::PARAM_STR);
  $stmt->bindValue(':den_ped',$den_ped, PDO::PARAM_STR);
  $stmt->bindValue(':alle',$alle, PDO::PARAM_STR);
  $stmt->bindValue(':pat',$pat, PDO::PARAM_STR);
  $stmt->bindValue(':checkup',$checkup, PDO::PARAM_STR);
  $stmt->bindValue(':rad',$rad, PDO::PARAM_STR);
  $stmt->bindValue(':cli',$cli, PDO::PARAM_STR);
  $stmt->bindValue(':ane',$ane, PDO::PARAM_STR);
  $stmt->bindValue(':eme',$eme, PDO::PARAM_STR);
  $stmt->bindValue(':bed',$bed, PDO::PARAM_INT);
  $stmt->bindValue(':bed_reh',$bed_reh, PDO::PARAM_STR);
  $stmt->bindValue(':bed_tre',$bed_tre, PDO::PARAM_STR);
  $stmt->bindValue(':bed_main',$bed_main, PDO::PARAM_STR);
  $stmt->bindValue(':bed_care',$bed_care, PDO::PARAM_STR);
  $stmt->bindValue(':bed_tra',$bed_tra, PDO::PARAM_STR);
  $stmt->bindValue(':bed_att',$bed_att, PDO::PARAM_STR);
  $stmt->bindValue(':pt',$pt, PDO::PARAM_STR);
  $stmt->bindValue(':ot',$ot, PDO::PARAM_STR);
  $stmt->bindValue(':st',$st, PDO::PARAM_STR);
  $stmt->bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
  $stmt->bindValue(':hos_name',$hos_name, PDO::PARAM_STR);
  $stmt->bindValue(':zipcode',$zipcode, PDO::PARAM_STR);
  $stmt->bindValue(':pre',$pre, PDO::PARAM_STR);
  $stmt->bindValue(':city',$city, PDO::PARAM_STR);
  $stmt->bindValue(':zone',$zone, PDO::PARAM_STR);
  $stmt->bindValue(':town',$town, PDO::PARAM_STR);
  $stmt->bindValue(':str_num',$str_num, PDO::PARAM_STR);
  $stmt->bindValue(':tel',$tel, PDO::PARAM_STR);
  $stmt->bindValue(':fax',$fax, PDO::PARAM_STR);
    //櫻間20230317
    $stmt->bindValue(':mail',$mail, PDO::PARAM_STR);
  $stmt->bindValue(':note',$note, PDO::PARAM_STR);
  $stmt->bindValue(':drct_note',$drct_note, PDO::PARAM_STR);
  $stmt->bindValue(':dep_note',$dep_note, PDO::PARAM_STR);
  $stmt->bindValue(':num_note',$num_note, PDO::PARAM_STR);

  $stmt->bindValue(':onf',$onf, PDO::PARAM_INT);
  $stmt->bindValue(':dep_note',$dep_note, PDO::PARAM_STR);

    //後半 備考
    $stmt->bindValue(':intr_note',$intr_note, PDO::PARAM_STR);
    $stmt->bindValue(':tra_note',$tra_note, PDO::PARAM_STR);
    $stmt->bindValue(':coop_note',$coop_note, PDO::PARAM_STR);
    $stmt->bindValue(':con_note',$con_note, PDO::PARAM_STR);

  $stmt->bindValue(':log_data',$log_data, PDO::PARAM_STR); 
  $stmt->bindValue(':log_name',$log_name, PDO::PARAM_STR);
  $stmt->execute();
    //高橋 GeneralErrorの原因消しました

}


/*ログ */
function log_henkou($dbh,$hos_cd,$log_data,$log_name){
    $sql = "UPDATE `main` SET `log_data`=:log_data,`log_name`=:log_name WHERE `hos_cd` =:hos_cd;";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':log_data',$log_data, PDO::PARAM_STR);
    $stmt->bindValue(':log_name',$log_name, PDO::PARAM_STR);
    $stmt->execute();
    //高橋 GeneralErrorの原因消しました
  }
  

function get_log_henkou($dbh,$hos_cd){
    $sql = "SELECT `log_data`,`log_name` FROM `main` WHERE `hos_cd` = :hos_cd;";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data1 = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data1[] = $row;
    }
    return $data1;
}


//櫻間20221103
function get_depa($dbh){
    $sql="SELECT dep_name FROM department";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

return $data;

}
//櫻間20221103


/*高橋20221130追記ここから*/
//詳細　update（行変更）
function rel_rowUpdate($dbh,$hos_cd,$name,$conn,$sch_name,$ent_year,$gra_year,$rel_note,$rel_cd){
    $sql="UPDATE `relative` SET `name`=:name,`conn`=:conn,`sch_name`=:sch_name,`ent_year`=:ent_year,`gra_year`=:gra_year,`note`=:rel_note WHERE `hos_cd` = :hos_cd and `rel_cd` = :rel_cd";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':name',$name, PDO::PARAM_STR);
    $stmt->bindValue(':conn',$conn, PDO::PARAM_STR);
    $stmt->bindValue(':sch_name',$sch_name, PDO::PARAM_STR);
    $stmt->bindValue(':ent_year',$ent_year, PDO::PARAM_INT);
    $stmt->bindValue(':gra_year',$gra_year, PDO::PARAM_INT);
    $stmt->bindValue(':rel_note',$rel_note, PDO::PARAM_STR);
    $stmt->bindValue(':rel_cd',$rel_cd, PDO::PARAM_INT);
    $stmt->execute();
  }
    //高橋GeneralErrorの原因消しました
  
function fie_rowUpdate($dbh,$hos_cd,$hos_name,$fie_div,$fie_name,$fie_tel,$fie_fax,$fie_note,$fie_cd){
    $sql="UPDATE `field_junction` SET `hos_name`=:hos_name, `fie_div`=:fie_div,`fie_name`=:fie_name,`tel`=:fie_tel,`fax`=:fie_fax,`note`=:fie_note WHERE `hos_cd` = :hos_cd and `fie_cd` = :fie_cd; ";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':hos_name', $hos_name, PDO::PARAM_STR);
    $stmt->bindValue(':fie_div',$fie_div, PDO::PARAM_STR);
    $stmt->bindValue(':fie_name',$fie_name, PDO::PARAM_STR);
    $stmt->bindValue(':fie_tel',$fie_tel, PDO::PARAM_STR);
    $stmt->bindValue(':fie_fax',$fie_fax, PDO::PARAM_STR);
    $stmt->bindValue(':fie_note',$fie_note, PDO::PARAM_STR);
    $stmt->bindValue(':fie_cd',$fie_cd, PDO::PARAM_INT);
    $stmt->execute();
}
    //高橋 GeneralErrorの原因消しました
    
//詳細　insert（行追加）
function rel_rowInsert($dbh,$hos_cd,$name,$conn,$sch_name,$ent_year,$gra_year,$rel_note) {
    $sql = "INSERT INTO relative (`hos_cd`,`name`,`conn`,`sch_name`,`ent_year`,`gra_year`,`note`,`delete_flg`,`rel_cd`) VALUES (:hos_cd,:name,:conn,:sch_name,:ent_year,:gra_year,:rel_note,0,null);";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':conn', $conn, PDO::PARAM_STR);
    $stmt->bindValue(':sch_name', $sch_name, PDO::PARAM_STR);
    $stmt->bindValue(':ent_year', $ent_year, PDO::PARAM_INT);
    $stmt->bindValue(':gra_year', $gra_year, PDO::PARAM_INT);
    $stmt->bindValue(':rel_note', $rel_note, PDO::PARAM_STR);
    $stmt->execute();
}
function fie_rowInsert($dbh,$hos_cd,$hos_name,$fie_div,$fie_name,$fie_tel,$fie_fax,$fie_note) {
    $sql = "INSERT INTO field_junction (`hos_cd`,`hos_name`,`fie_div`,`fie_name`,`tel`,`fax`,`note`,`delete_flg`,`fie_cd`) VALUES (:hos_cd,:hos_name,:fie_div,:fie_name,:fie_tel,:fie_fax,:fie_note,0,null);";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':hos_name', $hos_name, PDO::PARAM_STR);
    $stmt->bindValue(':fie_div', $fie_div, PDO::PARAM_STR);
    $stmt->bindValue(':fie_name', $fie_name, PDO::PARAM_STR);
    $stmt->bindValue(':fie_tel', $fie_tel, PDO::PARAM_STR);
    $stmt->bindValue(':fie_fax', $fie_fax, PDO::PARAM_STR);
    $stmt->bindValue(':fie_note', $fie_note, PDO::PARAM_STR);
    $stmt->execute();
}
//詳細　 delete_flg = 1（行削除）
function rel_rowDelete($dbh,$hos_cd,$rel_cd){
    $sql="UPDATE relative SET delete_flg = 1 WHERE hos_cd=:hos_cd and rel_cd = :rel_cd";
    //$sql="DELETE FROM relative WHERE hos_cd=:hos_cd and rel_cd = :rel_cd";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':rel_cd',$rel_cd, PDO::PARAM_INT);
    $stmt->execute();
}
function fie_rowDelete($dbh,$hos_cd,$fie_cd){
    $sql="UPDATE field_junction SET delete_flg = 1 WHERE hos_cd=:hos_cd and fie_cd = :fie_cd";
    //$sql="DELETE FROM field_junction WHERE hos_cd=:hos_cd and fie_cd = :fie_cd";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':fie_cd',$fie_cd, PDO::PARAM_INT);
    $stmt->execute();
}
/*高橋20221130 ここまで*/


//20230609高橋　後半タブupdate ／後半タブinsert ここから
//カルナコネクト
    //⇒未登録
    function carna_Delete($dbh,$hos_cd){
        $sql="DELETE FROM carna_connect WHERE hos_cd=:hos_cd";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
    }
    //⇒登録済み
    function carna_Insert($dbh,$hos_cd){
        $sql="INSERT INTO `carna_connect` (hos_cd) VALUES (:hos_cd)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
    }

//連携パス
    function path_Delete($dbh, $hos_cd, $ins){
        $sql="DELETE FROM c_path WHERE hos_cd=:hos_cd and ins=:ins";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->bindValue(':ins', $ins, PDO::PARAM_INT);
        $stmt->execute();
    }
    function path_Insert($dbh, $hos_cd, $ins, $cp){
        for($i = 0; $i <= 8; $i++){ if(!isset($cp[$i])){ $cp[$i]='0'; } }
        $sql="INSERT INTO `c_path` (hos_cd, ins, `cp0`,`cp1`,`cp2`,`cp3`,`cp4`,`cp5`,`cp6`,`cp7`,`cp8`
        ) VALUES (:hos_cd, :ins, :cp0, :cp1, :cp2, :cp3, :cp4, :cp5, :cp6, :cp7, :cp8)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->bindValue(':ins', $ins, PDO::PARAM_INT);
        for($i = 0; $i <= 8; $i++){ 
            $stmt->bindValue(':cp'.$i, $cp[$i], PDO::PARAM_INT); 
        }
        $stmt->execute();
    }

//医療連携懇話会　参加年度
/* 高橋20231121 懇話会追加 */
function sm_Delete($dbh, $hos_cd, $ins){
    $sql="DELETE FROM social_meeting WHERE hos_cd=:hos_cd and ins=:ins";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':ins', $ins, PDO::PARAM_INT);
    $stmt->execute();
}
function sm_Insert($dbh, $hos_cd, $ins, $socialmeeting){
    $sql="INSERT INTO `social_meeting` (hos_cd, ins, `year`) VALUES (:hos_cd, :ins, :yyyy)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':ins', $ins, PDO::PARAM_INT);
    $stmt->bindValue(':yyyy', $socialmeeting, PDO::PARAM_STR);
    $stmt->execute();
}
/* 高橋20231121 懇話会追加 */


//診療内容
    function medcare_Delete($dbh,$hos_cd){
        $sql="DELETE FROM medcare WHERE hos_cd=:hos_cd";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        $stmt->execute();
    }
    function medcare_Insert($dbh, $hos_cd, $med_cd, $mcare_note){
        for($i = 1; $i <= 164; $i++){ if(!isset($med_cd[$i])){ $med_cd[$i]='0'; } }

        $sql="INSERT INTO `medcare` (hos_cd,
        `med_1`,`med_2`,`med_3`,`med_4`,`med_5`,`med_6`,`med_7`,`med_8`,`med_9`,
        `med_10`,`med_11`,`med_12`,`med_13`,`med_14`,`med_15`,`med_16`,`med_17`,`med_18`,`med_19`,`med_20`,
        `med_21`,`med_22`,`med_23`,`med_24`,`med_25`,`med_26`,`med_27`,`med_28`,`med_29`,`med_30`,
        `med_31`,`med_32`,`med_33`,`med_34`,`med_35`,`med_36`,`med_37`,`med_38`,`med_39`,`med_40`,
        `med_41`,`med_42`,`med_43`,`med_44`,`med_45`,`med_46`,`med_47`,`med_48`,`med_49`,`med_50`,
        `med_51`,`med_52`,`med_53`,`med_54`,`med_55`,`med_56`,`med_57`,`med_58`,`med_59`,`med_60`,
        `med_61`,`med_62`,`med_63`,`med_64`,`med_65`,`med_66`,`med_67`,`med_68`,`med_69`,`med_70`,
        `med_71`,`med_72`,`med_73`,`med_74`,`med_75`,`med_76`,`med_77`,`med_78`,`med_79`,`med_80`,
        `med_81`,`med_82`,`med_83`,`med_84`,`med_85`,`med_86`,`med_87`,`med_88`,`med_89`,`med_90`,
        `med_91`,`med_92`,`med_93`,`med_94`,`med_95`,`med_96`,`med_97`,`med_98`,`med_99`,`med_100`,
        `med_101`,`med_102`,`med_103`,`med_104`,`med_105`,`med_106`,`med_107`,`med_108`,`med_109`,`med_110`,
        `med_111`,`med_112`,`med_113`,`med_114`,`med_115`,`med_116`,`med_117`,`med_118`,`med_119`,`med_120`,
        `med_121`,`med_122`,`med_123`,`med_124`,`med_125`,`med_126`,`med_127`,`med_128`,`med_129`,`med_130`,
        `med_131`,`med_132`,`med_133`,`med_134`,`med_135`,`med_136`,`med_137`,`med_138`,`med_139`,`med_140`,
        `med_141`,`med_142`,`med_143`,`med_144`,`med_145`,`med_146`,`med_147`,`med_148`,`med_149`,`med_150`,
        `med_151`,`med_152`,`med_153`,`med_154`,`med_155`,`med_156`,`med_157`,`med_158`,`med_159`,`med_160`,
        `med_161`,`med_162`,`med_163`,`med_164`,
        `med_note`
        ) VALUES (:hos_cd,
        :med_1,:med_2,:med_3,:med_4,:med_5,:med_6,:med_7,:med_8,:med_9,
        :med_10,:med_11,:med_12,:med_13,:med_14,:med_15,:med_16,:med_17,:med_18,:med_19,:med_20,
        :med_21,:med_22,:med_23,:med_24,:med_25,:med_26,:med_27,:med_28,:med_29,:med_30,
        :med_31,:med_32,:med_33,:med_34,:med_35,:med_36,:med_37,:med_38,:med_39,:med_40,
        :med_41,:med_42,:med_43,:med_44,:med_45,:med_46,:med_47,:med_48,:med_49,:med_50,
        :med_51,:med_52,:med_53,:med_54,:med_55,:med_56,:med_57,:med_58,:med_59,:med_60,
        :med_61,:med_62,:med_63,:med_64,:med_65,:med_66,:med_67,:med_68,:med_69,:med_70,
        :med_71,:med_72,:med_73,:med_74,:med_75,:med_76,:med_77,:med_78,:med_79,:med_80,
        :med_81,:med_82,:med_83,:med_84,:med_85,:med_86,:med_87,:med_88,:med_89,:med_90,
        :med_91,:med_92,:med_93,:med_94,:med_95,:med_96,:med_97,:med_98,:med_99,:med_100,
        :med_101,:med_102,:med_103,:med_104,:med_105,:med_106,:med_107,:med_108,:med_109,:med_110,
        :med_111,:med_112,:med_113,:med_114,:med_115,:med_116,:med_117,:med_118,:med_119,:med_120,
        :med_121,:med_122,:med_123,:med_124,:med_125,:med_126,:med_127,:med_128,:med_129,:med_130,
        :med_131,:med_132,:med_133,:med_134,:med_135,:med_136,:med_137,:med_138,:med_139,:med_140,
        :med_141,:med_142,:med_143,:med_144,:med_145,:med_146,:med_147,:med_148,:med_149,:med_150,
        :med_151,:med_152,:med_153,:med_154,:med_155,:med_156,:med_157,:med_158,:med_159,:med_160,
        :med_161,:med_162,:med_163,:med_164,
        :med_note
        )";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
        for($i = 1; $i <= 164; $i++){ 
            $stmt->bindValue(':med_'.$i, $med_cd[$i], PDO::PARAM_INT); //診療内容マスタ164項目
        }
        $stmt->bindValue(':med_note',$mcare_note, PDO::PARAM_STR); //備考
        $stmt->execute();
    }
//20230609高橋　後半タブupdate ／後半タブinsert ここまで


//---ここからExcel関連
//詳細
function excel($dbh,$hos_cd){
    $sql="
	SELECT hos_cd, hos_div
    ,( 
        SELECT
            CASE WHEN `op_flg` = '1' 
            THEN '開院' ELSE '閉院' 
            END AS '開院区分'
        FROM main WHERE hos_cd=:hos_cd
    ) AS op, clo_day, 
    `med_ass`, hos_name, 
    zipcode, pre, city, `zone`, town, str_num,
    
    chi_name, chi_spe, chi_year, chi_sch, chi_note, pre_name, pre_spe, pre_year, pre_sch, pre_note
    ,( 
        SELECT
            CASE WHEN `name` = '' 
            THEN 'なし' ELSE 'あり' 
            END AS '親族情報'
        FROM relative WHERE hos_cd=:hos_cd
    ) AS rel
    , note, 

    con_hour, 
    mon_am, mon_pm, tue_am, tue_pm, wed_am, wed_pm, thr_am, thr_pm, fri_am, fri_pm, sat_am, sat_pm, sun_am, sun_pm, holiday, 
    
    `int_med`,`ped_med`,`sur_med`,`ort_med`,`oph_med`,`ent_med`,`so_med`,`gyn_med`,`psy_med`,`den_med`,`etc_med`,

    `int_int`,`int_dig`,`int_uri`,`int_tum`,`int_res`,`int_kid`,`int_blo`,`int_apo`,`int_cir`,`int_ner`,`int_inf`,
    `ped_ped`,`ped_sur`,`ped_neo`,
    `sur_sur`,`sur_lac`,`sur_ner`,`sur_nes`,`sur_dig`,`sur_car`,`sur_ven`,
    `ort_rhe`,`ort_cos`,`ort_ort`,`ort_reh`,`ort_pla`,
    `oph_oph`,`ent_ent`,`ent_to`,
    `so_sky`,`so_org`,
    `gyn_gyn`,`gyn_obs`,`gyn_gyne`,
    `psy_psy`,`psy_psyc`,
    `den_den`,`den_cav`,`den_ref`,`den_ped`,`alle`,`pat`,`checkup`,`rad`,`cli`,`ane`,`eme`, 
    
    `bed`,
    `bed_reh`,`bed_tre`,`bed_main`,`bed_care`,`bed_tra`,`bed_att`,
    `pt`,`ot`,`st` 
    
    FROM `main` WHERE `hos_cd` = :hos_cd; ";
    
    //$sql="SELECT * FROM `main` WHERE `hos_cd` = :hos_cd";
	$stmt = $dbh->prepare($sql);
	$stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}
//櫻間20221102病院長・理事長なし
function excel2($dbh,$hos_cd){
    $sql="
	SELECT hos_cd, hos_div 
    ,( 
        SELECT
            CASE WHEN `op_flg` = '1' 
            THEN '開院' ELSE '閉院' 
            END AS '開院区分'
        FROM main WHERE hos_cd=:hos_cd
    ) AS op, clo_day, 
    `med_ass`, hos_name, 
    zipcode, pre, city, `zone`, town, str_num, note,
    
    con_hour, 
    mon_am, mon_pm, tue_am, tue_pm, wed_am, wed_pm, thr_am, thr_pm, fri_am, fri_pm, sat_am, sat_pm, sun_am, sun_pm, holiday, 
    
    `int_med`,`ped_med`,`sur_med`,`ort_med`,`oph_med`,`ent_med`,`so_med`,`gyn_med`,`psy_med`,`den_med`,`etc_med`,

    `int_int`,`int_dig`,`int_uri`,`int_tum`,`int_res`,`int_kid`,`int_blo`,`int_apo`,`int_cir`,`int_ner`,`int_inf`,
    `ped_ped`,`ped_sur`,`ped_neo`,
    `sur_sur`,`sur_lac`,`sur_ner`,`sur_nes`,`sur_dig`,`sur_car`,`sur_ven`,
    `ort_rhe`,`ort_cos`,`ort_ort`,`ort_reh`,`ort_pla`,
    `oph_oph`,`ent_ent`,`ent_to`,
    `so_sky`,`so_org`,
    `gyn_gyn`,`gyn_obs`,`gyn_gyne`,
    `psy_psy`,`psy_psyc`,
    `den_den`,`den_cav`,`den_ref`,`den_ped`,`alle`,`pat`,`checkup`,`rad`,`cli`,`ane`,`eme`, 
    
    `bed`,
    `bed_reh`,`bed_tre`,`bed_main`,`bed_care`,`bed_tra`,`bed_att`,
    `pt`,`ot`,`st` 
    
    FROM `main` WHERE `hos_cd` = :hos_cd; ";

    $stmt = $dbh->prepare($sql);
	$stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}
//櫻間20221102病院長・理事長なし

function intro($dbh,$hos_cd){
    $sql="
	SELECT intro.hos_cd, main.hos_name, intro.fie_name, intro.year, intro.intr FROM `main` JOIN intro on main.hos_cd = intro.hos_cd WHERE main.hos_cd = :hos_cd; 
	";
	$stmt = $dbh->prepare($sql);
	$stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

function invers_intro($dbh,$hos_cd){
    $sql="
	SELECT invers_intro.hos_cd, main.hos_name, invers_intro.fie_name, invers_intro.year, invers_intro.invr_intr FROM `main` JOIN invers_intro on main.hos_cd = invers_intro.hos_cd WHERE main.hos_cd = :hos_cd; 
	";
	$stmt = $dbh->prepare($sql);
	$stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

/* function contact($dbh,$hos_cd){
    $sql="SELECT contact.hos_cd, main.hos_name, contact.year, contact.date, contact.con_div, contact.bel, contact.cha, 
    null, #←contact_subcha
    contact.coo_cha, 
    contact.con_dit#, contact.con_etc 
    FROM `main` JOIN contact on main.hos_cd = contact.hos_cd WHERE main.hos_cd = :hos_cd ORDER BY `date` DESC LIMIT 3
    ";
	$stmt = $dbh->prepare($sql);
	$stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}
 */

/* ⭐後半DB 導入後要確認！！！！！！！！！
function contact($dbh,$hos_cd){
    $sql="SELECT contact.hos_cd, main.hos_name, contact.year, contact.date, contact.con_div, contact.bel, contact.cha, contact.subcha, contact.coo_cha, contact.con_dit, contact.con_etc FROM `main` JOIN contact on main.hos_cd = contact.hos_cd WHERE main.hos_cd = :hos_cd ORDER BY `date` DESC LIMIT 3
    ";
	$stmt = $dbh->prepare($sql);
	$stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}*/

function training($dbh,$hos_cd){
    $sql="
	SELECT training.hos_cd, main.hos_name, training.year,training.ins, training.dep, training.occ, training.name, training.start, training.end, training.date FROM `main` JOIN training on main.hos_cd = training.hos_cd WHERE main.hos_cd = :hos_cd; 
	";
	$stmt = $dbh->prepare($sql);
	$stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}


function h_list($dbh,$hos_cd){
    $sql="
	SELECT `hos_cd`,`hos_name`,`tel`,`zipcode`,`city`,`zone`,`town`,`str_num`,`note` FROM `main` WHERE `hos_cd` =:hos_cd; 
	";
	$stmt = $dbh->prepare($sql);
	$stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}


//---ここまでExcel関連


//20230102高橋 ユーザー検索
function user_select($dbh,$id){
    $sql = "SELECT * FROM user WHERE user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt -> bindValue(':user_id',$id,PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
return $data;
};



//医療機関新規登録
//入力した情報をDBに入れる
//櫻間20230317
//20231031櫻間
function insert_hos($dbh,$op_flg,$med_ass,$hos_div,$hos_cd,$hos_name,$zipcode,$ad,$tel,$fax,$mail,$are_cd,$pre,$area,$city,$zone,$town,$str_num,$note,$clo_day,$chi_name,$chi_spe,$chi_year,$chi_sch,$chi_note,$pre_name,$pre_spe,$pre_year,$pre_sch,$pre_note,$con_hour,$mon_am,$mon_pm,$tue_am,$tue_pm,$wed_am,$wed_pm,$thr_am,$thr_pm,$fri_am,$fri_pm,$sat_am,$sat_pm,$sun_am,$sun_pm,$holiday,$int_med,$ped_med,$sur_med,$ort_med,$oph_med,$ent_med,$so_med,$gyn_med,$psy_med,$den_med,$etc_med, $int_int,$int_dig,$int_uri,$int_tum,$int_res,$int_kid,$int_blo,$int_apo,$int_cir,$int_ner,$int_inf,$ped_ped,$ped_sur,$ped_neo,$sur_sur,$sur_lac,$sur_ner,$sur_nes,$sur_dig,$sur_car,$sur_ven,$ort_rhe,$ort_cos,$ort_ort,$ort_reh,$ort_pla,$oph_oph,$ent_ent,$ent_to,$so_sky,$so_org,$gyn_gyn,$gyn_obs,$gyn_gyne,$psy_psy,$psy_psyc,$den_den,$den_cav,$den_ref,$den_ped,$alle,$pat,$checkup,$rad,$cli,$ane,$eme,$bed,$bed_reh,$bed_tre,$bed_main,$bed_care,$bed_tra,$bed_att,$pt,$ot,$st,$onf,$dep_note,$num_note,$drct_note,$intr_note,$tra_note,$coop_note,$con_note,$log_data,$log_name){
    

    $sql = "INSERT INTO main(op_flg, med_ass, hos_div, hos_cd, hos_name, zipcode, ad, tel, fax, email, are_cd, pre, area, city, zone, town, str_num, note, clo_day, chi_name, chi_spe, chi_year, chi_sch, chi_note, pre_name, pre_spe, pre_year, pre_sch, pre_note, con_hour, mon_am, mon_pm, tue_am, tue_pm, wed_am, wed_pm, thr_am, thr_pm, fri_am, fri_pm, sat_am, sat_pm, sun_am, sun_pm, holiday, int_med, ped_med, sur_med, ort_med, oph_med, ent_med, so_med, gyn_med, psy_med, den_med, etc_med, int_int, int_dig, int_uri, int_tum, int_res, int_kid, int_blo, int_apo, int_cir, int_ner, int_inf, ped_ped, ped_sur, ped_neo, sur_sur, sur_lac, sur_ner, sur_nes, sur_dig, sur_car, sur_ven, ort_rhe, ort_cos, ort_ort, ort_reh, ort_pla, oph_oph, ent_ent, ent_to, so_sky, so_org, gyn_gyn, gyn_obs, gyn_gyne, psy_psy, psy_psyc, den_den, den_cav, den_ref, den_ped, alle, pat, checkup, rad, cli, ane, eme, bed, bed_reh, bed_tre, bed_main, bed_care, bed_tra, bed_att, pt, ot, st, onf,dep_note,num_note,drct_note,intr_note,tra_note,coop_note,con_note, log_data, log_name) VALUES (:op_flg, :med_ass, :hos_div, :hos_cd, :hos_name, :zipcode, :ad, :tel, :fax, :mail, :are_cd, :pre, :area, :city, :zone, :town, :str_num, :note, :clo_day, :chi_name, :chi_spe, :chi_year, :chi_sch, :chi_note, :pre_name, :pre_spe, :pre_year, :pre_sch, :pre_note, :con_hour, :mon_am, :mon_pm, :tue_am, :tue_pm, :wed_am, :wed_pm, :thr_am, :thr_pm, :fri_am, :fri_pm, :sat_am, :sat_pm, :sun_am, :sun_pm, :holiday, :int_med, :ped_med, :sur_med, :ort_med, :oph_med, :ent_med, :so_med, :gyn_med, :psy_med, :den_med, :etc_med, :int_int, :int_dig, :int_uri, :int_tum, :int_res, :int_kid, :int_blo, :int_apo, :int_cir, :int_ner, :int_inf, :ped_ped, :ped_sur, :ped_neo, :sur_sur, :sur_lac, :sur_ner, :sur_nes, :sur_dig, :sur_car, :sur_ven, :ort_rhe, :ort_cos, :ort_ort, :ort_reh, :ort_pla, :oph_oph, :ent_ent, :ent_to, :so_sky, :so_org, :gyn_gyn, :gyn_obs, :gyn_gyne, :psy_psy, :psy_psyc, :den_den, :den_cav, :den_ref, :den_ped, :alle, :pat, :checkup, :rad, :cli, :ane, :eme, :bed, :bed_reh, :bed_tre, :bed_main, :bed_care, :bed_tra, :bed_att, :pt, :ot, :st, :onf, :dep_note,:num_note,:drct_note,:intr_note,:tra_note,:coop_note,:con_note,:log_data, :log_name)";
    //echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':op_flg',$op_flg, PDO::PARAM_INT);
    $stmt->bindValue(':med_ass',$med_ass, PDO::PARAM_STR);
    $stmt->bindValue(':hos_div',$hos_div, PDO::PARAM_STR);
    $stmt->bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':hos_name',$hos_name, PDO::PARAM_STR);
    $stmt->bindValue(':zipcode',$zipcode, PDO::PARAM_STR);
    $stmt->bindValue(':ad',$ad, PDO::PARAM_STR);
    $stmt->bindValue(':tel',$tel, PDO::PARAM_STR);
    $stmt->bindValue(':fax',$fax, PDO::PARAM_STR);
    //櫻間20230317
    $stmt->bindValue(':mail',$mail, PDO::PARAM_STR);
    $stmt->bindValue(':are_cd',$are_cd, PDO::PARAM_INT);
    $stmt->bindValue(':pre',$pre, PDO::PARAM_STR);
    $stmt->bindValue(':area',$area, PDO::PARAM_STR);
    $stmt->bindValue(':city',$city, PDO::PARAM_STR);
    $stmt->bindValue(':zone',$zone, PDO::PARAM_STR);
    $stmt->bindValue(':town',$town, PDO::PARAM_STR);
    $stmt->bindValue(':str_num',$str_num, PDO::PARAM_STR);
    $stmt->bindValue(':note',$note, PDO::PARAM_STR);
    $stmt->bindValue(':clo_day',$clo_day, PDO::PARAM_STR);
    //病院長理事長
    $stmt->bindValue(':chi_name',$chi_name, PDO::PARAM_STR);
    $stmt->bindValue(':chi_spe',$chi_spe, PDO::PARAM_STR);
    $stmt->bindValue(':chi_year',$chi_year, PDO::PARAM_STR);
    $stmt->bindValue(':chi_sch',$chi_sch, PDO::PARAM_STR);
    $stmt->bindValue(':chi_note',$chi_note, PDO::PARAM_STR);
    $stmt->bindValue(':pre_name',$pre_name, PDO::PARAM_STR);
    $stmt->bindValue(':pre_spe',$pre_spe, PDO::PARAM_STR);
    $stmt->bindValue(':pre_year',$pre_year, PDO::PARAM_STR);
    $stmt->bindValue(':pre_sch',$pre_sch, PDO::PARAM_STR);
    $stmt->bindValue(':pre_note',$pre_note, PDO::PARAM_STR);
  
    $stmt->bindValue(':con_hour',$con_hour, PDO::PARAM_STR);
    $stmt->bindValue(':mon_am',$mon_am, PDO::PARAM_STR);
    $stmt->bindValue(':mon_pm',$mon_pm, PDO::PARAM_STR);
    $stmt->bindValue(':tue_am',$tue_am, PDO::PARAM_STR);
    $stmt->bindValue(':tue_pm',$tue_pm, PDO::PARAM_STR);
    $stmt->bindValue(':wed_am',$wed_am, PDO::PARAM_STR);
    $stmt->bindValue(':wed_pm',$wed_pm, PDO::PARAM_STR);
    $stmt->bindValue(':thr_am',$thr_am, PDO::PARAM_STR);
    $stmt->bindValue(':thr_pm',$thr_pm, PDO::PARAM_STR);
    $stmt->bindValue(':fri_am',$fri_am, PDO::PARAM_STR);
    $stmt->bindValue(':fri_pm',$fri_pm, PDO::PARAM_STR);
    $stmt->bindValue(':sat_am',$sat_am, PDO::PARAM_STR);
    $stmt->bindValue(':sat_pm',$sat_pm, PDO::PARAM_STR);
    $stmt->bindValue(':sun_am',$sun_am, PDO::PARAM_STR);
    $stmt->bindValue(':sun_pm',$sun_pm, PDO::PARAM_STR);
    $stmt->bindValue(':holiday',$holiday, PDO::PARAM_STR);
  
    $stmt->bindValue(':int_med',$int_med, PDO::PARAM_STR);
    $stmt->bindValue(':ped_med',$ped_med, PDO::PARAM_STR);
    $stmt->bindValue(':sur_med',$sur_med, PDO::PARAM_STR);
    $stmt->bindValue(':ort_med',$ort_med, PDO::PARAM_STR);
    $stmt->bindValue(':oph_med',$oph_med, PDO::PARAM_STR);
    $stmt->bindValue(':ent_med',$ent_med, PDO::PARAM_STR);
    $stmt->bindValue(':so_med',$so_med, PDO::PARAM_STR);
    $stmt->bindValue(':gyn_med',$gyn_med, PDO::PARAM_STR);
    $stmt->bindValue(':psy_med',$psy_med, PDO::PARAM_STR);
    $stmt->bindValue(':den_med',$den_med, PDO::PARAM_STR);
    $stmt->bindValue(':etc_med',$etc_med, PDO::PARAM_STR);
  
  
    $stmt->bindValue(':int_int',$int_int, PDO::PARAM_STR);
    $stmt->bindValue(':int_dig',$int_dig, PDO::PARAM_STR);
    $stmt->bindValue(':int_uri',$int_uri, PDO::PARAM_STR);
    $stmt->bindValue(':int_tum',$int_tum, PDO::PARAM_STR);
    $stmt->bindValue(':int_res',$int_res, PDO::PARAM_STR);
    $stmt->bindValue(':int_kid',$int_kid, PDO::PARAM_STR);
    $stmt->bindValue(':int_blo',$int_blo, PDO::PARAM_STR);
    $stmt->bindValue(':int_apo',$int_apo, PDO::PARAM_STR);
    $stmt->bindValue(':int_cir',$int_cir, PDO::PARAM_STR);
    $stmt->bindValue(':int_ner',$int_ner, PDO::PARAM_STR);
    $stmt->bindValue(':int_inf',$int_inf, PDO::PARAM_STR);
    $stmt->bindValue(':ped_ped',$ped_ped, PDO::PARAM_STR);
    $stmt->bindValue(':ped_sur',$ped_sur, PDO::PARAM_STR);
    $stmt->bindValue(':ped_neo',$ped_neo, PDO::PARAM_STR);
    $stmt->bindValue(':sur_sur',$sur_sur, PDO::PARAM_STR);
    $stmt->bindValue(':sur_lac',$sur_lac, PDO::PARAM_STR);
    $stmt->bindValue(':sur_ner',$sur_ner, PDO::PARAM_STR);
    $stmt->bindValue(':sur_nes',$sur_nes, PDO::PARAM_STR);
    $stmt->bindValue(':sur_dig',$sur_dig, PDO::PARAM_STR);
    $stmt->bindValue(':sur_car',$sur_car, PDO::PARAM_STR);
    $stmt->bindValue(':sur_ven',$sur_ven, PDO::PARAM_STR);
    $stmt->bindValue(':ort_rhe',$ort_rhe, PDO::PARAM_STR);
    $stmt->bindValue(':ort_cos',$ort_cos, PDO::PARAM_STR);
    $stmt->bindValue(':ort_ort',$ort_ort, PDO::PARAM_STR);
    $stmt->bindValue(':ort_reh',$ort_reh, PDO::PARAM_STR);
    $stmt->bindValue(':ort_pla',$ort_pla, PDO::PARAM_STR);
    $stmt->bindValue(':oph_oph',$oph_oph, PDO::PARAM_STR);
    $stmt->bindValue(':ent_ent',$ent_ent, PDO::PARAM_STR);
    $stmt->bindValue(':ent_to',$ent_to, PDO::PARAM_STR);
    $stmt->bindValue(':so_sky',$so_sky, PDO::PARAM_STR);
    $stmt->bindValue(':so_org',$so_org, PDO::PARAM_STR);
    $stmt->bindValue(':gyn_gyn',$gyn_gyn, PDO::PARAM_STR);
    $stmt->bindValue(':gyn_obs',$gyn_obs, PDO::PARAM_STR);
    $stmt->bindValue(':gyn_gyne',$gyn_gyne, PDO::PARAM_STR);
    $stmt->bindValue(':psy_psy',$psy_psy, PDO::PARAM_STR);
    $stmt->bindValue(':psy_psyc',$psy_psyc, PDO::PARAM_STR);
    $stmt->bindValue(':den_den',$den_den, PDO::PARAM_STR);
    $stmt->bindValue(':den_cav',$den_cav, PDO::PARAM_STR);
    $stmt->bindValue(':den_ref',$den_ref, PDO::PARAM_STR);
    $stmt->bindValue(':den_ped',$den_ped, PDO::PARAM_STR);
    $stmt->bindValue(':alle',$alle, PDO::PARAM_STR);
    $stmt->bindValue(':pat',$pat, PDO::PARAM_STR);
    $stmt->bindValue(':checkup',$checkup, PDO::PARAM_STR);
    $stmt->bindValue(':rad',$rad, PDO::PARAM_STR);
    $stmt->bindValue(':cli',$cli, PDO::PARAM_STR);
    $stmt->bindValue(':ane',$ane, PDO::PARAM_STR);
    $stmt->bindValue(':eme',$eme, PDO::PARAM_STR);
    $stmt->bindValue(':bed',$bed, PDO::PARAM_INT);
    $stmt->bindValue(':bed_reh',$bed_reh, PDO::PARAM_STR);
    $stmt->bindValue(':bed_tre',$bed_tre, PDO::PARAM_STR);
    $stmt->bindValue(':bed_main',$bed_main, PDO::PARAM_STR);
    $stmt->bindValue(':bed_care',$bed_care, PDO::PARAM_STR);
    $stmt->bindValue(':bed_tra',$bed_tra, PDO::PARAM_STR);
    $stmt->bindValue(':bed_att',$bed_att, PDO::PARAM_STR);
    $stmt->bindValue(':pt',$pt, PDO::PARAM_STR);
    $stmt->bindValue(':ot',$ot, PDO::PARAM_STR);
    $stmt->bindValue(':st',$st, PDO::PARAM_STR);

  
    $stmt->bindValue(':onf',$onf, PDO::PARAM_INT);
    $stmt->bindValue(':dep_note',$dep_note, PDO::PARAM_STR);
    $stmt->bindValue(':num_note',$num_note, PDO::PARAM_STR);
    $stmt->bindValue(':drct_note',$drct_note, PDO::PARAM_STR);


    //後半 備考
    $stmt->bindValue(':intr_note',$intr_note, PDO::PARAM_STR);
    $stmt->bindValue(':tra_note',$tra_note, PDO::PARAM_STR);
    $stmt->bindValue(':coop_note',$coop_note, PDO::PARAM_STR);
    $stmt->bindValue(':con_note',$con_note, PDO::PARAM_STR);

    $stmt->bindValue(':log_data',$log_data, PDO::PARAM_STR); 
    $stmt->bindValue(':log_name',$log_name, PDO::PARAM_STR);
    $stmt->execute();

}
//櫻間
//20231031櫻間
function update_null($dbh,$hos_cd){
    $sql="SELECT are_cd,onf,log_data,log_name FROM main WHERE hos_cd=:hos_cd ";
	$stmt = $dbh->prepare($sql);
	$stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

//嶋津20230105
//医療機関コード重複チェック
function hos_cd_check($dbh,$hos_cd) {
    $sql = "SELECT hos_cd FROM main WHERE hos_cd = :hos_cd LIMIT 1";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}



//新規ログ
//櫻間20230511
function log_new($dbh,$hos_cd,$hos_name,$insert_log,$user_name,$user_id,$ins,$bel,$adm_user){
    
    $sql = "INSERT `insert_log` (hos_cd,hos_name,log_data,user_name,user_id,ins,bel,adm_user) VALUES (:hos_cd,:hos_name,:insert_log,:user_name,:user_id,:ins,:bel,:adm_user)";
    //echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':hos_name',$hos_name, PDO::PARAM_STR);
    $stmt->bindValue(':insert_log',$insert_log, PDO::PARAM_STR);
    $stmt->bindValue(':user_name',$user_name, PDO::PARAM_STR);
    $stmt->bindValue(':user_id',$user_id, PDO::PARAM_STR);
    $stmt->bindValue(':ins',$ins, PDO::PARAM_STR);
    $stmt->bindValue(':bel',$bel, PDO::PARAM_STR);
    $stmt->bindValue(':adm_user',$adm_user, PDO::PARAM_STR);
    $stmt->execute();
  }   
//新規ログユーザ情報抜き出し
 function insert_userlog($dbh,$user_id){
    $sql = "SELECT user_id,user_name,ins,bel,adm_user FROM `user` where user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':user_id',$user_id, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
} 
//新規ログ表示
function get_log_insert($dbh){
    $sql = "SELECT * FROM `insert_log` ORDER BY log_data DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

//嶋津20230515
//削除ログ
function delete_log($dbh,$hos_cd,$hos_name,$delete_log,$user_name,$user_id,$ins,$bel,$adm_user){
    
    $sql = "INSERT `delete_log` (hos_cd,hos_name,log_data,user_name,user_id,ins,bel,adm_user) VALUES (:hos_cd,:hos_name,:delete_log,:user_name,:user_id,:ins,:bel,:adm_user)";
    //echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':hos_cd',$hos_cd, PDO::PARAM_STR);
    $stmt->bindValue(':hos_name',$hos_name, PDO::PARAM_STR);
    $stmt->bindValue(':delete_log',$delete_log, PDO::PARAM_STR);
    $stmt->bindValue(':user_name',$user_name, PDO::PARAM_STR);
    $stmt->bindValue(':user_id',$user_id, PDO::PARAM_STR);
    $stmt->bindValue(':ins',$ins, PDO::PARAM_STR);
    $stmt->bindValue(':bel',$bel, PDO::PARAM_STR);
    $stmt->bindValue(':adm_user',$adm_user, PDO::PARAM_STR);
    $stmt->execute();
  }   
 //削除ログユーザ情報抜き出し
 function delete_userlog($dbh,$user_id){
    $sql = "SELECT user_id,user_name,ins,bel,adm_user FROM `user` where user_id = :user_id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':user_id',$user_id, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}  
//削除ログ表示
function get_log_delete($dbh){
    $sql = "SELECT * FROM `delete_log` ORDER BY log_data DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

//櫻間20230801
//全件出力CSV
function all_list($dbh,$hos_cd){
    $sql="SELECT hos_cd,hos_name,hos_div,op_flg,clo_day,med_ass,zipcode,pre,area,are_cd,city,zone,town,str_num,tel,fax,email,note FROM main ";
	$stmt = $dbh->prepare($sql);
	$stmt->bindvalue(':hos_cd', $hos_cd, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}
//櫻間20230801


/* 三宅20231127　*/
//messageに使用
function get_message($dbh){
	$sql="SELECT * FROM message ORDER BY req_date DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

//三宅20231204 message追加（未完成）
function insert_message($dbh,$situation,$req_date,$comment,$req_fac,$req_dep,$view){


    $sql = "INSERT INTO message (situation, req_date, res_date, comment, req_fac, req_dep, view) VALUES (:situation, :req_date, '1010-10-10', :comment, :req_fac, :req_dep, :view)";

    $stmt = $dbh->prepare($sql);
    //var_dump($dbh->lastInsertId());

    $stmt->bindValue(':situation', $situation, PDO::PARAM_STR);
    $stmt->bindValue(':req_date', $req_date, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':req_fac', $req_fac, PDO::PARAM_STR);
    $stmt->bindValue(':req_dep', $req_dep, PDO::PARAM_STR);
    $stmt->bindValue(':view', $view, PDO::PARAM_INT);

    $stmt->execute();
}

/* function get_message_done($dbh){
	$sql="SELECT * FROM message WHERE situation = 11
     GROUP BY date,comment,req_fac, req_dep ORDER BY date DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
} */

//中尾20231225　message特定のデータ取得
function get_select_message($dbh,$id){

    $sql = "SELECT * FROM message WHERE id=:id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

//中尾20231225 message削除
function delete_message($dbh,$id){

    $sql = "DELETE FROM message WHERE id=:id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
}

//中尾20240116　message内容変更
function update_message($dbh,$id,$situation,$req_date,$res_date,$comment,$req_fac,$req_dep,$view,$version){

    $sql = "UPDATE message SET situation=:situation,req_date=:req_date,res_date=:res_date,comment=:comment,req_fac=:req_fac,req_dep=:req_dep,view=:view,version=:version WHERE id=:id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':situation', $situation, PDO::PARAM_INT);
    $stmt->bindValue(':req_date', $req_date, PDO::PARAM_STR);
    $stmt->bindValue(':res_date', $res_date, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':req_fac', $req_fac, PDO::PARAM_STR);
    $stmt->bindValue(':req_dep', $req_dep, PDO::PARAM_STR);
    $stmt->bindValue(':view', $view, PDO::PARAM_INT);
    $stmt->bindValue(':version', $version, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

//中尾20240123　message表示非表示
function view_update_message($dbh,$id,$view){

    $sql = "UPDATE message SET view=:view WHERE id=:id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':view', $view, PDO::PARAM_INT);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}


//大橋模索(対応済データ取得 ここだけres_date 20240416)
function check1($dbh){
    $sql = "SELECT * ,DATE_FORMAT(res_date,'%Y/%m/%d') as MMDD FROM message WHERE situation=11 and view=1 ORDER BY res_date desc";

    $stmt = $dbh->prepare($sql);
    
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

//(対応中データ取得 ここはreq_date 20240416)
function check2($dbh){
    $sql = "SELECT * ,DATE_FORMAT(req_date,'%Y/%m/%d') as MMDD FROM message WHERE situation=10 and view=1 order by req_date desc";

    $stmt = $dbh->prepare($sql);
    
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

//（未対応データ取得 ここはreq_date 20240416）
function check3($dbh){
    $sql = "SELECT * ,DATE_FORMAT(req_date,'%Y/%m/%d') as MMDD FROM message WHERE situation=0 and view=1 order by req_date desc";

    $stmt = $dbh->prepare($sql);
    
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

// 2024/11/07　加藤
// お問い合わせフォーム

// 依頼情報　データ取得(依頼者・管理者)
function get_request_data($dbh,$ins,$bel){
    $sql = "SELECT `q_a`.que_id , `q_a`.order_date , `q_a`.r_staff_num , r.user_name AS `name` , r.ins AS `hospital` , r.bel AS `division` , `q_a`.content , `q_a`.req_image , `q_a`.advisability , `q_a`.supp_status , `q_a`.a_staff_num , a.user_name AS `answerer` , `q_a`.answer , `q_a`.ans_image , `q_a`.ans_date , `q_a`.supp_date , `q_a`.emerg , `q_a`.trash_flg FROM `q_a` LEFT JOIN `user` AS r ON `q_a`.`r_staff_num` = r.`user_id` LEFT JOIN `user` AS a ON `q_a`.`a_staff_num` = a.`user_id` WHERE `q_a`.trash_flg = 0 ";
    $sql .= mb_strlen($ins) == 4 && mb_strlen($bel) == 4 ? "" : "and r.ins = :ins and r.bel = :bel";
    $sql .= " ORDER BY `emerg` DESC , `supp_status` ASC , `order_date` DESC";
    $stmt = $dbh->prepare($sql);
    if(mb_strlen($ins) !== 4){
        $stmt->bindParam(':ins', $ins);
        $stmt->bindParam(':bel', $bel);
    }
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

// 依頼者　入力データ保存
function insert_request_data($dbh, $emerg, $consultationText, $target_file, $con_image , $user_id)
{
    $image_sql = ["",""];
    if (isset($con_image)) {
        // 画像あり
        $image_sql[0] = " , `req_image` ";
        $image_sql[1] = " , :req_image ";
    }

    $sql = "INSERT INTO `q_a` (`emerg`, `content` , `r_staff_num` , `order_date` , `trash_flg` " . $image_sql[0] . ") VALUES (:emerg, :content , :user_id , CURDATE() , 0 " . $image_sql[1] . ") ";

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':user_id', $user_id , PDO::PARAM_INT);
    $stmt->bindParam(':emerg', $emerg, PDO::PARAM_INT);
    $stmt->bindParam(':content', $consultationText, PDO::PARAM_STR);
    if (isset($con_image)) {
        $stmt->bindParam(':req_image', $target_file, PDO::PARAM_STR);
    }
    $stmt->execute();
}

// 回答送信時 データ保存(管理者)
function update_rep_message($user_id,$que_id,$escaped_answer,$advisability,$supp_status,$db_adv,$history,$dbh){
   
    if(!isset($history)){

        // 新たに依頼する内容を登録する場合

        $sql = "UPDATE `q_a` SET `answer` = :answer , `ans_date` = CURDATE() , `a_staff_num` = :user_id ";
    
        if(mb_strlen($db_adv) == 1){
            // 可否判断がある場合
            if($supp_status == 3){
                // 現状維持（statusそのまま）
                $sql .= "WHERE `que_id` = :que_id;";
            }elseif($supp_status == 2){
                // 依頼対応済（status 1→2）
                $sql .= ", `supp_status` = 2 , `supp_date` = CURDATE() WHERE `que_id` = :que_id;";
            }else{
                // 依頼対応中（status 0→1）
                $sql .= ", `supp_status` = 1 WHERE `que_id` = :que_id;";
            }
            
        }else{
            // 可否判断がない場合
            $sql .= ", `advisability` = :advisability , `supp_status` = 0 WHERE `que_id` = :que_id;"; 
        }
    
    }else{
        // 既に依頼されていた内容を変更する場合
        $sql = "UPDATE `q_a` SET `content` = :answer , `order_date` = CURDATE() WHERE `que_id` = :que_id;";
    }

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':que_id', $que_id);
    $stmt->bindParam(':answer', $escaped_answer);
    if(!$history){
        $stmt->bindParam(':user_id', $user_id);
        if(mb_strlen($db_adv) !== 1){
            $stmt->bindParam(':advisability', $advisability);
        }
    }
    
    $stmt->execute();
    
}


//メンテデータ（全件取得）
function get_maintenance($dbh){

    $sql = "SELECT *,TIME_FORMAT(start_time,'%H:%i') as s_time,TIME_FORMAT(end_time,'%H:%i') as e_time FROM  maintenance  order by date" ;

    $stmt = $dbh->prepare($sql);

    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}



//データ取得
/* function get_select_maintenance($dbh,$id){

    $sql = "SELECT *,DATE_FORMAT(upload_date,'%Y/%m/%d') as upload_date, DATE_FORMAT(date,'%Y/%m/%d') as date,TIME_FORMAT(start_time,'%H:%i') as s_time,TIME_FORMAT(end_time,'%H:%i') as e_time FROM maintenance WHERE id=:id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
} */


//メンテ　データ追加
/* function insert_maintenance($dbh,$title,$upload_date,$date,$start_time,$end_time,$comment,$view){


    $sql = "INSERT INTO maintenance (title, upload_date,date, start_time, end_time, comment, view) VALUES (:title, :upload_date, :date, :start_time, :end_time, :comment, :view)";

    $stmt = $dbh->prepare($sql);
    //var_dump($dbh->lastInsertId());

    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':upload_date', $upload_date, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $stmt->bindValue(':end_time', $end_time, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':view', $view, PDO::PARAM_INT);
    $stmt->execute();
} */

//メンテ　表示非表示
/* function view_update_maintenance($dbh,$id,$view){

    $sql = "UPDATE maintenance SET view=:view WHERE id=:id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':view', $view, PDO::PARAM_INT);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
} */

//メンテ　データ削除
/* function delete_maintenance($dbh,$id){

    $sql = "DELETE FROM maintenance WHERE id=:id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $data = array();
} */

	
//メンテ　更新
function update_maintenance($dbh,$title,$upload_date,$date,$start_time,$end_time,$comment,$view){

    $sql = "UPDATE maintenance SET title=:title,upload_date=:upload_date,date=:date,start_time=:start_time,end_time=:end_time,comment=:comment,view=:view ";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':upload_date', $upload_date, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $stmt->bindValue(':end_time', $end_time, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':view', $view, PDO::PARAM_INT);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

//メンテ通知データ
function get_announce($dbh){

    $sql = "SELECT * ,DATE_FORMAT(upload_date,'%Y/%m/%d') as A, DATE_FORMAT(date,'%Y/%m/%d') as B,TIME_FORMAT(start_time,'%H:%i') as C,TIME_FORMAT(end_time,'%H:%i') as D FROM maintenance where view='1'";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

//20240617大橋

//メンテデータ（全件取得）
function get_maintenance_start($dbh){

    $sql = "SELECT *,TIME_FORMAT(start_time,'%H:%i') as s_time,TIME_FORMAT(end_time,'%H:%i') as e_time FROM  maintenance_start  order by date" ;

    $stmt = $dbh->prepare($sql);

    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

    return $data;
}


//メンテ開始　更新
function update_maintenance_start($dbh,$title,$comment,$date,$start_time,$end_time,$comment2,$view){

    $sql = "UPDATE maintenance_start SET title=:title,comment=:comment,date=:date,start_time=:start_time,end_time=:end_time,comment2=:comment2,view=:view ";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':start_time', $start_time, PDO::PARAM_STR);
    $stmt->bindValue(':end_time', $end_time, PDO::PARAM_STR);
    $stmt->bindValue(':comment2', $comment2, PDO::PARAM_STR);
    $stmt->bindValue(':view', $view, PDO::PARAM_INT);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

// 20240618_大橋_メンテ中画面関係
function get_start_announce($dbh){

    $sql = "SELECT * , DATE_FORMAT(date,'%Y/%m/%d') as A,TIME_FORMAT(start_time,'%H:%i') as B,TIME_FORMAT(end_time,'%H:%i') as C FROM maintenance_start where view='1'";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $data = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }

	return $data;
}

// 三宅20240813 バージョンの取得
function get_version($dbh) {
    $stmt = $dbh->prepare("SELECT version FROM message  WHERE situation=11 ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    return $stmt->fetchColumn();
}

// インポート機能
//　中尾20241111　年度取得（兼業）
function get_training_year($dbh){
    $sql ='SELECT year FROM training ORDER BY year DESC LIMIT 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

//　中尾20241111　年月取得（コンタクト履歴）
function get_contact_ym($dbh){
    $sql ='SELECT date FROM contact ORDER BY date DESC LIMIT 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

//　畑20250523　年月取得（紹介）
function get_intro_ym($dbh){
    $sql ='SELECT date FROM intro ORDER BY date DESC LIMIT 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

//　畑20250523　年月取得（逆紹介）
function get_inv_intro_ym($dbh){
    $sql ='SELECT date FROM invers_intro ORDER BY date DESC LIMIT 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// CSVファイル関連
function getCsvFolders() {
    return [
        'BK_contact'      => 'BK_contact',
        'BK_intro'        => 'BK_intro',
        'BK_invers_intro' => 'BK_invers_intro',
        'BK_training'     => 'BK_training',
    ];
}

// 指定ディレクトリ内のCSVファイル名一覧を返す
function getCsvFiles($dir) {
    $files = [];
    if (is_dir($dir)) {
        $csvFiles = glob($dir . '/*.csv');
        // 日付降順で並べ替え（新しい順）
        usort($csvFiles, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        // 最新5件のみ取得
        $csvFiles = array_slice($csvFiles, 1, 5);
        foreach ($csvFiles as $file) {
            $files[] = basename($file);
        }
    }
    return $files;
}

/**
 * ユーザーID/名前で検索
 */
function search_users($dbh, $keyword, $status = 'ALL') {
    $keyword = trim($keyword);
    
    if(empty($keyword)) {
        return get_users_by_status($dbh, $status);
    }
    
    // ステータスに応じたSQL条件
    $status_condition = '';
    if($status === 'Active') {
        $status_condition = " AND user.onf = '0'";
    } elseif($status === 'InActive') {
        $status_condition = " AND user.onf = '1'";
    }
    
    try {
        // IDまたは名前で検索
        $sql = "SELECT * FROM user 
                WHERE (user_id LIKE :keyword OR user_name LIKE :keyword)
                {$status_condition}
                ORDER BY user_id ASC";
        
        $stmt = $dbh->prepare($sql);
        $like_keyword = "%{$keyword}%";
        $stmt->bindValue(':keyword', $like_keyword, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error in search_users: " . $e->getMessage());
        return [];
    }
}

/**
 * ステータス別にユーザーを取得
 */
function get_users_by_status($dbh, $status = 'ALL') {
    try {
        if($status === 'Active' || $status === '0') {
            $sql = "SELECT * FROM user WHERE onf = '0' ORDER BY user_id ASC";
        } elseif($status === 'InActive' || $status === '1') {
            $sql = "SELECT * FROM user WHERE onf = '1' ORDER BY user_id ASC";
        } else {
            $sql = "SELECT * FROM user ORDER BY user_id ASC";
        }
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Error in get_users_by_status: " . $e->getMessage());
        return [];
    }
}


//  POST データをセッションに保存
 function savePostToSession(array $postData) {
    $_SESSION['insert'] = array_merge($_SESSION['insert'] ?? [], $postData);
}

// チェックボックスの値を取得
function getCheckboxValue($value) {
    return (isset($value) && ($value === 'on' || $value === '1')) ? '1' : '';
}

// 複数のチェックボックスから医療分類を判定
function getMedicalCategory(array $values) {
    return in_array('1', $values, true) ? '1' : '';
}

/**
 * =====================================================
 * ページネーション処理の汎用関数
 * =====================================================
 * 
 * 配列データをページごとに分割し、ページネーション情報を返す
 * 複数のコントローラから再利用可能
 * 
 * @param array $all_results 全データの配列
 * @param int $current_page 現在のページ番号（デフォルト：1）
 * @param int $per_page 1ページあたりの件数（デフォルト：12）
 * @return array ページネーション結果
 *         [
 *           'data' => ページ内のデータ配列,
 *           'count' => 現在のページのデータ件数,
 *           'total' => 全体のデータ件数,
 *           'current_page' => 現在のページ番号,
 *           'total_pages' => 総ページ数
 *         ]
 */
function paginate(array $all_results, int $current_page = 1, int $per_page = 12) {
    // ページ番号の検証（1未満の場合は1に修正）
    if ($current_page < 1) {
        $current_page = 1;
    }
    
    // 全体の件数を取得
    $total = count($all_results);
    
    // 総ページ数を計算
    $total_pages = ceil($total / $per_page);
    
    // 現在のページが総ページ数を超えている場合は最後のページに修正
    if ($current_page > $total_pages && $total_pages > 0) {
        $current_page = $total_pages;
    }
    
    // オフセット（開始位置）を計算
    $offset = ($current_page - 1) * $per_page;
    
    // ページ内のデータのみを取得
    $paged_data = array_slice($all_results, $offset, $per_page);
    
    return [
        'data' => $paged_data,
        'count' => count($paged_data),
        'total' => $total,
        'current_page' => $current_page,
        'total_pages' => $total_pages
    ];
}
