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

  <!-- *Forms -->
  <form action="uuu.php" method="POST" name="myform" onsubmit="return Check()" class="validationForm" novalidate>
    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
      <?php include_once("../footer.php"); ?>
    </footer>
    
    <!-- **main -->
    <main>
      <div class="uk-alert-success" uk-alert>
        <div class="uk-card-header">
          <h2><i class="fas fa-check fa-lg"></i> 変更確認</h2>
          <p>この内容でよろしいですか?</p>
        </div>
      </div>
        
      <div class="uk-container uk-width-expand uk-width-5-6@l uk-card-default">
        <!-- *main_header -->
        <div class="uk-card-header">
          <h3>医療機関詳細</h3>        
          <h1 style="display:inline;"><?php echo html_escape ($hos_name);?></h1>
          <span class="uk-margin-left">医療機関コード：<u><?php echo html_escape ($hos_cd); ?></u></span>
        </div>

        <!-- *main_body -->
          <!-- **Tabs ここから -->
          <div class="tab-wrap">
            <!-- 前半4タブ -->
              <input id="tab01" type="radio" name="tab" class="tab-switch" checked="checked"><label class="tab-label" for="tab01">基本情報</label>
              <div class="tab-content">
              <p>基本情報</p>
              <!-- PageLink -->
                <a href="#to-hospitalName"><i class="fas fa-hashtag"></i> 医療機関名</a>
                <a href="#to-kubun"><i class="fas fa-hashtag"></i> 区分</a>
                <a href="#to-Medass"><i class="fas fa-hashtag"></i> 医師会</a>
                <a href="#to-area"><i class="fas fa-hashtag"></i> 所在地</a>
                <a href="#to-address"><i class="fas fa-hashtag"></i> 連絡先</a>
                <a href="#to-note1"><i class="fas fa-hashtag"></i> 備考</a>
                
              <!-- viewの読込み -->
                <div class="uk-margin">
                  <?php include_once('update_view/kakunin_basic_view.php'); ?>
                </div>
              </div>
              
              <input id="tab02" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab02">診療時間・診療科等</label>
              <div class="tab-content">
              <p>診療時間・診療科等</p>
              <!-- PageLink -->
                <a href="#to-BedReha"><i class="fas fa-hashtag"></i> 許可病床数・病棟種類・リハビリスタッフ</a>
                <a href="#to-week"><i class="fas fa-hashtag"></i> 診療日・手術日、診療時間</a>
                <a href="#to-Dept"><i class="fas fa-hashtag"></i> 診療科</a>
                <a href="#to-note2"><i class="fas fa-hashtag"></i> 備考</a>

              <!-- viewの読込み -->
                <div class="uk-margin">
                  <?php include_once('update_view/kakunin_department_view.php'); ?>
                </div>
              </div>

              <input id="tab03" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab03">理事長・病院長情報</label><!-- 櫻間20230105-->
              <div class="tab-content">
              <p>理事長・病院長情報</p>
              <!-- PageLink -->
                <a href="#to-Chi"><i class="fas fa-hashtag"></i> 理事長</a>
                <a href="#to-Pre"><i class="fas fa-hashtag"></i> 病院長</a>
                <a href="#to-relative"><i class="fas fa-hashtag"></i> 親族情報</a>
                <a href="#to-note3"><i class="fas fa-hashtag"></i> 備考</a>

              <!-- viewの読込み -->
                <div class="uk-margin">
                  <?php include_once('update_view/kakunin_director_view.php'); ?>
                </div>
              </div>

              <input id="tab04" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab04">部門連絡先</label>
              <div class="tab-content">
              <p>部門連絡先</p>
              <!-- PageLink -->
                <a href="#to-Fiejct"><i class="fas fa-hashtag"></i> 部門連絡先</a>
                <a href="#to-note4"><i class="fas fa-hashtag"></i> 備考</a>

              <!-- viewの読込み -->
                <div class="uk-margin">
                  <?php include_once('update_view/kakunin_number_view.php'); ?>
                </div>
              </div>


            <!-- 後半5タブ 高橋20230106追加 -->
              <input id="tab05" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab05">紹介・逆紹介</label>
              <div class="tab-content">
              <p>紹介・逆紹介</p>
              <!-- PageLink -->
                <a href="#to-kurashiki"><i class="fas fa-hashtag"></i> 附属病院（紹介・逆紹介）</a>
                <a href="#to-okayama"><i class="fas fa-hashtag"></i> 総合医療センター（紹介・逆紹介）</a>
                <a href="#to-note5"><i class="fas fa-hashtag"></i> 備考</a>
              <!-- viewの読込み -->
                <div class="uk-margin">
                  <?php include_once('update_view/kakunin_introduction_view.php'); ?>
                </div>
              </div>

              <input id="tab06" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab06">兼業</label>
              <div class="tab-content">
              <p>兼業</p>
              <!-- PageLink -->
                <a href="#to-SprtTrng"><i class="fas fa-hashtag"></i> 兼業</a>
                <a href="#to-note6"><i class="fas fa-hashtag"></i> 備考</a>
              <!-- viewの読込み -->
                <div class="uk-margin">
                  <?php include_once('update_view/kakunin_support_view.php'); ?>
                </div>
              </div>

              <input id="tab07" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab07">連携状況</label>
              <div class="tab-content">
              <p>連携状況</p>
              <!-- PageLink -->
                <!-- 高橋20231121 懇話会追加 -->
                <a href="#to-socialMeeting"><i class="fas fa-hashtag"></i> 医療連携懇話会 参加年度</a>
                <a href="#to-note7"><i class="fas fa-hashtag"></i> 備考</a>
              <!-- viewの読込み -->
                <div class="uk-margin">
                  <?php include_once('update_view/kakunin_relation_view.php'); ?>
                </div>
              </div>

              <input id="tab08" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab08">コンタクト履歴</label>
              <div class="tab-content">
              <p>コンタクト履歴</p>
              <!-- PageLink -->
                <a href="#to-contact"><i class="fas fa-hashtag"></i> コンタクト履歴</a>
                <a href="#to-note8"><i class="fas fa-hashtag"></i> 備考</a>
              <!-- viewの読込み -->
                <div class="uk-margin">
                  <?php include_once('update_view/kakunin_contact_view.php'); ?>
                </div>
              </div>

              <input id="tab09" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab09">診療内容</label>
              <div class="tab-content">
              <p>診療内容</p>
              <!-- PageLink -->
                <a href="#to-Medcare"><i class="fas fa-hashtag"></i> 受入可能な診療内容</a>
                <a href="#to-note9"><i class="fas fa-hashtag"></i> 備考</a>
              <!-- viewの読込み -->
                <div class="uk-margin">
                  <?php include_once('update_view/kakunin_Medical_view.php'); ?>
                </div>
              </div>
            </div>
          <!-- **Tabs ここまで -->
        <hr>
          <!--LOGS ここから-->
          <div class="uk-flex uk-flex-between">
              <?php //変更した人と時間を表示するようにしています。
                $d = get_log_henkou($dbh,$_SESSION['hos_cd']);
                foreach($d as $key =>$var):
              ?>
                <div>
                  <i class="fas fa-history fa-lg"></i> 最終更新日：<?php echo html_escape($var['log_data']);?>
                </div>
                <div>
                  <i class="fas fa-user-edit fa-lg"></i>
                  更新者：<?php echo html_escape(($var['log_name'])); ?>
                </div>
              <?php
                endforeach;
              ?>
          </div>
          <!--LOGS ここまで-->
      </div>

      <br>
      <!--BUTTONS-->
      <div class="uk-container uk-width-expand uk-width-5-6@l uk-flex uk-flex-between">
        <div class="uk-flex-last">
          <input type="submit" class="uk-button uk-button-large uk-button-primary" value="変更">
        </div>

        <div class="uk-flex-first">
          <!--櫻間20221104-->
            <a href="../detail/detail_control.php?cd=<?php echo html_escape($hos_cd);?>" class="uk-button uk-button-secondary uk-button-large">戻る</a>
            <!--櫻間20221104-->
        </div>
      </div>

    </main>
  </form>
  <script type="text/javascript" src="alerat1.js"></script>
</body>
</html>