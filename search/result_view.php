
<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>検索結果一覧 | 医療機関情報システム</title>
<!--CSS/JS-->
<!-- *全画面必須 ---------->
  <!--UIkit3-->
  <link rel="stylesheet" href="../css/uikit.min.css" />
  <script src="../js/uikit.min.js"></script>
  <script src="../js/uikit-icons.min.js"></script>
  <link rel="stylesheet" href="../css/uk-custom.css">

  <!--style.css-->
  <link rel="stylesheet" href="../css/style.css"/>
  <link rel="stylesheet" href="../css/form_parts.css" />
  <link rel="stylesheet" href="../css/marker.css"/><!--:*marker CSS-->

  <!--*font awesome-->
  <link rel="stylesheet" href="../css/all.min.css" />
<!--------------------* -->
  <link rel="stylesheet" href="../css/cards.css"/><!--:*Card CSS-->
  <link rel="stylesheet" href="../css/tables.css"/><!--:*Table CSS-->
  <link rel="stylesheet" href="../css/print.css" media="print">
  <style>
  </style>
  <!--js-->
  <script src="../js/modal.js"></script>
</head>

<body>
<div class="not_print">
  <!-- **header -->
  <?php include_once("../header.php"); ?>
  <header uk-sticky>
    <!-- パンくず -->
      <ul class="uk-breadcrumb breadcrumb">
        <?php if($user_adm === '1'){ ?>
          <li><a href="../menu/MENU_control.php">MENU</a></li>
        <?php  } ?>
          <li><a href="checkbox_control.php">医療機関検索</a></li>
          <li><span>検索結果</span></li>
      </ul>
  </header>

  <!-- 高橋20221223
    **footer ページ下部固定 -->
  <footer uk-sticky="position: bottom">
    <div class="uk-flex uk-flex-right">
    </div>
    <?php include_once("../footer.php"); ?>
  </footer>
  
</div>

  <!--**main-->
  <main>
    <!--*main_header-->
    <div class="uk-margin-bottom uk-container uk-width-5-6@m">
        <h2 class="uk-card-header">検索結果</h2>
    </div>



  <!-- 検索条件 -->
  <div class="not_print">
  <div class="uk-container uk-width-4-5@m uk-card-small">
        <ul class="accordion" uk-accordion>
        <li>
          <a class="uk-accordion-title" href="#">検索条件</a>
            <div class="uk-accordion-content">
              <ul class="uk-list uk-list-square">
                <!-- 地域 -->
                  <li>
                    <span>地域</span>
                    <?php
                      if(($nantoua !=='')||($nanseia !=='')||($takahashiniimia !=='')||($maniwaa !=='')||($tuyamaaidaa !=='')||($takena !=='')||($area !=='')||($zip !=='')){
                    ?>
                    <div>
                      <?php 
                        echo html_escape($nantoua);
                        if($nantoua !==''){ echo '<br>'; }
                        echo html_escape($nanseia);
                        if($nanseia !==''){ echo '<br>'; }
                        echo html_escape($takahashiniimia);
                        if($takahashiniimia !==''){ echo '<br>'; }
                        echo html_escape($maniwaa);
                        if($maniwaa !==''){ echo '<br>'; }
                        echo html_escape($tuyamaaidaa);
                        if($tuyamaaidaa !==''){ echo '<br>'; }
                        echo html_escape($takena);
                        if($takena !==''){ echo '<br>'; }
                      ?>
                      <ul class="uk-list uk-list-square">
                        <li>
                          <span class="h6">地域検索 ： </span>
                          <?php if($area !==''){ echo html_escape($area);}else{ echo '指定なし'; } ?>
                        </li>
                        <li>
                          <span class="h6">郵便番号 ： </span>
                          <?php if($zip !==''){ echo '〒'. html_escape($zip); }else{ echo'指定なし'; } ?>
                        </li>
                      </ul>
                    </div>
                    <?php }else{ ?>
                    … 指定なし
                    <?php } ?>   
                  </li>
                <!-- 診療科 -->
                  <li>
                    <span>診療科</span>
                    <?php if(($naikaa !=='')||($syounikaa !=='')||($gekaa !=='')||($seikeia !=='')||($gankaa !=='')||($zibiinkoua !=='')||($hifukaa !=='')||($sanfuzina !=='')||($seisina !=='')||($sikaa !=='')||($sonotaa !=='')){ ?>
                    <div>
                    <?php 
                    echo html_escape($naikaa);
                    if($naikaa !==''){ echo '<br>'; }
                    echo html_escape($syounikaa);
                    if($syounikaa !==''){ echo '<br>'; }
                    echo html_escape($gekaa);
                    if($gekaa !==''){ echo '<br>'; }
                    echo html_escape($seikeia);
                    if($seikeia !==''){ echo '<br>'; }
                    echo html_escape($gankaa);
                    if($gankaa !==''){ echo '<br>'; }
                    echo html_escape($zibiinkoua);
                    if($zibiinkoua !==''){ echo '<br>'; }
                    echo html_escape($hifukaa);
                    if($hifukaa !==''){ echo '<br>'; }
                    echo html_escape($sanfuzina);
                    if($sanfuzina !==''){ echo '<br>'; }
                    echo html_escape($seisina);
                    if($seisina !==''){ echo '<br>'; }
                    echo html_escape($sikaa);
                    if($sikaa !==''){ echo '<br>'; }
                    echo html_escape($sonotaa);
                    ?>
                    </div>
                    <?php }else{ ?>
                    … 指定なし
                    <?php } ?>
                  </li>
                <!-- 診療日 -->
                  <li>
                    <span>診療日</span>
                    <?php
                    if($week !==''){
                    if($weeka !==''){
                    ?>
                    <div>
                    <?php 
                    echo html_escape($weeka);
                    ?>
                    </div>
                    <?php 
                    }else{
                    ?>
                    … 指定なし
                    <?php 
                    }

                    }else{
                    ?>
                    … 指定なし
                    <?php 
                    }
                    ?>
                  </li>
                 <!-- 紹介・逆紹介 -->
                <!-- 櫻間20230616から -->
                <li>
                    <span>紹介・逆紹介 … </span>
                    <?php if(($year ==='')&&($intro === '')&&($r_intro ==='')&&($okakura ==='')) { ?>
                            指定なし
                    <?php }else{ ?>
                      <?php if($year ===''){ echo '年度なし'; }else{ echo $year.'年度'; } ?>&nbsp;
                      <?php if($intro ===''){ echo '紹介なし'; }elseif($intro ==='1'){ echo '紹介あり'; }?>&nbsp;
                      <?php if($r_intro ===''){ echo '逆紹介なし'; }elseif($r_intro ==='1'){ echo '逆紹介あり'; } ?>&nbsp;
                      <?php if($kura ===''){ echo '附属病院なし'; }elseif($kura ==='1'){ echo '附属病院あり'; } ?>&nbsp;
                      <?php if($oka ===''){ echo '総合医療センターなし'; }elseif($oka ==='1'){ echo '総合医療センターあり'; } ?>
                    <?php } ?>
                    <!-- 櫻間20230616まで -->
                  </li>
                <!-- 医療機関名 -->
                  <li>
                    <span>医療機関名 … </span>
                    <?php if($hos_name !== ''){ ?>
                      『 <?php echo html_escape($hos_name); ?> 』を含む
                    <?php }else{ ?>
                      指定なし
                    <?php } ?>
                  </li>
                <!-- 区分 -->
                  <li>
                    <span>区分</span>
                    <ul class="uk-list uk-list-square">
                      <li>
                        <span class="h6"><i class=""></i> 病院区分 ： </span>
                        <?php 
                        if($hos_div !==''){
                          if($hos_diva !==''){
                            echo html_escape($hos_diva); 
                          }else{
                            echo '指定なし';
                          }
                        }else{
                            echo '指定なし';
                        }
                        ?>
                      </li>
                      <li>
                        <span class="h6"><i class=""></i> 開院区分 ： </span>
                        <?php
                        if(!empty($conditiona)){
                          if($a === '1'){
                            echo '開院';
                          }elseif($a === '0'){
                            echo '閉院';   
                          }
                        }else{
                          echo '指定なし';
                        }                        
                        ?>
                      </li>
                      <li>
                        <span class="h6"><i class=""></i> 病棟種類 ： </span>
                        <?php 
                        if($bed !==''){
                          if($beda !==''){
                            echo html_escape($beda);
                          }else{
                            echo '指定なし';
                          }
                        }else{
                          echo '指定なし';
                        }
                        ?>
                      </li>
                    </ul>
                  </li>
                <!-- 医師会 -->
                  <li>
                    <span>医師会</span>
                    <?php 
                    //櫻間
                    if(($nantoua1 !=='')||($nanseia1 !=='')||($takahashia !=='')||($maniwaa1 !=='')||($tuyamaa !=='')){
                    ?>
                    <div>
                      <?php
                      echo html_escape($nantoua1);
                      if($nantoua1 !==''){ echo '<br>'; }
                      echo html_escape($nanseia1);
                      if($nanseia1 !==''){ echo '<br>'; }
                      echo html_escape($takahashia);
                      if($takahashia !==''){ echo '<br>'; }
                      echo html_escape($maniwaa1);
                      if($maniwaa1 !==''){ echo '<br>'; }
                      echo html_escape($tuyamaa);
                      ?>
                    </div>
                    <?php
                    }else{
                    ?>
                    … 指定なし
                    <?php 
                    }
                    ?>
                  </li>
                <!-- 理事長・病院長出身校 -->
                  <li>
                    <span>理事長・病院長出身校</span>
                    <?php //櫻間20230311
                      if(($college !== '')&&($entryPlan=='hoge3')){ ?>
                        　理事長・病院長出身校：
                        <?php echo html_escape($college); ?>
                      <?php }elseif(($chi !== '')&&($entryPlan=='hoge1')){ ?>
                        　理事長出身校：
                        <?php echo html_escape($chi); ?>
                      <?php }elseif(($pre !== '')&&($entryPlan=='hoge2')){ ?>
                        　病院長出身校：
                        <?php echo html_escape($pre); ?>
                      <?php }else{ ?>
                         … 指定なし
                      <?php 
                      }
                      //櫻間20230311 ?>
                  </li>
              </ul>
            </div>
          </li>
        </ul>
  </div>
  </div>

<!--*
    ◎ 検索結果あり
*-->
<?php //大井 ?>
  <?php
require_once('../config.php');

if(!empty($data)){
$datae = '';
?>

<?php 
//値に応じて表示する数を変える　大井
if(isset($_POST['display'])){
  if($display === '20'){
    define('MAX','20');
  }elseif($display === '50'){
    define('MAX','50');
  }elseif($display === '100'){
    define('MAX','100');
  }elseif($display === '200'){
    define('MAX','200');
  }elseif($display === '500'){
    define('MAX','500');
  }elseif($display === '全件'){
    define('MAX', $books_num);
  } 
}elseif($_SESSION['display'] === '20'){
  define('MAX','20'); // 1ページの記事の表示数
}elseif($_SESSION['display'] === '50'){
  define('MAX','50'); // 1ページの記事の表示数
}elseif($_SESSION['display'] === '100'){
  define('MAX','100'); // 1ページの記事の表示数
}elseif($_SESSION['display'] === '200'){
  define('MAX','200'); // 1ページの記事の表示数
}elseif($_SESSION['display'] === '500'){
  define('MAX','500'); // 1ページの記事の表示数
}elseif($_SESSION['display'] === '全件'){
  define('MAX', $books_num); // 1ページの記事の表示数
}else{
  define('MAX','20'); // 1ページの記事の表示数
}
//大井

$books_num = count($data); // トータルデータ件数
$_SESSION['books_num'] = $books_num;

$max_page = ceil($books_num / MAX); // トータルページ数※ceilは小数点を切り捨てる関数


$url = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');


//高橋20230529追記 ここから----------
if (isset($_POST['kakutei'])) {
  $now = 1; //高橋20230529：検索ボタンクリック時
}elseif(isset($_POST['detail'])){
  $now = $_POST['detail']; //高橋20230529：検索結果に戻るボタンクリック時（管理者）
}elseif(isset($_GET['page_id'])){
  $now = $_GET['page_id']; //高橋20230529：ページ番号変更時・検索結果に戻るボタンクリック時（一般）
}elseif(isset($_POST['display'])){
  $now = 1; //高橋20230529：表示件数変更時
}else{
	$now = 1;
}
//高橋20230529追記 ----------ここまで一式修正済



$start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか
//高橋20230329追記　$_SESSION['detail_return'] = "";
// array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
$disp_data = array_slice($data, $start_no, MAX, true);
?>

<div class="not_print uk-margin-medium-top uk-margin-small-bottom">
<div class=" uk-flex uk-flex-around">
  <form class="uk-form" name="display" action="search_control.php" method="POST">
    <!--件数表示変更-->
    <select id="Select1" name="display" class="uk-select uk-form-width-xsmall uk-form-small" style="background-color:white;">
      <option value="20" <?php if($display === '20'){?> selected <?php } ?>>20</option>
      <option value="50" <?php if($display === '50'){?> selected <?php } ?>>50</option>
      <option value="100" <?php if($display === '100'){?> selected <?php } ?>>100</option>
      <option value="200" <?php if($display === '200'){?> selected <?php } ?>>200</option>
      <option value="500" <?php if($display === '500'){?> selected <?php } ?>>500</option>
      <option value="全件" <?php if($display === '全件'){?> selected <?php } ?>>全件</option>
    </select>
    <input type="submit" value="変更" class="uk-button uk-button-secondary uk-button-small">
  </form>

    <div>
    <!--印刷-->
      <button name="print" onClick="javascript:window.print()" class="uk-button  uk-button-primary"><span uk-icon="print"></span><span class="uk-visible@s"> 印刷</span></button>
    <!--Excel-->
      <button onclick="location.href='excel.php'" class="uk-button uk-button-primary"><span uk-icon="download"></span><span class="uk-visible@s"> Excel</span></button>
      <!--button onclick="location.href='07.php'" class="uk-button uk-button-primary"><span uk-icon="download"></span><span class="uk-visible@s"> Excel</span></button-->
   </div>
</div>
</div>

<div class="uk-margin-bottom">
	<div class="uk-pagination uk-flex  uk-flex-center">
	<!--ページネーション　大井-->
	全<?php echo $books_num; ?>件　
<?php
	if($now > 1){ // リンクをつけるかの判定
?>
		<a href="<?php SITE_URL ?>search_control.php?page_id=<?php echo ($now - 1);?>">&lt;&nbsp;</a>
<?php
	} else {
?>
		&lt;&nbsp;
<?php 
	}
	for($i = 1; $i <= $max_page; $i++){ // 最大ページ数分リンクを作成
		if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
?>
			&nbsp;<?php echo $now;?>&nbsp; 
<?php 
		} else {
?>
		<a href="<?php SITE_URL ?>search_control.php?page_id=<?php echo $i;?>">&nbsp;<?php echo $i;?>&nbsp;</a>  
<?php
		}
	}
	if($now < $max_page){ // リンクをつけるかの判定
?>
		<a href="<?php SITE_URL ?>search_control.php?page_id=<?php echo ($now + 1);?>">&nbsp;&gt;</a>
<?php
	} else {
?>
		&nbsp;&gt;
<?php 
	}
?>
	</div>
</div>



<?php 
foreach($disp_data as $var){ // データ表示 
//櫻間20221101
  if($datae !== $var['hos_cd']){
  //櫻間20221101

?>

  
<!--**Cards----->        
  <div class="uk-margin-bottom uk-container uk-container-center uk-card-small uk-card-default uk-width-4-5@m">
    <!--uk-scrollspy="cls:uk-animation-fade" 廃止、印刷時全件表示されない-->
  <h3>
    <a href="../detail/detail_control.php?cd=<?php echo html_escape ($var['hos_cd']); ?>&page_id=<?php echo $now; ?>" class="link" style="text-decoration:none;"><?php //高橋20230329追記 GETでpageid送る ?>
      <span class="uk-icon-button" uk-icon="chevron-double-right"></span>
      <b><?php echo html_escape ($var['hos_name']);?></b>
    </a>
  </h3>

  <div uk-grid>
    <div class="uk-width-1-5"><!--医療機関 基本情報-->
      <h4><span uk-icon="triangle-right"> </span>基本情報</h4>
        <ul class="uk-list uk-margin-remove">
          <li>
            <?php echo html_escape ($var['hos_div']);?>
          ／
            <?php 
            if(($var['op_flg'])=== '1'){
              echo '開院';
            }else{
              echo '閉院';   
            }
            ?>
          </li>
          <li>
          <div>〒 <?php if($var['zipcode']!=='0'){echo html_escape ($var['zipcode']); }?></div>
          <!--櫻間20221117-->
          <div><?php echo html_escape ($var['pre']);?><?php echo html_escape ($var['ad']);?></div>
          <div>TEL：<?php echo html_escape ($var['tel']);?></div>
          <div>FAX：<?php echo html_escape ($var['fax']);?></div>
        <!--櫻間20230317-->
           <div>MAIL：<?php echo html_escape ($var['email']);?></div>
          </li>
        </ul>
    </div>

    <div class="uk-width-1-3">
		<h4><span uk-icon="triangle-right"> </span>診療日・手術日・診療時間</h4>
			<table class="uk-table-small tbl-border">

	<?php
	$d =array();//診療日
	//データがない
	//櫻間20221103
	if(($var['mon_am'] !== '●')&&($var['mon_pm'] !== '●')&&($var['tue_am'] !== '●')&&($var['tue_pm'] !== '●')&&($var['wed_am'] !== '●')&&($var['wed_pm'] !== '●')&&($var['thr_am'] !== '●')&&($var['thr_pm'] !== '●')&&($var['fri_am'] !== '●')&&($var['fri_pm'] !== '●')&&($var['sat_am'] !== '●')&&($var['sat_pm'] !== '●')&&($var['sun_am'] !== '●')&&($var['sun_am'] !== '●')&&($var['sun_pm'] !== '●')&&($var['holiday'] !== '●')&&($var['mon_am'] !== '★')&&($var['mon_pm'] !== '★')&&($var['tue_am'] !== '★')&&($var['tue_pm'] !== '★')&&($var['wed_am'] !== '★')&&($var['wed_pm'] !== '★')&&($var['thr_am'] !== '★')&&($var['thr_pm'] !== '★')&&($var['fri_am'] !== '★')&&($var['fri_pm'] !== '★')&&($var['sat_am'] !== '★')&&($var['sat_pm'] !== '★')&&($var['sun_am'] !== '★')&&($var['sun_am'] !== '★')&&($var['sun_pm'] !== '★')&&($var['holiday'] !== '★')){
		//櫻間20221103
	//$d[] = 'データなし'; //全部×のテーブルに
	?>
		<tr>
			<th></th>
			<th>月</th>
			<th>火</th>
			<th>水</th>
			<th>木</th>
			<th>金</th>
			<th>土</th>
			<th>日</th>
			<th>祝日</th>
		</tr>
		<tr>
			<th>AM</th>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td rowspan="2">-</td>
		</tr>
		<tr>
			<th>PM</th>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
		</tr>
	<?php
	
	}else{
	?>

			<tr>
				<th></th>
				<th>月</th>
				<th>火</th>
				<th>水</th>
				<th>木</th>
				<th>金</th>
				<th>土</th>
				<th>日</th>
				<th>祝日</th>
			</tr>
			<tr>
				<th>AM</th>
				<td> <?php if($var['mon_am'] == '●'){ echo '○'; }elseif($var['mon_am'] == '★'){echo '★';}else{ echo '×';} ?></td><!--月AM-->
				<td><?php if($var['tue_am'] == '●'){ echo '○'; }elseif($var['tue_am'] == '★'){echo '★';}else{ echo '×';} ?></td><!--火AM-->
				<td><?php if($var['wed_am'] == '●'){ echo '○'; }elseif($var['wed_am'] == '★'){echo '★';}else{ echo '×';} ?></td><!-- 水AM-->
				<td><?php if($var['thr_am'] == '●'){ echo '○'; }elseif($var['thr_am'] == '★'){echo '★';}else{ echo '×';} ?></td><!-- 木AM-->
				<td><?php if($var['fri_am'] == '●'){ echo '○'; }elseif($var['fri_am'] == '★'){echo '★';}else{ echo '×';} ?></td><!-- 金AM-->
				<td><?php if($var['sat_am'] == '●'){ echo '○'; }elseif($var['sat_am'] == '★'){echo '★';}else{ echo '×';} ?></td><!--高橋、櫻間 土AM-->
				<td><?php if($var['sun_am'] == '●'){ echo '○'; }elseif($var['sun_am'] == '★'){echo '★';}else{ echo '×';} ?></td><!--高橋、櫻間 日AM-->
				<td rowspan="2"><?php if($var['holiday'] == '●'){ echo '○'; }elseif($var['holiday'] == '★'){echo '★';}else{ echo '×';} ?></td><!--高橋櫻間 祝日--><!--櫻間-->
			</tr>
			<tr>
				<th>PM</th>
				<td><?php if($var['mon_pm'] == '●'){ echo '○'; }elseif($var['mon_am'] == '★'){echo '★';}else{ echo '×';} ?></td>
				<td><?php if($var['tue_pm'] == '●'){ echo '○'; }elseif($var['tue_pm'] == '★'){echo '★';}else{ echo '×';} ?></td>
				<td><?php if($var['wed_pm'] == '●'){ echo '○'; }elseif($var['wed_pm'] == '★'){echo '★';}else{ echo '×';} ?></td>
				<td><?php if($var['thr_pm'] == '●'){ echo '○'; }elseif($var['thr_pm'] == '★'){echo '★';}else{ echo '×';} ?></td>
				<td><?php if($var['fri_pm'] == '●'){ echo '○'; }elseif($var['fri_pm'] == '★'){echo '★';}else{ echo '×';} ?></td>
				<td><?php if($var['sat_pm'] == '●'){ echo '○'; }elseif($var['sat_pm'] == '★'){echo '★';}else{ echo '×';} ?></td>
				<td><?php if($var['sun_pm'] == '●'){ echo '○'; }elseif($var['sun_pm'] == '★'){echo '★';}else{ echo '×';} ?></td>
			</tr>
	<?php
			}
			?>
		</table>
        <div>
			<span uk-icon="clock"></span> 
			<?php if($var['con_hour'] !== ''){ echo html_escape ($var['con_hour']); }else{ echo'情報なし'; } ?>
        </div>
</div>


    <div class="uk-width-1-5">
		<h4><span uk-icon="triangle-right"> </span>診療科</h4>

	<?php
		$a =array();//内科系
		$b =array();//小児科系
		$c =array();//外科系
		$d =array();//整形外科系
		$e =array();//眼科系
		$f =array();//耳鼻咽喉科系
		$g =array();//皮膚科・泌尿器科系
		$h =array();//産婦人科系
		$i =array();//精神科系
		$j =array();//歯科系
		$k =array();//その他

 
/* 略称未使用
  if($var['int_int'] === '1'){
    $a[] = '内科';
  }
  if($var['int_res'] === '1'){
    $a[] = '呼吸器内科';
  }
  if($var['int_cir'] === '1'){
    $a[] = '循環器内科';
  }
  if($var['int_dig'] === '1'){
    $a[] = '消化器内科';
  }
  if($var['int_kid'] === '1'){
    $a[] = '腎臓内科';
  }
  if($var['int_ner'] === '1'){
    $a[] = '神経内科';
  }
  if($var['int_uri'] === '1'){
    $a[] = '糖尿病内科(代謝内科)';
  }
  if($var['int_blo'] === '1'){
    $a[] = '血液内科';
  }
  if($var['int_inf'] === '1'){
    $a[] = '感染症内科';
  }
  if($var['int_tum'] === '1'){
    $a[] = '臨床腫瘍科';
  }
  if($var['int_apo'] === '1'){
    $a[] = '脳卒中科';  
  }
  if($var['ped_ped'] === '1'){
    $b[] = '小児科';
  }
  if($var['ped_sur'] === '1'){
    $b[] = '小児外科';
  }
  if($var['ped_neo'] === '1'){
    $b[] = '新生児科';
  }
  if($var['sur_sur'] === '1'){
    $c[] = '外科';
  }
  if($var['sur_nes'] === '1'){
    $c[] = '呼吸器外科';
  }
  if($var['sur_car'] === '1'){
    $c[] = '循環器外科(心臓･血管外科)';
  }
  if($var['sur_lac'] === '1'){
    $c[] = '乳腺外科';
  }
  if($var['sur_dig'] === '1'){
    $c[] = '消化器外科';
  }
  if($var['sur_ven'] === '1'){
    $c[] = '肛門外科';
  }
  if($var['sur_ner'] === '1'){
    $c[] = '脳神経外科';
  }
  if($var['ort_rhe'] === '1'){
    $d[] = 'リウマチ科';
  }
  if($var['ort_ort'] === '1'){
    $d[] = '整形外科';
  }
  if($var['ort_pla'] === '1'){
    $d[] = '形成外科';
  }
  if($var['ort_cos'] === '1'){
    $d[] = '美容外科';
  }
  if($var['ort_reh'] === '1'){
    $d[] = 'リハビリテーション';
  }
  if($var['oph_oph'] === '1'){
    $e[] = '眼科';
  }
  if($var['ent_ent'] === '1'){
    $f[] = '耳鼻いんこう科';
  }
  if($var['ent_to'] === '1'){
    $f[] = '気管食道科';
  }
  if($var['so_sky'] === '1'){
    $g[] = '皮膚科';
  }
  if($var['so_org'] === '1'){
    $g[] = '泌尿器科';
  }
  if($var['gyn_gyn'] === '1'){
    $h[] = '産婦人科';
  }
  if($var['gyn_obs'] === '1'){
    $h[] = '産科';
  }
  if($var['gyn_gyne'] === '1'){
    $h[] = '婦人科';
  }
  if($var['psy_psy'] === '1'){
    $i[] = '精神科';
  }
  if($var['psy_psyc'] === '1'){
    $i[] = '心療内科';
  }
  if($var['den_den'] === '1'){
    $j[] = '歯科';
  }
  if($var['den_ref'] === '1'){
    $j[] = '矯正歯科';
  }
  if($var['den_ped'] === '1'){
    $j[] = '小児歯科';
  }
  if($var['den_cav'] === '1'){
    $j[] = '歯科口腔外科';
  }
  if($var['alle'] === '1'){
    $k[] = 'アレルギー科';
  }
  if($var['rad'] === '1'){
    $k[] = '放射線科';
  }
  if($var['ane'] === '1'){
    $k[] = '麻酔科';
  }
  if($var['pat'] === '1'){
    $k[] = '病理診断科';
  }
  if($var['cli'] === '1'){
    $k[] = '臨床検査科';
  }
  if($var['eme'] === '1'){
    $k[] = '救急科';
  }
  if($var['checkup'] === '1'){
    $k[] = '健康診断';
  }
*/

//
  if($var['int_int'] === '1'){
	$a[] = '内';
  }
  if($var['int_res'] === '1'){
    $a[] = '呼内';
  }
  if($var['int_cir'] === '1'){
    $a[] = '循内';
  }
  if($var['int_dig'] === '1'){
    $a[] = '消内';
  }
  if($var['int_kid'] === '1'){
    $a[] = '腎内';
  }
  if($var['int_ner'] === '1'){
    $a[] = '神内';
  }
  if($var['int_uri'] === '1'){
    $a[] = '糖内';
  }
  if($var['int_blo'] === '1'){
    $a[] = '血内';
  }
  if($var['int_inf'] === '1'){
    $a[] = '（感内）';
  }
  if($var['int_tum'] === '1'){
    $a[] = '腫瘍';
  }
  if($var['int_apo'] === '1'){
    $a[] = '卒中';  
  }
  if($var['ped_ped'] === '1'){
    $a[] = '児';
  }
  if($var['ped_sur'] === '1'){
    $a[] = '児外';
  }
  if($var['ped_neo'] === '1'){
    $a[] = '新生児';
  }
  if($var['sur_sur'] === '1'){
    $a[] = '外';
  }
  if($var['sur_nes'] === '1'){
    $a[] = '呼外';
  }
  if($var['sur_car'] === '1'){
    $a[] = '心外';
  }
  if($var['sur_lac'] === '1'){
    $a[] = '乳外';
  }
  if($var['sur_dig'] === '1'){
    $a[] = '消外';
  }
  if($var['sur_ven'] === '1'){
    $a[] = '肛外';
  }
  if($var['sur_ner'] === '1'){
    $a[] = '脳外';
  }
  if($var['ort_rhe'] === '1'){
    $a[] = '（リウ）';
  }
  if($var['ort_ort'] === '1'){
    $a[] = '整';
  }
  if($var['ort_pla'] === '1'){
    $a[] = '形成';
  }
  if($var['ort_cos'] === '1'){
    $a[] = '美容外';
  }
  if($var['ort_reh'] === '1'){
    $a[] = 'リハ';
  }
  if($var['oph_oph'] === '1'){
    $a[] = '眼';
  }
  if($var['ent_ent'] === '1'){
    $a[] = '耳咽';
  }
  if($var['ent_to'] === '1'){
    $a[] = '気管食道';
  }
  if($var['so_sky'] === '1'){
    $a[] = '皮';
  }
  if($var['so_org'] === '1'){
    $a[] = '泌';
  }
  if($var['gyn_gyn'] === '1'){
    $a[] = '産婦';
  }
  if($var['gyn_obs'] === '1'){
    $a[] = '産';
  }
  if($var['gyn_gyne'] === '1'){
    $a[] = '婦';
  }
  if($var['psy_psy'] === '1'){
    $a[] = '精';
  }
  if($var['psy_psyc'] === '1'){
    $a[] = '心療内';
  }
  if($var['den_den'] === '1'){
    $a[] = '歯科';
  }
  if($var['den_ref'] === '1'){
    $a[] = '矯正歯科';
  }
  if($var['den_ped'] === '1'){
    $a[] = '小児歯科';
  }
  if($var['den_cav'] === '1'){
    $a[] = '歯科口外';
  }
  if($var['alle'] === '1'){
    $a[] = 'アレルギー';
  }
  if($var['rad'] === '1'){
    $a[] = '放';
  }
  if($var['ane'] === '1'){
    $a[] = '麻';
  }
  if($var['pat'] === '1'){
    $a[] = '病理';
  }
  if($var['cli'] === '1'){
    $a[] = '臨床検査';
  }
  if($var['eme'] === '1'){
    $a[] = '救急';
  }
  if($var['checkup'] === '1'){
    $a[] = '健診';
  }

  $aa =  implode('・', $a);

  ?>
          <?php if($aa !== ''){ ?>
            <?php echo html_escape ($aa); ?>
          <?php } ?>
    </div>
    <div class="uk-width-1-4 uk-child-width-1-1" uk-grid>
        <h4><span uk-icon="triangle-right"> </span>紹介・逆紹介</h4>
          <ul class="uk-margin-remove-top uk-margin-small-left uk-list">
            <li>紹介：
            <?php 
           //櫻間20230616から
           if($var['intr'] !== '0'){
            echo 'あり';
          }else{
            echo 'なし';
          }
          ?>
          </li>
          <li>逆紹介：
          <?php 
          if($var['invr_intr'] !== '0'){
            echo 'あり';
          }else{
            echo 'なし';
          }
          //櫻間20230616からまで
            ?>      
            </li>
          </ul>
          <!-- 櫻間20230105-->
        <h4><span uk-icon="triangle-right"> </span>理事長・病院長</h4>
          <ul class="uk-margin-remove-top uk-margin-small-left uk-list">
            <?php if($var['chi_name'] !==''){ ?>
              <li>理事長： 
            <?php echo html_escape ($var['chi_name']);?>
              <?php if($var['chi_sch'] !==''){ ?>
              <div class="uk-margin-left">出身校…<?php echo html_escape ($var['chi_sch']);?></div>
              <?php } ?>
            </li>
            <?php } ?>
            <?php if($var['pre_name'] !==''){ ?>
              <li>病院長： 
            <?php echo html_escape ($var['pre_name']);?>
              <?php if($var['pre_sch'] !==''){ ?>
                <div class="uk-margin-left">出身校…<?php echo html_escape ($var['pre_sch']);?></div>
              <?php } ?>
            </li>
            <?php } ?>
          </ul>
          <!-- 櫻間20230105-->
    </div>
  </div>
  </div>


<?php 
//櫻間20221101
$datae = $var['hos_cd'];
//櫻間20221101
}

}//endforeach

?>

<div class="uk-margin-bottom">
    <div class="uk-pagination uk-flex-center" uk-margin>
<?php
        echo '全'. $books_num. '件'. '　'; // 全データ数の表示です。

    if($now > 1): // リンクをつけるかの判定
?>
        <a href="<?php SITE_URL ?>search_control.php?page_id=<?php echo ($now - 1);?>">&lt;&nbsp;</a>
<?php
    else:
?>
		&lt;&nbsp;
<?php
    endif;
 
    for($i = 1; $i <= $max_page; $i++): // 最大ページ数分リンクを作成
        if ($i == $now) : // 現在表示中のページ数の場合はリンクを貼らない
?>
            &nbsp;<?php echo $now;?>&nbsp; 
<?php
            else:
?>
            <a href="<?php SITE_URL ?>search_control.php?page_id=<?php echo $i;?>">&nbsp;<?php echo $i;?>&nbsp;</a>
<?php
        endif;
    endfor;

    if($now < $max_page): // リンクをつけるかの判定
?>
        <a href="<?php SITE_URL ?>search_control.php?page_id=<?php echo ($now + 1);?>">&nbsp;&gt;</a>
<?php
    else:
?>
        &nbsp;&gt;
<?php
	endif;
//ページネーション　大井
?>
    </div>
</div>
<?php }else{ ?>
<!--*
    ✕ 検索結果なし
*-->
<div class="uk-margin-top uk-container uk-container-center uk-width-4-5@m">
    <div class="uk-alert-danger" uk-alert>
        <span uk-icon="icon: info"></span>
        検索条件に一致する医療機関はありません。
    </div>
</div>

<?php } ?>
<br><br>

</main>
</body>
</html>
