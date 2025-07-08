<?php
/* ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
 */
require_once('../functions.php');
include_once('xlsxwriter.class.php');

$filename = '../tmp/hospital_lists.xlsx';

/* header('Content-Description: File Transfer');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
//header("Content-Disposition: attachment; filename=" . basename($filename));
header("Content-Transfer-Encoding: binary");
header("Expires: 0");
header("Pragma: public");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Length: ' . filesize($filename));
 */
session_start();

if(empty($_SESSION['member'])){
  header('Location:'.SITE_URL.'index.php');
  exit();
}
//ユーザーの権限取得 1:管理者 2:一般（） 3:一般
$user_adm = $_SESSION['member']['adm_user'];

//見出しの設定

//訪問リスト
$header = array(
	'医療機関コード'=>'string',
	'医療機関名'=>'string',
	'電話番号'=>'string',
	'郵便番号'=>'string',
	'市'=>'string',
	'区'=>'string',
	'町'=>'string',
	'番地'=>'string',
	'備考'=>'string'
);

//詳細
if(($user_adm === '1') || ($user_adm === '2')  || ($user_adm === '3')){
	$header2 = array(
		'医療機関コード'=>'string',
		'病院区分'=>'string',
		'開院区分'=>'string',
		'閉院日'=>'string', 
		'医師会'=>'string',
		'医療機関名'=>'string',
		'郵便番号'=>'string',
		'県'=>'string',
		'市'=>'string',
		'区'=>'string',
		'町'=>'string',
		'番地'=>'string',
		'理事長・氏名'=>'string',
		'理事長・専門'=>'string',
		'理事長・卒年'=>'string',
		'理事長・出身校'=>'string',
		'理事長・備考'=>'string',
		'病院長・氏名'=>'string',
		'病院長・専門'=>'string',
		'病院長・卒年'=>'integer',
		'病院長・出身校'=>'string',
		'病院長・備考'=>'string',
		'親族情報'=>'string',
		'備考'=>'string',

		'診療時間'=>'string',
		'月AM'=>'string',
		'月PM'=>'string',
		'火AM'=>'string',
		'火PM'=>'string',
		'水AM'=>'string',
		'水PM'=>'string',
		'木AM'=>'string',
		'木PM'=>'string',
		'金AM'=>'string',
		'金PM'=>'string',
		'土AM'=>'string',
		'土PM'=>'string',
		'日AM'=>'string',
		'日PM'=>'string',
		'祝日'=>'string',

		"内科系"=>'string', 
		"小児科系"=>'string', 
		"外科系"=>'string', 
		"整形外科系"=>'string', 
		"眼科系"=>'string', 
		"耳鼻咽喉科系"=>'string', 
		"皮膚科・泌尿器科系"=>'string', 
		"産婦人科系"=>'string', 
		"精神科系"=>'string', 
		"歯科系"=>'string', 
		"その他"=>'string', 


        //内科系
		"内科系 - 内"=>'string', 
		"内科系 - 消内"=>'string', 
		"内科系 - 糖内"=>'string', 
		"内科系 - 腫瘍"=>'string', 
		"内科系 - 呼内"=>'string', 
		"内科系 - 腎内"=>'string', 
		"内科系 - 血内"=>'string', 
		"内科系 - 卒中"=>'string', 
		"内科系 - 循内"=>'string', 
		"内科系 - 神内"=>'string', 
		"内科系 - （感内）"=>'string',
        //小児科系
		"小児科系 - 児"=>'string', 
		"小児科系 - 児外"=>'string', 
		"小児科系 - 新生児"=>'string', 
        //外科系
		"外科系 - 外"=>'string', 
		"外科系 - 乳外"=>'string', 
		"外科系 - 脳外"=>'string', 
		"外科系 - 呼外"=>'string', 
		"外科系 - 消外"=>'string', 
		"外科系 - 心外"=>'string', 
		"外科系 - 肛外"=>'string', 
        //整形外科系
		"整形外科系 - （リウ）"=>'string', 
		"整形外科系 - 美容外"=>'string', 
		"整形外科系 - 整"=>'string', 
		"整形外科系 - リハ"=>'string', 
		"整形外科系 - 形成"=>'string',
        //眼科系
        "眼科系 - 眼"=>'string',
        //耳鼻咽喉科系
		"耳鼻咽喉科系 - 耳咽"=>'string', 
		"耳鼻咽喉科系 - 気管食道"=>'string',
        //皮膚科・泌尿器科系
		"皮膚科・泌尿器科系 - 皮"=>'string', 
		"皮膚科・泌尿器科系 - 泌"=>'string',
        //産婦人科系
		"産婦人科系 - 産婦"=>'string', 
		"産婦人科系 - 産"=>'string', 
		"産婦人科系 - 婦"=>'string',
        //精神科系
		"精神科系 - 精"=>'string', 
		"精神科系 - 心療内"=>'string',
        //歯科系
		"歯科系 - 歯科"=>'string', 
		"歯科系 - 歯科口外"=>'string', 
		"歯科系 - 矯正歯科"=>'string', 
		"歯科系 - 小児歯科"=>'string',
        //その他
		"その他 - アレルギー"=>'string', 
		"その他 - 病理"=>'string', 
		"その他 - 健診"=>'string', 
		"その他 - 放"=>'string', 
		"その他 - 臨床検査"=>'string', 
		"その他 - 麻"=>'string', 
		"その他 - 救急"=>'string', 

		"許可病床数"=>'integer', 

		"病棟種類 - 回復期リハビリテーション病棟"=>'string',
		"病棟種類 - 療養病棟"=>'string',
		"病棟種類 - 一般病棟"=>'string',
		"病棟種類 - 地域包括ケア病棟"=>'string',
		"病棟種類 - 障害者病棟"=>'string',
		"病棟種類 - 緩和ケア病棟"=>'string',

		"リハビリスタッフ - 理学療法士"=>'string', 
		"リハビリスタッフ - 作業療法士"=>'string', 
		"リハビリスタッフ - 言語聴覚士"=>'string'
	);
}else{
	$header2 = array(
		'医療機関コード'=>'string',
		'病院区分'=>'string',
		'開院区分'=>'string',
		'閉院日'=>'string', 
		'医師会'=>'string',
		'医療機関名'=>'string',
		'郵便番号'=>'string',
		'県'=>'string',
		'市'=>'string',
		'区'=>'string',
		'町'=>'string',
		'番地'=>'string',
		'備考'=>'string',

		'診療時間'=>'string',
		'月AM'=>'string',
		'月PM'=>'string',
		'火AM'=>'string',
		'火PM'=>'string',
		'水AM'=>'string',
		'水PM'=>'string',
		'木AM'=>'string',
		'木PM'=>'string',
		'金AM'=>'string',
		'金PM'=>'string',
		'土AM'=>'string',
		'土PM'=>'string',
		'日AM'=>'string',
		'日PM'=>'string',
		'祝日'=>'string',

		"内科系"=>'string', 
		"小児科系"=>'string', 
		"外科系"=>'string', 
		"整形外科系"=>'string', 
		"眼科系"=>'string', 
		"耳鼻咽喉科系"=>'string', 
		"皮膚科・泌尿器科系"=>'string', 
		"産婦人科系"=>'string', 
		"精神科系"=>'string', 
		"歯科系"=>'string', 
		"その他"=>'string', 


        //内科系
		"内科系 - 内"=>'string', 
		"内科系 - 消内"=>'string', 
		"内科系 - 糖内"=>'string', 
		"内科系 - 腫瘍"=>'string', 
		"内科系 - 呼内"=>'string', 
		"内科系 - 腎内"=>'string', 
		"内科系 - 血内"=>'string', 
		"内科系 - 卒中"=>'string', 
		"内科系 - 循内"=>'string', 
		"内科系 - 神内"=>'string', 
		"内科系 - （感内）"=>'string',
        //小児科系
		"小児科系 - 児"=>'string', 
		"小児科系 - 児外"=>'string', 
		"小児科系 - 新生児"=>'string', 
        //外科系
		"外科系 - 外"=>'string', 
		"外科系 - 乳外"=>'string', 
		"外科系 - 脳外"=>'string', 
		"外科系 - 呼外"=>'string', 
		"外科系 - 消外"=>'string', 
		"外科系 - 心外"=>'string', 
		"外科系 - 肛外"=>'string', 
        //整形外科系
		"整形外科系 - （リウ）"=>'string', 
		"整形外科系 - 美容外"=>'string', 
		"整形外科系 - 整"=>'string', 
		"整形外科系 - リハ"=>'string', 
		"整形外科系 - 形成"=>'string',
        //眼科系
        "眼科系 - 眼"=>'string',
        //耳鼻咽喉科系
		"耳鼻咽喉科系 - 耳咽"=>'string', 
		"耳鼻咽喉科系 - 気管食道"=>'string',
        //皮膚科・泌尿器科系
		"皮膚科・泌尿器科系 - 皮"=>'string', 
		"皮膚科・泌尿器科系 - 泌"=>'string',
        //産婦人科系
		"産婦人科系 - 産婦"=>'string', 
		"産婦人科系 - 産"=>'string', 
		"産婦人科系 - 婦"=>'string',
        //精神科系
		"精神科系 - 精"=>'string', 
		"精神科系 - 心療内"=>'string',
        //歯科系
		"歯科系 - 歯科"=>'string', 
		"歯科系 - 歯科口外"=>'string', 
		"歯科系 - 矯正歯科"=>'string', 
		"歯科系 - 小児歯科"=>'string',
        //その他
		"その他 - アレルギー"=>'string', 
		"その他 - 病理"=>'string', 
		"その他 - 健診"=>'string', 
		"その他 - 放"=>'string', 
		"その他 - 臨床検査"=>'string', 
		"その他 - 麻"=>'string', 
		"その他 - 救急"=>'string', 

		"許可病床数"=>'integer', 

		"病棟種類 - 回復期リハビリテーション病棟"=>'string',
		"病棟種類 - 療養病棟"=>'string',
		"病棟種類 - 一般病棟"=>'string',
		"病棟種類 - 地域包括ケア病棟"=>'string',
		"病棟種類 - 障害者病棟"=>'string',
		"病棟種類 - 緩和ケア病棟"=>'string',

		"リハビリスタッフ - 理学療法士"=>'string', 
		"リハビリスタッフ - 作業療法士"=>'string', 
		"リハビリスタッフ - 言語聴覚士"=>'string'
	);
}
//附属病院_紹介
$header3 = array(
	'医療機関コード'=>'string',
	'医療機関名'=>'string',
	'診療科名'=>'string',
	'年度'=>'integer',
	'件数'=>'integer'
);
//附属病院_逆紹介
$header4 = array(
	'医療機関コード'=>'string',
	'医療機関名'=>'string',
	'診療科名'=>'string',
	'年度'=>'integer',
	'件数'=>'integer'
);

//院外診療支援・研修
if(($user_adm === '1') || ($user_adm === '2') || ($user_adm === '3')){
	$header5 = array(
		'医療機関コード'=>'string',
		'医療機関名'=>'string',
		'年度'=>'integer',
		'所属'=>'string',
		'区分'=>'string',
		'診療科'=>'string',
		'職名'=>'string',
		'氏名'=>'string',
		'診療支援期間'=>'string',
		'診療支援日時'=>'string'
	);
}


/* //コンタクト履歴
$header7 = array(
	'医療機関コード'=>'string',
	'医療機関名'=>'string',
	'年度'=>'integer',
	'日付'=>'string',
	'区分'=>'string',
	'所属'=>'string',
	'担当者'=>'string',
	'同行者'=>'string',
	'先方対応者'=>'string',
	'内容'=>'string',
	'その他'=>'string',
); */







$writer = new XLSXWriter();

$dbh = get_db_connect();
$num = $_SESSION['books_num'];

//シートごとに見出し、データの書き出し
for ($i = 0; $i < $num; $i++) { 

	$hos_cd = $_SESSION['pagedata'][$i]['hos_cd'];
  
	//エクスポートデータの取得
	//エクスポートデータの取得
	//詳細
	if(($user_adm === '1') || ($user_adm === '2')  || ($user_adm === '3')){
		$excel = excel($dbh, $hos_cd);
	}else{
		$excel2 = excel2($dbh, $hos_cd);
	}
	//紹介
	$intro = intro($dbh, $hos_cd);
	//逆紹介
	$invers_intro = invers_intro($dbh, $hos_cd);
/* 	//コンタクト履歴
	$contact = contact($dbh, $hos_cd); */
	//院外支援
	if(($user_adm === '1')||($user_adm === '2')  || ($user_adm === '3')){
		$training = training($dbh, $hos_cd);
	}
	//訪問リスト
	$h_list = h_list($dbh, $hos_cd);

	//シートごとにエクスポート
	
	$writer->writeSheetHeader('訪問リスト', $header);
 	foreach($h_list as $row){
		$writer->writeSheetRow('訪問リスト', $row);
	} 

	$writer->writeSheetHeader('詳細リスト', $header2);
	if(($user_adm === '1')||($user_adm === '2')  || ($user_adm === '3')){
		foreach($excel as $row){
			foreach($row as $key => $var){
				if($var ==='1'){$row[$key]='○';}
			}
			if($row['bed']==='0'){$row['bed']='';} //高橋20230331追加 病床数0
			$writer->writeSheetRow('詳細リスト', $row);
		}
	}else{
		foreach($excel2 as $row){
			foreach($row as $key => $var){
				if($var ==='1'){$row[$key]='○';}
			}
			if($row['bed']==='0'){$row['bed']='';} //高橋20230331追加 病床数0
			$writer->writeSheetRow('詳細リスト', $row);
		}
	}

	$writer->writeSheetHeader('附属病院_紹介', $header3);
	foreach($intro as $row){
		$writer->writeSheetRow('附属病院_紹介', $row);
	}

	$writer->writeSheetHeader('附属病院_逆紹介', $header4);
	foreach($invers_intro as $row){
		$writer->writeSheetRow('附属病院_逆紹介', $row);
	}

	if(($user_adm === '1')||($user_adm === '2')  || ($user_adm === '3')){
		$writer->writeSheetHeader('院外支援・研修', $header5);
		foreach($training as $row){
			$writer->writeSheetRow('院外支援・研修', $row);
		}   
	}

	/* $writer->writeSheetHeader('連携状況', $header6);
 	foreach($conection as $row){
		$writer->writeSheetRow('連携状況', $row);
	} */
 
/* 	$writer->writeSheetHeader('コンタクト履歴', $header7);
	foreach($contact as $row){
		$writer->writeSheetRow('コンタクト履歴', $row);
	} */
 }

ob_end_clean(); //出力用バッファをクリア(消去)し、出力のバッファリングをオフにする
ob_start(); //出力のバッファリングを有効にする

//$writer->writeToStdOut();
$writer->writeToFile($filename);

header('Content-Description: File Transfer');
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename(basename($filename)).'"');
//header("Content-Disposition: attachment; filename=" . basename($filename));
header("Content-Transfer-Encoding: binary");
header("Expires: 0");
header("Pragma: public");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Length: ' . filesize($filename));

if(readfile($filename)) {
	unlink($filename);
}
exit;
