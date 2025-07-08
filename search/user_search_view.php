<?php

$url = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8');

if (strpos($url, 'search=')) {
	$_SESSION['hos_name'] = '';
	$_SESSION['college'] = '';
  $_SESSION['bed'] = '';
  $_SESSION['beda'] = '';;
	$_SESSION['hos_div']='';
	$_SESSION['hos_diva']='';
	$_SESSION['condition']='';
	$_SESSION['year']='';
	$_SESSION['introduction']='';
	$_SESSION['week']='';
	$_SESSION['kawasaki']='';
	$_SESSION['naika']='';
	$_SESSION['syounika']='';
	$_SESSION['geka']='';
	$_SESSION['seikei']='';
	$_SESSION['ganka']='';
	$_SESSION['zibiinkou']='';
	$_SESSION['hifuka']='';
	$_SESSION['sanfuzin']='';
	$_SESSION['seisin']='';
	$_SESSION['sika']='';
	$_SESSION['sonota']='';
	$_SESSION['nantou']='';
	$_SESSION['nansei']='';
	$_SESSION['takahashiniimi']='';
	$_SESSION['maniwa']='';
	$_SESSION['tuyamaaida']='';
	$_SESSION['taken']='';
	$_SESSION['area']='';
	$_SESSION['zip']='';



	$_SESSION['nantou1']='';
	$_SESSION['nansei1']='';
	$_SESSION['takahashi']='';
	$_SESSION['maniwa1']='';
	$_SESSION['tuyama']='';
	$_SESSION['a']='';
}

	$hos_name=$_SESSION['hos_name'];
	$college=$_SESSION['college'];
	$hos_div=$_SESSION['hos_div'];
	$hos_diva=$_SESSION['hos_diva'];
  $bed=$_SESSION['bed'];
  $beda=$_SESSION['beda'];
	$condition =$_SESSION['condition'];
	$year=$_SESSION['year'];
	$introduction=$_SESSION['introduction'];
	$week=$_SESSION['week'];
	$kawasaki=$_SESSION['kawasaki'];
	$naika=$_SESSION['naika'];
	$syounika=$_SESSION['syounika'];
	$geka=$_SESSION['geka'];
	$seikei=$_SESSION['seikei'];
	$ganka=$_SESSION['ganka'];
	$zibiinkou=$_SESSION['zibiinkou'];
	$hifuka=$_SESSION['hifuka'];
	$sanfuzin=$_SESSION['sanfuzin'];
	$seisin=$_SESSION['seisin'];
	$sika=$_SESSION['sika'];
	$sonota=$_SESSION['sonota'];
	$nantou=$_SESSION['nantou'];
	$nansei=$_SESSION['nansei'];
	$takahashiniimi=$_SESSION['takahashiniimi'];
	$maniwa=$_SESSION['maniwa'];
	$tuyamaaida=$_SESSION['tuyamaaida'];
	$taken=$_SESSION['taken'];
	$area=$_SESSION['area'];
	$zip=$_SESSION['zip'];


	$nantou1=$_SESSION['nantou1'];
	$nansei1=$_SESSION['nansei1'];
	$takahashi=$_SESSION['takahashi'];
	$maniwa1=$_SESSION['maniwa1'];
	$tuyama=$_SESSION['tuyama'];

?>



<!DOCTYPE html>
<html lang="ja">
	<head><link rel="shortcut icon" href="../favicon.ico">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>医療機関 検索 | 医療機関情報システム</title><!--★1103確認済-->
	<!--CSS/JS-->
	<!-- *全画面必須 ---------->
		<!--UIkit3-->
		<link rel="stylesheet" href="../css/uikit.min.css" />
		<script src="../js/uikit.min.js"></script>
		<script src="../js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="../css/uk-custom.css">

		<!--style.css-->
		<link rel="stylesheet" href="../css/style.css"/>
		<link rel="stylesheet" href="../css/form_parts.css" /><!--※-->
		<link rel="stylesheet" href="../css/marker.css"><!--:*marker -->

		<!--*font awesome-->
		<link rel="stylesheet" href="../css/all.min.css" />
	<!--------------------* -->
		<link rel="stylesheet" href="../css/cards.css"/><!--:*Card -->
		<link rel="stylesheet" href="../css/tables.css"/><!--:*Table -->

		<style>
      /* 検索項目の余白設定 20221126高橋 */
      .SearchItems {
        margin-left:30px;
        margin-right:15px;

        margin-top:5px;
      }
      .SearchItems-sm {
        margin-left:15px;
        margin-right:10px;

        margin-top:10px;

      }

      /* 待機中のぐるぐる */
      .loader {
				width: 100vw;
				height: 30vh;
				position: fixed;
				top: 30%;
				left: 0;
				z-index: 1000;
				background-color: rgba(0, 0, 0, 0.3);
				display: none;
			}
		</style>
		<!--js-->
		<script src="../js/modal.js"></script>
	</head>

<body>
	<!--待機中のぐるぐる UIKitのspinner利用-->
	<div id="load-spinner" class="uk-overlay-primary uk-position-cover loader">
		<div class="uk-position-center">
			<span uk-spinner="ratio: 3"></span>
		</div>
	</div>

  <!-- **header -->
  <header uk-sticky>
    <?php include_once("../header.php"); ?>
    <!-- パンくず -->
      <ul class="uk-breadcrumb breadcrumb">
        <li><span>医療機関 検索</span></li>
      </ul>
  </header>
  
  <!-- 高橋20221223
    **footer ページ下部固定 -->
  <footer uk-sticky="position: bottom">
    <div class="uk-flex uk-flex-right">
    </div>
    <?php include_once("../footer.php"); ?>
  </footer>

  <!--**main-->
  <main>
  <div class="uk-container uk-width-expand">
      <!--*main_header-->
				<div class="uk-card-header border-header">
					<h2>医療機関検索</h2>
				</div>
      <!--*main_body-->
        <!--*Forms--> 
    		<form class="uk-form-stacked validationForm " action="search_control.php" method="POST" novalidate>

      <!-- *GRID-START -->
    		<div class="uk-margin" uk-grid>
            <div class="uk-width-3-5@m"><!-- *GRID_left3/5 -->
                <!--**Search_≪地域検索≫-->
                  <fieldset class="uk-fieldset uk-margin-medium">
                    <legend class="uk-legend"><i class="fas fa-map-marker-alt"></i> 地域</legend>
                    <div class="toggle-area SearchItems">
                      <!--*Filter_area(ALL)-->
                      <div class="SearchItems-sm" uk-filter="target: .js-filter">
                        <ul class="uk-subnav uk-subnav-pill">
                          <li class="uk-active" uk-filter-control="[data-color='指定なし']"><a href="#" style="font-weight:700; display:none;">指定なし</a></li>
                          <li uk-filter-control="[data-color='岡山県']"><a href="#">岡山県</a></li>
                          <li uk-filter-control="[data-color='他県']"><a href="#">他県</a></li>
                          <li uk-filter-control="[data-color='検索']"><a href="#"><i class="fas fa-search"></i>地域検索</a></li>
                        </ul>
                        <ul class="js-filter uk-child-width-auto" uk-grid>
                          <!---- 岡山県 ここから---->
                          <li data-color="岡山県">
                            <div class="uk-margin-small">
                                <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox" name="Okayama" id="ALL"><b>岡山県</b></label>
                            </div>
                            <!--*Filter_area(岡山県)-->
                            <div class="SearchItems-sm" uk-filter="target: .js-filter">
                              <ul class="uk-subnav uk-subnav-pill">
                                <li uk-filter-control="[data-color='県南東部']"><a href="#">県南東部</a></li>
                                <li uk-filter-control="[data-color='県南西部']"><a href="#">県南西部</a></li>
                                <li uk-filter-control="[data-color='高梁・新見']"><a href="#">高梁・新見</a></li>
                                <li uk-filter-control="[data-color='真庭']"><a href="#">真庭</a></li>
                                <li uk-filter-control="[data-color='津山・英田']"><a href="#">津山・英田</a></li>
                              </ul>
                              <ul class="js-filter uk-child-width-auto" uk-grid>
                              <!--1)県南東部-->
                                <input type="hidden" class="All east" name="nantou[]" value="">
                                <li data-color="県南東部">
                                  <!--*checkboxALL(県南東部)-->
                                  <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox All" name="Okayama" id="EAST"><b>県南東部</b></label>
                                </li>
                                <?php
                                foreach($data12 as $key => $var):
                                  if ($nantou!== ''):
                                    $key35 = in_array($var['area1'], (array)$nantou); 
                                ?>
                                  <li data-color="県南東部">
                                    <label><input type="checkbox" class="uk-checkbox All east" name="nantou[]" value="<?php echo ($var['area1']);?>"<?php if($key35){ echo'checked' ;}?>><?php echo ($var['area1']);?></label>
                                  </li>
                                <?php
                                else:
                                ?>
                                  <li data-color="県南東部">
                                    <label><input type="checkbox" class="uk-checkbox All east" name="nantou[]" value="<?php echo ($var['area1']);?>"><?php echo ($var['area1']);?></label>
                                  </li>
                                <?php
                                    endif; 
                                endforeach; 
                                ?>

                              <!--2)県南西部-->
                                <input type="hidden" class="All west" name="nansei[]" value="">
                                <li data-color="県南西部">
                                    <!--*checkboxALL(県南西部)-->
                                    <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox All" name="Okayama" id="WEST"><b>県南西部</b></label>
                                </li>
                                <?php
                                foreach($data13 as $key => $var):
                                    if ($nansei!== ''):
                                    $key36 = in_array($var['area1'], (array)$nansei); 
                                ?>
                                  <li data-color="県南西部">
                                    <label><input type="checkbox" class="uk-checkbox All west" name="nansei[]" value="<?php echo ($var['area1']);?>"<?php if($key36){ echo'checked' ;}?>><?php echo ($var['area1']);?></label>
                                  </li>
                                <?php
                                else:
                                ?>
                                  <li data-color="県南西部">
                                    <label><input type="checkbox" class="uk-checkbox All west" name="nansei[]" value="<?php echo ($var['area1']);?>"><?php echo ($var['area1']);?></label>
                                  </li>
                                <?php
                                  endif;
                                endforeach; 
                                ?>

                              <!--3)高梁・新見-->
                                <input type="hidden" class="All tani" name="takahashiniimi[]" value="">
                                <li data-color="高梁・新見">
                                  <!--*checkboxALL(高梁・新見)-->
                                  <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox All" name="Okayama" id="TANI"><b>高梁・新見</b></label>
                                </li>
                                <?php
                                foreach($data14 as $key => $var):
                                  if ($takahashiniimi!== ''):
                                    $key37 = in_array($var['area1'], (array)$takahashiniimi);
                                ?>
                                  <li data-color="高梁・新見">
                                    <label><input type="checkbox" class="uk-checkbox All tani" name="takahashiniimi[]" value="<?php echo ($var['area1']);?>"<?php if($key37){ echo'checked' ;}?>><?php echo ($var['area1']);?></label>
                                  </li>
                                <?php
                                  else:
                                ?>
                                  <li data-color="高梁・新見">
                                    <label><input type="checkbox" class="uk-checkbox All tani" name="takahashiniimi[]" value="<?php echo ($var['area1']);?>"><?php echo ($var['area1']);?></label>
                                  </li>
                                <?php
                                    endif;
                                endforeach; 
                                ?>
                              <!--4)真庭-->
                                <input type="hidden" class="All mani" name="maniwa[]" value="">
                                <li data-color="真庭">
                                  <!--*checkboxALL(真庭)-->
                                  <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox All" name="Okayama" id="MANI"><b>真庭</b></label>
                                </li>
                                <?php
                                foreach($data15 as $key => $var):
                                if ($maniwa!== ''){
                                  $key38 = in_array($var['area1'], (array)$maniwa);
                                ?>
                                  <li data-color="真庭">
                                    <label><input type="checkbox" class="uk-checkbox All mani" name="maniwa[]" value="<?php echo ($var['area1']);?>"<?php if($key38){ echo'checked' ;}?>><?php echo ($var['area1']);?></label>
                                  </li>
                                <?php
                                }else{
                                ?>
                                  <li data-color="真庭">
                                    <label><input type="checkbox" class="uk-checkbox All mani" name="maniwa[]" value="<?php echo ($var['area1']);?>"><?php echo ($var['area1']);?></label>
                                  </li>
                                <?php
                                  }
                                endforeach; 
                                ?>

                              <!--5)津山・英田-->
                                <input type="hidden" class="All tua" name="tuyamaaida[]" value="">
                                <li data-color="津山・英田">
                                  <!--*checkboxALL(津山・英田)-->
                                  <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox All" name="Okayama" id="TUA"><b>津山・英田</b></label>
                                </li>
                                <?php
                                foreach($data16 as $key => $var):
                                  if ($tuyamaaida!== ''){
                                  $key40 = in_array($var['area1'], (array)$tuyamaaida); 
                                ?>
                                  <li data-color="津山・英田">
                                    <label><input type="checkbox" class="uk-checkbox All tua" name="tuyamaaida[]" value="<?php echo ($var['area1']);?>"<?php if($key40){ echo'checked' ;}?>><?php echo ($var['area1']);?></label>
                                  </li>
                                <?php
                                  }else{
                                ?>
                                  <li data-color="津山・英田">
                                    <label><input type="checkbox" class="uk-checkbox All tua" name="tuyamaaida[]" value="<?php echo ($var['area1']);?>"><?php echo ($var['area1']);?></label>
                                  </li>
                                <?php
                                  }
                                endforeach; 
                                ?>
                              </ul>
                            </div>
                          </li>
                          <!---- 岡山県 ここまで---->

                          <!---- 他県 ここから ---->
                          <li data-color="他県">
                            <input type="hidden" name="taken[]" value="">
                              <!---- 広島県高橋20230510修正 ---->
                              <?php
                                if ($taken!== ''){
                                $key41 = in_array($var['area1'], $taken);
                              ?>
                                  <label><input type="checkbox" class="uk-checkbox" name="taken[]" value="広島県"<?php if($key41){ echo'checked' ;}?>>広島県</label>
                              <?php
                                }else{
                              ?>
                                  <label><input type="checkbox" class="uk-checkbox" name="taken[]" value="広島県">広島県</label>
                              <?php
                                }
                              ?>
                              <!---- 広島県高橋20230510修正 ---->
                          </li>
                          <!---- 他県 ここまで ---->

                          <!---- 地域検索 ここから ---->
                          <li data-color="検索">
                            <ul class="uk-list">
                              <li class="uk-margin-small">
                                <span>地域名検索：</span>
                                <?php
                                if ($area!== ''){
                                ?>
                                  <input type="text" class="uk-input uk-form-width-medium" id="f-area" name="area" value="<?php echo html_escape ($area);?>"><span class=" uk-forms-label">を含む</span>
                                <?php
                                }else{
                                ?>
                                  <input type="text" class="uk-input uk-form-width-medium uk-input-small" id="f-area" name="area" placeholder="キーワードを入力"><span class=" uk-forms-label">を含む</span>
                                <?php
                                }
                                ?>
                              </li>
                              <!--櫻間-->
                              <li class="uk-margin-small">
                                <span>郵便番号検索： 〒</span>
                              <?php
                              if ($zip!== ''){
                              ?>
                                <input type="text" class="uk-input uk-form-width-medium pattern" id="f-zip" name="zip" value="<?php echo html_escape ($zip);?>" data-pattern="zip" placeholder="ハイフンなしで入力">
                              <?php
                              }else{
                              ?>
                                <input class="pattern uk-input uk-form-width-medium pattern" data-pattern="zip"  type="text" name="zip" id="f-zip" data-pattern="zip" placeholder="ハイフンなしで入力">
                              <?php
                              }
                              ?>
                              </li>
                              
                            <!--櫻間-->
                            </ul>
                          </li>
                          <!---- 地域検索 ここまで ---->
                        </ul>
                      </div>
                    </div>
                  </fieldset>

                <!--**Search_≪診療科検索≫-->
                  <fieldset class="uk-fieldset uk-margin-medium" id="search-dept">
                    <legend class="uk-legend"><i class="fas fa-grip-horizontal"></i> 診療科</legend>
                    <div class="toggle-dept SearchItems">
                      <!--*checkboxALL(医科全て)-->
                      <label class="RED_marker"><input type="checkbox" class="uk-checkbox"  id="Dept1a"><b>医科（歯科系以外すべて）</b></label>

                      <!--*Filter_dept-->
                      <div class="SearchItems-sm" uk-filter="target: .js-filter">
                        <ul class="uk-subnav uk-subnav-pill">                      
                          <li class="uk-active" uk-filter-control="[data-color='指定なし']"><a href="#" style="font-weight:700; display:none;">指定なし</a></li>
                          <li uk-filter-control="[data-color='内科系']"><a href="#">内科系</a></li>
                          <li uk-filter-control="[data-color='小児科系']"><a href="#">小児科系</a></li>
                          <li uk-filter-control="[data-color='外科系']"><a href="#">外科系</a></li>
                          <li uk-filter-control="[data-color='整形外科系']"><a href="#">整形外科系</a></li>
                          <li uk-filter-control="[data-color='眼科系']"><a href="#">眼科系</a></li>
                          <li uk-filter-control="[data-color='耳鼻咽喉科系']"><a href="#">耳鼻咽喉科系</a></li>
                          <li uk-filter-control="[data-color='皮膚科・泌尿器科系']"><a href="#">皮膚科・泌尿器科系</a></li>
                          <li uk-filter-control="[data-color='産婦人科系']"><a href="#">産婦人科系</a></li>
                          <li uk-filter-control="[data-color='精神科系']"><a href="#">精神科系</a></li>
                          <li uk-filter-control="[data-color='歯科系']"><a href="#">歯科系</a></li>
                          <li uk-filter-control="[data-color='その他']"><a href="#">その他</a></li>
                        </ul>

                        <ul class="js-filter uk-child-width-auto" uk-grid>
                          <!--内科系-->
                          <input type="hidden" name="naika[]" value="" id="NA_AL">
                            <li data-color="内科系">
                              <!--*checkboxALL(内科系)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox xika" id="Dept1"><b>内科系</b></label>
                            </li>
                            <?php
                            foreach($data as $key => $var):
                              if ($naika!== ''){
                              $key26 = in_array($var['dep_name'], (array)$naika); 
                            ?>
                            <li data-color="内科系">
                              <label><input type="checkbox"  class="uk-checkbox xika naika" name="naika[]" value="<?php echo ($var['dep_name']);?>" <?php if($key26){ echo'checked' ;}?>><?php echo ($var['dep_name']);?></label>
                            </li>
                            <?php
                              }else{
                            ?>
                            <li data-color="内科系">
                              <label><input type="checkbox" class="uk-checkbox xika naika" name="naika[]" value="<?php echo ($var['dep_name']);?>"><?php echo ($var['dep_name']);?></label>
                            </li>
                            <?php
                              }
                            endforeach; 
                            ?>

                          <!--小児科系-->
                          <input type="hidden" name="syounika[]" value="">
                            <li data-color="小児科系">
                              <!--*checkboxALL(小児科系)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox xika" id="Dept2"><b>小児科系</b></label>
                            </li>
                            <?php
                            foreach($data2 as $key => $var):
                            if ($syounika!== ''){
                              $key27 = in_array($var['dep_name'], (array)$syounika); 
                            ?>
                            <li data-color="小児科系">
                              <label><input type="checkbox" class="uk-checkbox xika syounika" name="syounika[]" value="<?php echo ($var['dep_name']);?>"<?php if($key27){ echo'checked' ;}?>><?php echo ($var['dep_name']);?></label>
                            </li>
                            <?php
                                  }else{
                            ?>
                            <li data-color="小児科系">
                              <label><input type="checkbox" class="uk-checkbox xika syounika" name="syounika[]" value="<?php echo ($var['dep_name']);?>"><?php echo ($var['dep_name']);?></label>
                            </li>
                            <?php
                            }
                            endforeach; 
                            ?>

                          <!--外科系-->
                          <input type="hidden" name="geka[]" value=""> 
                            <li data-color="外科系">
                              <!--*checkboxALL(外科系)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox xika" id="Dept3"><b>外科系</b></label>
                            </li>
                              <?php
                              foreach($data3 as $key => $var):
                              if ($geka!== ''){
                                $key28 = in_array($var['dep_name'], (array)$geka); 
                              ?>
                                <li data-color="外科系">
                                  <label><input type="checkbox" class="uk-checkbox xika geka" name="geka[]" value="<?php echo ($var['dep_name']);?>"<?php if($key28){ echo'checked' ;}?>><?php echo ($var['dep_name']);?></label>
                                </li>
                              <?php
                              }else{
                              ?>
                                <li data-color="外科系">
                                  <label><input type="checkbox" class="uk-checkbox xika geka" name="geka[]" value="<?php echo ($var['dep_name']);?>"><?php echo ($var['dep_name']);?></label>
                                </li>
                              <?php
                              }
                              endforeach; 
                              ?>

                          <!--整形外科系-->
                          <input type="hidden" name="seikei[]" value="">
                            <li data-color="整形外科系">
                              <!--*checkboxALL(整形外科系)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox xika" id="Dept4"><b>整形外科系</b></label>
                            </li>
                            <?php
                            foreach($data4 as $key => $var):
                            if ($seikei!== ''){
                              $key42 = in_array($var['dep_name'], (array)$seikei); 
                            ?>
                              <li data-color="整形外科系">
                                <label><input type="checkbox" class="uk-checkbox xika seikei" name="seikei[]" value="<?php echo ($var['dep_name']);?>"<?php if($key42){ echo'checked' ;}?>><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }else{
                            ?>
                              <li data-color="整形外科系">
                                <label><input type="checkbox" class="uk-checkbox xika seikei" name="seikei[]" value="<?php echo ($var['dep_name']);?>"><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }
                            endforeach; 
                            ?>
                        
                          <!--眼科系-->
                          <input type="hidden" name="ganka[]" value="">
                            <li data-color="眼科系">
                              <!--*checkboxALL(眼科系)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox xika" id="Dept5"><b>眼科系</b></label>
                            </li>
                            <?php
                            foreach($data5 as $key => $var):
                            if ($ganka!== ''){
                              $key43 = in_array($var['dep_name'], (array)$ganka);
                            ?>
                              <li data-color="眼科系">
                                <label><input type="checkbox" class="uk-checkbox xika ganka" name="ganka[]" value="<?php echo ($var['dep_name']);?>"<?php if($key43){ echo'checked' ;}?>><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }else{
                            ?>
                              <li data-color="眼科系">
                                <label><input type="checkbox" class="uk-checkbox xika ganka" name="ganka[]" value="<?php echo ($var['dep_name']);?>"><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }
                            endforeach; 
                            ?>

                          <!--耳鼻咽喉科系-->
                          <input type="hidden" name="zibiinkou[]" value="">
                            <li data-color="耳鼻咽喉科系">
                              <!--*checkboxALL(耳鼻咽喉科系)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox xika" id="Dept6"><b>耳鼻咽喉科系</b></label>
                            </li>
                            <?php
                            foreach($data6 as $key => $var):
                              if ($zibiinkou!== ''){
                            $key29 = in_array($var['dep_name'], (array)$zibiinkou); 
                            ?>
                              <li data-color="耳鼻咽喉科系">
                                <label><input type="checkbox" class="uk-checkbox xika zibi" name="zibiinkou[]" value="<?php echo ($var['dep_name']);?>"<?php if($key29){ echo'checked' ;}?>><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }else{
                            ?>
                              <li data-color="耳鼻咽喉科系">
                                <label><input type="checkbox" class="uk-checkbox xika zibi" name="zibiinkou[]" value="<?php echo ($var['dep_name']);?>"><?php echo ($var['dep_name']);?> </label>
                              </li>
                            <?php
                            }
                            endforeach; 
                            ?>
                          <!--皮膚科・泌尿器科系-->
                          <input type="hidden" name="hifuka[]" value="">
                            <li data-color="皮膚科・泌尿器科系">
                              <!--*checkboxALL(皮膚科・泌尿器科系)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox xika" id="Dept7"><b>皮膚科・泌尿器科系</b></label>
                            </li>
                            <?php
                            foreach($data7 as $key => $var):
                            if ($hifuka!== ''){
                            $key30 = in_array($var['dep_name'], (array)$hifuka); 
                            ?>
                              <li data-color="皮膚科・泌尿器科系">
                                <label><input type="checkbox" class="uk-checkbox xika hifu" name="hifuka[]" value="<?php echo ($var['dep_name']);?>"<?php if($key30){ echo'checked' ;}?>><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }else{
                            ?>
                              <li data-color="皮膚科・泌尿器科系">
                                <label><input type="checkbox" class="uk-checkbox xika hifu" name="hifuka[]" value="<?php echo ($var['dep_name']);?>"><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }
                            endforeach; 
                            ?>

                          <!--産婦人科系-->
                          <input type="hidden" name="sanfuzin[]" value="">
                            <li data-color="産婦人科系">
                              <!--*checkboxALL(産婦人科系)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox xika" id="Dept8"><b>産婦人科系</b></label>
                            </li>
                            <?php
                            foreach($data8 as $key => $var):
                            if ($sanfuzin!== ''){
                            $key31 = in_array($var['dep_name'], (array)$sanfuzin); 
                            ?>
                              <li data-color="産婦人科系">
                                <label><input type="checkbox" class="uk-checkbox xika sanfuzin" name="sanfuzin[]" value="<?php echo ($var['dep_name']);?>"<?php if($key31){ echo'checked' ;}?>><?php  echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }else{
                            ?>
                              <li data-color="産婦人科系">
                                <label><input type="checkbox" class="uk-checkbox xika sanfuzin" name="sanfuzin[]" value="<?php echo ($var['dep_name']);?>"><?php  echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }
                            endforeach; 
                            ?>

                          <!--精神科系-->
                          <input type="hidden" name="seisin[]" value="">
                            <li data-color="精神科系">
                              <!--*checkboxALL(精神科系)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox xika" id="Dept9"><b>精神科系</b></label>
                            </li>
                            <?php
                            foreach($data9 as $key => $var):
                            if ($seisin!== ''){
                            $key32 = in_array($var['dep_name'], (array)$seisin);
                            ?>
                              <li data-color="精神科系">
                                <label><input type="checkbox" class="uk-checkbox xika seisin" name="seisin[]" value="<?php echo ($var['dep_name']);?>"<?php if($key32){ echo'checked' ;}?>><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }else{
                            ?>
                              <li data-color="精神科系">
                                <label><input type="checkbox" class="uk-checkbox xika seisin" name="seisin[]" value="<?php echo ($var['dep_name']);?>"><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }
                            endforeach; 
                            ?>

                          <!--歯科系-->
                          <input type="hidden" name="sika[]" value="">
                            <li data-color="歯科系">
                              <!--*checkboxALL(歯科系)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox" id="Dept10"><b>歯科系</b></label>
                            </li>
                            <?php
                            foreach($data10 as $key => $var):
                            if ($sika!== ''){
                            $key33 = in_array($var['dep_name'], (array)$sika); 
                            ?>
                              <li data-color="歯科系">
                                <label><input type="checkbox" class="uk-checkbox sika" name="sika[]" value="<?php echo ($var['dep_name']);?>"<?php if($key33){ echo'checked' ;}?>><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }else{
                            ?>
                              <li data-color="歯科系">
                                <label><input type="checkbox" class="uk-checkbox sika" name="sika[]" value="<?php echo ($var['dep_name']);?>"><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }
                            endforeach; 
                            ?>

                          <!--その他-->
                          <input type="hidden" name="sonota[]" value="">
                            <li data-color="その他">
                              <!--*checkboxALL(その他)-->
                              <label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox xika" id="Dept11"><b>その他</b></label>
                            </li>
                            <?php
                            foreach($data11 as $key => $var):
                            if ($sonota!== ''){
                            $key34 = in_array($var['dep_name'], (array)$sonota); 
                            ?>
                              <li data-color="その他">
                                <label><input type="checkbox" class="uk-checkbox xika sonota" name="sonota[]" value="<?php echo ($var['dep_name']);?>"<?php if($key34){ echo'checked' ;}?>><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }else{
                            ?>
                              <li data-color="その他">
                                <label><input type="checkbox" class="uk-checkbox xika sonota" name="sonota[]" value="<?php echo ($var['dep_name']);?>"><?php echo ($var['dep_name']);?></label>
                              </li>
                            <?php
                            }
                            endforeach; 
                            ?>
                        </ul>
                      </div>
                    </div>
                  </fieldset>

                <!--**Search_≪診療日検索≫-->
                  <fieldset class="uk-fieldset uk-margin-medium" id="search-week">
                    <legend class="uk-legend"><i class="fas fa-calendar-alt"></i> 診療日</legend>
                    <div class="toggle-week SearchItems">
                      <input type="hidden" name="week[]" value="">
                      <?php
                      if ($week!== ''):
                        $key11 = in_array('月am', (array)$week); 
                        $key12 = in_array('月pm', (array)$week); 
                        $key13 = in_array('火am', (array)$week); 
                        $key14 = in_array('火pm', (array)$week); 
                        $key15 = in_array('水am', (array)$week); 
                        $key16 = in_array('水pm', (array)$week); 
                        $key17 = in_array('木am', (array)$week); 
                        $key18 = in_array('木pm', (array)$week); 
                        $key19 = in_array('金am', (array)$week); 
                        $key20 = in_array('金pm', (array)$week); 
                        $key21 = in_array('土am', (array)$week); 
                        $key22 = in_array('土pm', (array)$week); 
                        $key23 = in_array('日am', (array)$week); 
                        $key24 = in_array('日pm', (array)$week); 
                        $key25 = in_array('祝日', (array)$week); 
                      ?>
                      <!-- セッションあり -->
                        <table class="uk-table-small tbl-border uk-width-4-5@m">
                          <tr>
                            <th><!--*checkboxALL(すべて)-->
                              <label for="All">すべて</label><br>
                              <input type="checkbox" class="uk-checkbox" id="All" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Mon)-->
                              <label for="Mon">月</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Mon" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Tue)-->
                              <label for="Tue">火</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Tue" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Wed)-->
                              <label for="Wed">水</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Wed" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Thu)-->
                              <label for="Thu">木</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Thu" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Fri)-->
                              <label for="Fri">金</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Fri" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Sat)-->
                              <label for="Sat">土</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Sat" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Sun)-->
                              <label for="Sun">日</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Sun" name="week[]">
                            </th>
                            <th>
                              <label for="holiday">祝日</label>
                            </th>
                          </tr>
                          <tr>
                            <th><!--*checkboxALL(AM)-->
                              <input type="checkbox" class="uk-checkbox all" id="AM" name="week[]"><label for="AM">AM</label>
                            </th>
                            <td>
                              <input type="checkbox" class="uk-checkbox all MONDAY am" id="Mona" name="week[]" value="月am" <?php if($key11){ echo'checked' ;}?>>
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all TUESDAY am" id="tuea" name="week[]" value="火am"<?php if($key13){ echo'checked' ;}?> >
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all WEDNESDAY am" id="Weda" name="week[]" value="水am" <?php if($key15){ echo'checked' ;}?>>
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all THURSDAY am" id="Thua" name="week[]" value="木am" <?php if($key17){ echo'checked' ;}?>>
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all FRIDAY am" id="Fria" name="week[]" value="金am"<?php if($key19){ echo'checked' ;}?>>
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all SATURDAY am" id="Sata" name="week[]" value="土am"<?php if($key21){ echo'checked' ;}?> >
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all SUNDAY am" id="Suna" name="week[]" value="日am"<?php if($key23){ echo'checked' ;}?>>
                            </td>
                            <td rowspan=2>
                              <input type="checkbox" class="uk-checkbox all" id="holiday" name="week[]" value="祝日"<?php if($key25){ echo'checked' ;}?>>
                            </td>
                          </tr>
                          <tr>
                            <th><!--*checkboxALL(PM)-->
                              <input type="checkbox" class="uk-checkbox all" id="PM" name="week[]"><label for="PM">PM</label>
                            </th>
                            <td>
                              <input type="checkbox" class="uk-checkbox all MONDAY pm" id="Monp" name="week[]" value="月pm" <?php if($key12){ echo'checked' ;}?>>
                            </td>
                              <td>
                              <input type="checkbox" class="uk-checkbox all TUESDAY pm" id="tuep" name="week[]" value="火pm"<?php if($key14){ echo'checked' ;}?> > 
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all WEDNESDAY pm" id="Wedp" name="week[]" value="水pm"<?php if($key16){ echo'checked' ;}?>>
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all THURSDAY pm" id="Thup" name="week[]" value="木pm" <?php if($key18){ echo'checked' ;}?>>
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all FRIDAY pm" id="Frip" name="week[]" value="金pm"<?php if($key20){ echo'checked' ;}?>>
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all SATURDAY pm" id="Satp" name="week[]" value="土pm"<?php if($key22){ echo'checked' ;}?>>
                            </td>
                            <td>
                              <input type="checkbox" class="uk-checkbox all SUNDAY pm" id="Sunp" name="week[]" value="日pm"<?php if($key24){ echo'checked' ;}?>>
                            </td>
                          </tr>
                        </table>
                      <?php
                      else:
                      ?>
                      <!-- セッションなし -->
                        <table class="uk-table-small tbl-border uk-width-4-5@m">
                          <tr>
                            <th><!--*checkboxALL(ALL)-->
                              <label for="All">すべて</label>
                              <br><input type="checkbox" class="uk-checkbox" id="All" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Mon)-->
                              <label for="Mon">月</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Mon" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Tue)-->
                              <label for="Tue">火</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Tue" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Wed)-->
                              <label for="Wed">水</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Wed" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Thu)-->
                              <label for="Thu">木</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Thu" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Fri)-->
                              <label for="Fri">金</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Fri" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Sat)-->
                              <label for="Sat">土</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Sat" name="week[]">
                            </th>
                            <th><!--*checkboxALL(Sun)-->
                              <label for="Sun">日</label><br>
                              <input type="checkbox" class="uk-checkbox all" id="Sun" name="week[]">
                            </th>
                            <th>
                              <label for="holiday">祝日</label>
                            </th>
                          </tr>
                          <tr>
                            <th><!--*checkboxALL(AM)-->
                              <input type="checkbox" class="uk-checkbox all" id="AM" name="week[]"><label for="AM">AM</label>
                            </th>
                            <td><input type="checkbox" class="uk-checkbox all MONDAY am" id="Mona" name="week[]" value="月am" ></td>
                            <td><input type="checkbox" class="uk-checkbox all TUESDAY am" id="Tuea" name="week[]" value="火am" ></td>
                            <td><input type="checkbox" class="uk-checkbox all WEDNESDAY am" id="Weda" name="week[]" value="水am" ></td>
                            <td><input type="checkbox" class="uk-checkbox all THURSDAY am" id="Thua" name="week[]" value="木am" ></td>
                            <td><input type="checkbox" class="uk-checkbox all FRIDAY am" id="Fria" name="week[]" value="金am"></td>
                            <td><input type="checkbox" class="uk-checkbox all SATURDAY am" id="Sata" name="week[]" value="土am" ></td>
                            <td><input type="checkbox" class="uk-checkbox all SUNDAY am" id="Suna" name="week[]" value="日am"></td>
                            <td rowspan=2>
                              <input type="checkbox" class="uk-checkbox all" id="holiday" name="week[]" value="祝日">
                            </td>
                          </tr>
                          <tr>
                            <th><!--*checkboxALL(PM)-->
                              <input type="checkbox" class="uk-checkbox all" id="PM" name="week[]"><label for="PM">PM</label>
                            </th>
                            <td><input type="checkbox" class="uk-checkbox all MONDAY pm"  id="Monp" name="week[]" value="月pm"></td>
                            <td><input type="checkbox" class="uk-checkbox all TUESDAY pm" id="Tuep" name="week[]" value="火pm"></td>
                            <td><input type="checkbox" class="uk-checkbox all WEDNESDAY pm" id="Wedp" name="week[]" value="水pm"></td>
                            <td><input type="checkbox" class="uk-checkbox all THURSDAY pm" id="Thup" name="week[]" value="木pm"></td>
                            <td><input type="checkbox" class="uk-checkbox all FRIDAY pm" id="Frip" name="week[]" value="金pm"></td>
                            <td><input type="checkbox" class="uk-checkbox all SATURDAY pm" id="Satp" name="week[]" value="土pm"></td>
                            <td><input type="checkbox" class="uk-checkbox all SUNDAY pm" id="Sunp" name="week[]" value="日pm"></td>
                          </tr>
                        </table>
                      <?php
                      endif;
                      ?>
                    </div>
                  </fieldset>
                <!--**Search_≪紹介・逆紹介 検索≫-->
                  <fieldset class="uk-fieldset uk-margin-medium" id="search-intro">
                    <legend class="uk-legend"><span class="fas fa-clipboard"></span> 紹介・逆紹介</legend>
                    <div class="toggle-intro SearchItems">
                      <!--紹介・逆紹介-->
                        <div class="uk-margin-small">
                          <input type="hidden" name="introduction[]" value="">
                          <?php
                            if ($introduction!== ''){
                              $key7 = in_array('紹介あり', (array)$introduction); 
                              $key8 = in_array('逆紹介あり', (array)$introduction); 
                          ?>
                            <div class="uk-child-width-auto" uk-grid>
                              <div>
                                <label for="紹介"><input type="checkbox" class="uk-checkbox" id="紹介" name="introduction[]" value="紹介あり"<?php if($key7){ echo'checked' ;}?>>紹介あり</label>
                              </div>
                              <div>
                                <label for="逆紹介"><input type="checkbox" class="uk-checkbox" id="逆紹介" name="introduction[]" value="逆紹介あり"<?php if($key8){ echo'checked' ;}?>>逆紹介あり</label>
                              </div>
                            </div>
                          <?php
                          }else{
                          ?>
                            <div class="uk-child-width-auto" uk-grid>
                              <div>
                                <label for="紹介"><input type="checkbox" class="uk-checkbox" id="紹介" name="introduction[]" value="紹介あり">紹介あり</label>
                              </div>
                              <div>
                                <label for="逆紹介"><input type="checkbox" class="uk-checkbox" id="逆紹介" name="introduction[]" value="逆紹介あり">逆紹介あり</label>
                              </div>
                            </div>
                          <?php
                          }
                          ?>      
                        </div>

                      <!--年度-->
                        <div class="uk-margin-small">
                          <?php
                          if ($year!== ''){
                          ?> 
                            <p>
                              <input class="pattern uk-input uk-form-width-medium" type="text" name="year" name="year" id="year" value="<?php echo html_escape ($year);?>" placeholder="西暦を入力" data-pattern="year">年度
                            </p><!--櫻間20221117-->    
                          <?php
                          }else{
                          ?>
                            <p>
                              <input class="pattern uk-input uk-form-width-medium" type="text" name="year" name="year" id="year" placeholder="西暦を入力" data-pattern="year">年度
                            </p><!--櫻間20221117-->
                          <?php
                          }
                          ?>
                        </div>

                      <!--施設-->
                      <!-- 櫻間20230616から -->
                      <div class="uk-margin-small">
                          <input type="hidden" name="kawasaki[]" value="">
                          <?php
                          if ($kawasaki!== ''){
                            $key9 = in_array('1', (array)$kawasaki); 
                            $key10 = in_array('2', (array)$kawasaki); 
                          ?>
                            <div class="uk-child-width-auto" uk-grid>
                              <span class="uk-forms-label">施設：</span>
                              <div>
                                <label for="附属病院">
                                <input type="checkbox" class="uk-checkbox" id="附属病院" name="kawasaki[]" value="1"<?php if($key9){ echo'checked' ;}?>>附属病院</label>
                              </div>
                              <div>
                                <label for="総合医療センター">
                                <input type="checkbox" class="uk-checkbox"  id="総合医療センター" name="kawasaki[]" value="2"<?php if($key10){ echo'checked' ;}?>>総合医療センター</label>
                              </div>
                            </div>
                          <?php
                          }else{
                          ?>
                            <div class="uk-child-width-auto" uk-grid>
                              <span class="uk-forms-label">施設：</span>
                              <div>
                                <label for="附属病院"><input type="checkbox" class="uk-checkbox" id="附属病院" name="kawasaki[]" value="1">附属病院</label>
                              </div>
                              <div>
                                <label for="総合医療センター"><input type="checkbox" class="uk-checkbox"  id="総合医療センター" name="kawasaki[]" value="2">総合医療センター</label>
                              </div>
                            </div>
                          <?php
                          }
                          ?>
                        </div>
                      <!-- 櫻間20230616まで -->
                    </div>
                  </fieldset>
            </div>


            <div class="uk-width-2-5@m"><!-- *GRID_right2/5 -->
                <!--**Search_≪医療機関名 検索≫-->
                  <fieldset class="uk-fieldset uk-margin-medium" id="search-hosname">
                    <legend class="uk-legend"><span class="fas fa-hospital-alt"></span> 医療機関名</legend>
                    <div class="toggle-hosname SearchItems">
                      <?php
                      if (isset($hos_name)){
                      ?>
                        <input type="text" class="uk-input uk-form-width-medium" id="f-hosname" name="hos_name" value="<?php echo html_escape ($hos_name);?>" placeholder="キーワードを入力"><span class=" uk-forms-label">を含む</span>
                        <?php
                      }else{
                      ?>
                        <input type="text" class="uk-input uk-form-width-medium" id="f-hosname" name="hos_name" ><span class=" uk-forms-label" placeholder="キーワードを入力">を含む</span>
                      <?php
                      }
                      ?>
                    </div>
                  </fieldset>

                <!--**Search_≪区分 検索≫-->
                  <fieldset class="uk-fieldset uk-margin-medium" id="search-kubun">
                    <legend class="uk-legend"><span class="fas fa-notes-medical"></span> 区分</legend>
                    <div class="toggle-kubun SearchItems-sm">
                      <!-- 病院区分 -->
                      <div class="uk-margin-small">
                        <input type="hidden" name="hos_div[]" value="">
                        <span class="uk-form-label"><i class="fas fa-caret-right fa-sm"></i> 病院区分</span>
                        <div class="toggle-kubun1 SearchItems">
                        <?php
                        if($hos_div !== ''){
                        $key = in_array('病院', (array)$hos_div);
                        $key1 = in_array('特定機能', (array)$hos_div);
                        $key2 = in_array('総合病院', (array)$hos_div);
                        $key3 = in_array('地域支援', (array)$hos_div);
                        $key4 = in_array('診療所', (array)$hos_div); 
                        ?>
                          <div class="uk-form-controls uk-form-controls-text uk-grid-small uk-child-width-1-3@m uk-child-width-auto" uk-grid>
                            <label for="病院"><input type="checkbox" class="uk-checkbox" id="病院" name="hos_div[]" value="病院" <?php if($key){ echo'checked' ;}?>>病院</label><br>
                            <label for="特定機能"><input type="checkbox" class="uk-checkbox" id="特定機能" name="hos_div[]" value="特定機能" <?php if($key1){ echo'checked' ;}?>>特定機能</label><br>
                            <label for="総合病院"><input type="checkbox" class="uk-checkbox" id="総合病院" name="hos_div[]" value="総合病院" <?php if($key2){ echo'checked' ;}?>>総合病院</label><br>
                            <label for="地域支援"><input type="checkbox" class="uk-checkbox" id="地域支援" name="hos_div[]" value="地域支援" <?php if($key3){ echo'checked' ;}?>>地域支援</label><br>
                            <label for="診療所"><input type="checkbox" class="uk-checkbox" id="診療所" name="hos_div[]" value="診療所" <?php if($key4){ echo'checked' ;}?>>診療所</label><br>
                          </div>
                        <?php
                          }else{
                        ?>
                          <div class="uk-form-controls uk-form-controls-text uk-grid-small uk-child-width-1-3@m uk-child-width-auto" uk-grid>
                            <label for="病院"><input type="checkbox" class="uk-checkbox" id="病院" name="hos_div[]" value="病院" checked>病院</label><br>
                            <label for="特定機能"><input type="checkbox" class="uk-checkbox" id="特定機能" name="hos_div[]" value="特定機能" checked>特定機能</label><br>
                            <label for="総合病院"><input type="checkbox" class="uk-checkbox" id="総合病院" name="hos_div[]" value="総合病院" checked>総合病院</label><br>
                            <label for="地域支援"><input type="checkbox" class="uk-checkbox" id="地域支援" name="hos_div[]" value="地域支援" checked>地域支援</label><br>
                            <label for="診療所"><input type="checkbox" class="uk-checkbox" id="診療所" name="hos_div[]" value="診療所" checked>診療所</label><br>
                          </div>
                        <?php
                          }
                        ?>
                        </div>
                      </div>

                      <!-- 開院区分 -->
                      <div class="uk-margin-small">
                        <input type="hidden" name="condition[]" value="">
                        <span class="uk-form-label"><i class="fas fa-caret-right fa-sm"></i> 開院区分</span>
                        <div class="toggle-kubun2 SearchItems">
                        <?php
                        if($condition !== ''){
                          $key5 = in_array('1', (array)$condition);
                          $key6 = in_array('0', (array)$condition);
                        ?>
                          <div class="uk-form-controls uk-form-controls-text">
                            <div class="uk-margin uk-grid-small uk-child-width-auto" uk-grid>
                            <label for="開院"><input type="radio" class="uk-radio green" id="開院" name="condition[]" value="1" <?php if($key5){ echo'checked' ;}?>>開院</label>
                            <label for="閉院"><input type="radio" class="uk-radio green" id="閉院" name="condition[]" value="0" <?php if($key6){ echo'checked' ;}?>>閉院</label>
                            </div>
                          </div>
                        <?php
                          }else{
                        ?>
                          <div class="uk-form-controls uk-form-controls-text">
                            <div class="uk-margin uk-grid-small uk-child-width-auto" uk-grid>
                                <label for="開院">
                                <input type="radio" class="uk-radio green" id="開院" name="condition[]" value="1" checked>開院</label>
                                <label for="閉院">
                                <input type="radio" class="uk-radio green" id="閉院" name="condition[]" value="0">閉院</label>
                            </div>
                          </div>
                        <?php
                          }
                        ?>
                        </div>
                      </div>

                      <!-- 病棟種類 -->
                      <div class="uk-margin-small">
                        <input type="hidden" name="bed[]" value="">
                        <span class="uk-form-label"><i class="fas fa-caret-right fa-sm"></i> 病棟種類</span>
                        <div class="toggle-kubun3 SearchItems">
                        <?php
                        if($bed !== ''){
                        //櫻間20221128               
                          $key50 = in_array('一般', (array)$bed);
                          $key51 = in_array('療養', (array)$bed);
                          $key52 = in_array('回復期リハ', (array)$bed);
                          $key53 = in_array('地域包括ケア', (array)$bed);
                          $key54 = in_array('障害者', (array)$bed); 
                          $key55 = in_array('緩和ケア', (array)$bed); 
                  
                        ?>
                        
                          <div class="uk-form-controls uk-form-controls-text uk-grid-small uk-child-width-1-3@m uk-child-width-auto" uk-grid>
                            <label for="一般"><input type="checkbox" class="uk-checkbox" id="一般" name="bed[]" value="一般" <?php if($key50){ echo'checked' ;}?>>一般</label><br>
                            <label for="療養"><input type="checkbox" class="uk-checkbox" id="療養" name="bed[]" value="療養" <?php if($key51){ echo'checked' ;}?>>療養</label><br>
                            <label for="回復期リハ"><input type="checkbox" class="uk-checkbox" id="回復期リハ" name="bed[]" value="回復期リハ" <?php if($key52){ echo'checked' ;}?>>回復期リハ</label><br>
                            <label for="地域包括ケア"><input type="checkbox" class="uk-checkbox" id="地域包括ケア" name="bed[]" value="地域包括ケア" <?php if($key53){ echo'checked' ;}?>>地域包括ケア</label><br>
                            <label for="障害者"><input type="checkbox" class="uk-checkbox" id="障害者" name="bed[]" value="障害者" <?php if($key54){ echo'checked' ;}?>>障害者</label><br>
                            <label for="緩和ケア"><input type="checkbox" class="uk-checkbox" id="緩和ケア" name="bed[]" value="緩和ケア" <?php if($key55){ echo'checked' ;}?>>緩和ケア</label><br>
                          </div>
                        
                        <?php
                          }else{
                        ?>
                          <div class="uk-form-controls uk-form-controls-text uk-grid-small uk-child-width-1-3@m uk-child-width-auto" uk-grid>
                            <label for="一般"><input type="checkbox" class="uk-checkbox" id="一般" name="bed[]" value="一般" >一般</label><br>
                            <label for="療養"><input type="checkbox" class="uk-checkbox" id="療養" name="bed[]" value="療養" >療養</label><br>
                            <label for="回復期リハ"><input type="checkbox" class="uk-checkbox" id="回復期リハ" name="bed[]" value="回復期リハ" >回復期リハ</label><br>
                            <label for="地域包括ケア"><input type="checkbox" class="uk-checkbox" id="地域包括ケア" name="bed[]" value="地域包括ケア" >地域包括ケア</label><br>
                            <label for="障害者"><input type="checkbox" class="uk-checkbox" id="障害者" name="bed[]" value="障害者" >障害者</label><br>
                            <label for="緩和ケア"><input type="checkbox" class="uk-checkbox" id="緩和ケア" name="bed[]" value="緩和ケア">緩和ケア</label><br>
                          </div>
                        <?php
                          }
                        ?>
                        </div>
                      </div>
                    </div>

                  </fieldset>

                <!--**Search_≪医師会 検索≫-->
                  <fieldset class="uk-fieldset" id="search-ass">
                    <legend class="uk-legend"><span class="fas fa-stethoscope"></span> 医師会</legend>
                    <div class="toggle-ass SearchItems">
                      <!--*Filter_ass-->
                      <div class="SearchItems-sm" uk-filter="target: .js-filter">
                        <ul class="uk-subnav uk-subnav-pill">
                            <li class="uk-active" uk-filter-control="[data-color='指定なし']" style="font-weight:700; display:none;"><a href="#">指定なし</a></li>
                            <li uk-filter-control="[data-color='ass_01']"><a href="#">県南東部</a></li>
                            <li uk-filter-control="[data-color='ass_02']"><a href="#">県南西部</a></li>
                            <li uk-filter-control="[data-color='ass_03']"><a href="#">高梁・新見</a></li>
                            <li uk-filter-control="[data-color='ass_04']"><a href="#">真庭</a></li>
                            <li uk-filter-control="[data-color='ass_05']"><a href="#">津山・英田</a></li>
                        </ul>
                        <ul class="js-filter uk-child-width-auto" uk-grid>
                          <!--県南東部-->
                          <input type="hidden" name="nantou1[]" value="">
                            <li data-color="ass_01"><label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox" name="Okayama" id="Ass1"><b>県南東部</b></label></li>
                            <?php
                            foreach($data18 as $key => $var):
                              if ($nantou1!== ''){
                                $key44 = in_array($var['med_ass'], (array)$nantou1);
                            ?>
                              <li data-color="ass_01">
                                <label><input type="checkbox" class="uk-checkbox nantou1" name="nantou1[]" value="<?php echo ($var['med_ass']);?>"<?php if($key44){ echo'checked' ;}?>><?php echo ($var['med_ass']);?></label>
                              </li>
                            <?php
                              }else{
                            ?>
                              <li data-color="ass_01">
                                <label><input type="checkbox" class="uk-checkbox nantou1" name="nantou1[]" value="<?php echo ($var['med_ass']);?>"><?php echo ($var['med_ass']);?></label>
                              </li>
                            <?php
                              }
                            endforeach; 
                            ?>

                          <!--県南西部-->
                          <input type="hidden" name="nansei1[]" value="">
                            <li data-color="ass_02"><label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox" name="Okayama" id="Ass2"><b>県南西部</b></label></li>
                              <?php
                              foreach($data19 as $key => $var):
                                if ($nansei1!== ''){
                                  $key45 = in_array($var['med_ass'], (array)$nansei1); 
                              ?>
                                <li data-color="ass_02">
                                  <label><input type="checkbox" class="uk-checkbox nansei1" name="nansei1[]" value="<?php echo ($var['med_ass']);?>"<?php if($key45){ echo'checked' ;}?>><?php echo ($var['med_ass']);?></label>
                                </li>
                              <?php
                              }else{
                              ?>
                                <li data-color="ass_02">
                                  <label><input type="checkbox" class="uk-checkbox nansei1" name="nansei1[]" value="<?php echo ($var['med_ass']);?>"><?php echo ($var['med_ass']);?></label>
                                </li>
                              <?php
                                }
                              endforeach; 
                              ?>

                          <!--高梁・新見-->
                          <input type="hidden" name="takahashi[]" value="">
                            <li data-color="ass_03"><label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox" name="Okayama" id="Ass3"><b>高梁・新見</b></label></li>
                            <?php
                            foreach($data20 as $key => $var):
                              if ($takahashi!== ''){
                                $key46 = in_array($var['med_ass'], (array)$takahashi); 
                            ?>
                              <li data-color="ass_03">
                                <label><input type="checkbox" class="uk-checkbox takahashi1" name="takahashi[]" value="<?php echo ($var['med_ass']);?>"<?php if($key46){ echo'checked' ;}?>><?php echo ($var['med_ass']);?> </label>
                              </li>
                            <?php
                            }else{
                            ?>
                              <li data-color="ass_03">
                                <label><input type="checkbox" class="uk-checkbox takahashi1" name="takahashi[]" value="<?php echo ($var['med_ass']);?>"><?php echo ($var['med_ass']);?></label>
                              </li>
                            <?php
                              }
                            endforeach; 
                            ?>

                          <!--真庭-->
                          <input type="hidden" name="maniwa1[]" value="">
                            <li data-color="ass_04"><label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox" name="Okayama" id="Ass4"><b>真庭</b></label></li>
                            <?php
                            foreach($data21 as $key => $var):
                              if ($maniwa1!== ''){
                                $key47 = in_array($var['med_ass'], (array)$maniwa1); 
                            ?>
                              <li data-color="ass_04">
                                <label><input type="checkbox" class="uk-checkbox maniwa1" name="maniwa1[]" value="<?php echo ($var['med_ass']);?>"<?php if($key47){ echo'checked' ;}?>><?php echo ($var['med_ass']);?></label>
                              </li>
                            <?php
                              }else{
                            ?>
                              <li data-color="ass_04">
                                <label><input type="checkbox" class="uk-checkbox maniwa1" name="maniwa1[]" value="<?php echo ($var['med_ass']);?>"><?php echo ($var['med_ass']);?></label>
                              </li>
                            <?php
                              }
                            endforeach; 
                            ?>

                          <!--津山・英田-->
                          <input type="hidden" name="tuyama[]" value="">
                            <li data-color="ass_05"><label class="YELLOW_marker"><input type="checkbox" class="uk-checkbox" name="Okayama" id="Ass5"><b>津山・英田</b></label></li>
                            <?php
                            foreach($data22 as $key => $var):
                              if ($tuyama!== ''){
                                $key48 = in_array($var['med_ass'], (array)$tuyama ); 
                            ?>
                              <li data-color="ass_05">
                                <label><input type="checkbox" class="uk-checkbox tuyama1" name="tuyama[]" value="<?php echo ($var['med_ass']);?>"<?php if($key48){ echo'checked' ;}?>><?php echo ($var['med_ass']);?></label>
                              </li>
                            <?php
                            }else{
                            ?>
                              <li data-color="ass_05">
                                <label><input type="checkbox" class="uk-checkbox tuyama1" name="tuyama[]" value="<?php echo ($var['med_ass']);?>"><?php echo ($var['med_ass']);?></label>
                              </li>
                            <?php
                              }
                            endforeach; 
                            ?>
                        </ul>
                      </div>
                    </div>
                  </fieldset>
            </div>
        </div>
      <!-- GRID-END** -->
  <br>
  <hr>
      <!-- *Button -->
        <div class="uk-margin-top uk-flex uk-flex-between">
          <!--Search-->
            <div class="uk-flex-last">
              <button type="submit" class="uk-button uk-button-large uk-button-primary" id="search-hosp" value="検索" name="kakutei"><i class="fas fa-search fa-lg"></i> 検索</button>
<!--               
              <input type="submit" class="uk-button uk-button-large uk-button-primary" id="search-hosp" value="検索" name="kakutei"> 
-->        
            </form><!-- ※検索フォームここで終了 -->
            </div>

          <!--Reset-->
            <div class="uk-flex-first">
              <form action="reset.php" method="POST">
                <button name='reset' type="submit" class="uk-button uk-button-large uk-button-secondary"><i class="fas fa-redo fa-lg"></i> リセット</button>
              </form>
            </div>
        </div>
  </div>
  </main>

  
  <!-- **footer -->
<!--   <footer uk-sticky="position:bottom;">
    あいうえお
  </footer> -->


<!-- checkbox.js -->
  <script src="../js/checkbox/week_checkbox.js"></script>
  <script src="../js/checkbox/area_checkbox.js"></script>
  <script src="../js/checkbox/dept_checkbox.js"></script>
  <script src="../js/checkbox/dept_checkbox2.js"></script>
  <script src="../js/checkbox/ass_checkbox.js"></script>

<!--櫻間-->
<script> 
	//.validationForm を指定した（最初の）要素を取得
	const validationForm = document.querySelector('.validationForm');
	//pattern クラスを指定された要素の集まり
	const patternElems =  document.querySelectorAll('.pattern');
  //const lodrer= document.getElementById('load-spinner');
  const loader = document.getElementById('load-spinner');

	//form 要素の submit イベントを使った送信時の処理
	validationForm.addEventListener('submit', (e) => {

		//エラーの初期化
		const errorElems = e.currentTarget.querySelectorAll('.error');
		errorElems.forEach( (elem) => {
			elem.remove(); 
		});


		//.pattern を指定した要素のパターンを検証
		patternElems.forEach( (elem) => {

			//data-pattern 属性の値を取得
			let dataPattern = elem.getAttribute('data-pattern');
			//または let dataPattern = elem.dataset.pattern;
			//正規表現パターンを格納する変数
			let pattern;
			//デフォルトのエラーメッセージ
			let errorMessage = '入力された形式が正しくないようです。';
			//data-pattern 属性の値が設定されていれば
			if(dataPattern) {
				//data-pattern 属性の値により switch 文で分岐
				switch(dataPattern) {
					//data-pattern 属性の値が zip の場合
					case 'zip' :
					pattern = /^[0-9]{0,7}$/;
					errorMessage = '郵便番号の形式が正しくありません。ハイフンなしで7桁の数字を入力してください。';
					break;
                   
					//data-pattern 属性の値が year の場合
					case 'year' :
					pattern = /^(19|20)\d{2}$/;
					errorMessage = '年度の形式が正しくありません。4桁の数字で西暦を入力してください。';
					break;
					//data-pattern 属性の値が上記以外の場合
					default :
					//data-pattern 属性の値を使って正規表現パターンを生成
					pattern = new RegExp(dataPattern);
				} 
			}

			
      
			//値が空でなければ
			if(elem.value.trim() !=='') {
				//上記で生成したパターンの test() メソッドで値を判定    
				if(!pattern.test(elem.value)) {
					//パターンにマッチしなければエラーを表示してフォームの送信を中止
					createError(elem, errorMessage);
					e.preventDefault();
                    	

        }else{
          //ボタンが押されたら待機中ぐるぐるを表示
    loader.style.display = 'block';

        }
			}
		});
	}); 
	
	//エラーメッセージを表示する span 要素を生成して親要素に追加する関数
  
	const createError = (elem, errorMessage) => {
		const errorSpan = document.createElement('span');
		errorSpan.classList.add('error');
		errorSpan.setAttribute('aria-live', 'polite');
		errorSpan.textContent = errorMessage;
		elem.parentNode.appendChild(errorSpan);
	}

  
  


</script>

</body>
</html>



