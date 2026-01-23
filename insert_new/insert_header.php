<!DOCTYPE html>
<html lang="ja">

<head>
  <link rel="shortcut icon" href="../favicon.ico">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>医療機関 新規追加 | 医療機関情報システム</title>
  <!--CSS/JS-->
  <!-- *全画面必須 ---------->
  <!--UIkit3-->
  <link rel="stylesheet" href="../css/uikit.min.css" />
  <script src="../js/uikit.min.js"></script>
  <script src="../js/uikit-icons.min.js"></script>
  <link rel="stylesheet" href="../css/uk-custom.css">
  <!--style.css-->
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/tables.css" />
  <link rel="stylesheet" href="../css/form_parts.css" />
  <link rel="stylesheet" href="../css/marker.css" /><!--:*marker CSS-->
  <!--*font awesome-->
  <link rel="stylesheet" href="../css/all.min.css" />
  <!--------------------* -->
  <link rel="stylesheet" href="../css/cards.css" />
  <link rel="stylesheet" href="../css/tab.css" /><!--：タブ-->

</head>

<body>
  <!-- **header -->
  <?php include_once("../header.php"); ?>
  <header uk-sticky>
    <!-- パンくず -->
    <form class="uk-form-stacked " id="form" action="../hos_management/manage_control.php" method="POST">
      <ul class="uk-breadcrumb breadcrumb">
        <li><a href="../menu/MENU_control.php">MENU</a></li>
        <li><button class="uk-text-link" id="save" style="border:none; outline:none; background:none;">医療機関管理</button>
        </li>
        <?php echo isset($_GET['code_editor']) ? '<li><a href="../code_editor/code_editor.php">医療機関情報の引き継ぎ</a></li>' : ''; ?>
        <li><span>医療機関 新規追加<?php echo isset($_GET['code_editor']) ? '(情報引き継ぎ)' : ''; ?></span></li>
      </ul>
    </form>
  </header>

  <!-- *Forms -->
  <form action="check_control.php" method="POST" name="myform" onsubmit="return Check()" class="validationForm"
    novalidate>
    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
      <?php include_once("../footer.php"); ?>
    </footer>

    <!--**main-->
    <main>
      <div class="uk-alert-success" uk-alert>
        <div class="uk-card-header">
          <h2><i class="fas fa-plus fa-lg"></i> 医療機関 新規追加<?php echo isset($_GET['code_editor']) ? '(情報引き継ぎ)' : ''; ?>
          </h2>
          <p><?php echo isset($_GET['code_editor']) ? '医療機関コードを除き、以前の情報を表示しています。新たな' : '新しく登録する'; ?>医療機関の情報を入力して下さい。</p>
        </div>
      </div>

      <div class="uk-container uk-width-expand uk-width-5-6@l uk-card-default">
        <!--*main_header-->
        <!-- 高橋20230331追加　アラートアイコン　ここから -->
        <div class="uk-card-header">
          <h3>医療機関 新規追加<?php echo isset($_GET['code_editor']) ? '(情報引き継ぎ)' : ''; ?></h3>
          <input type=text class="uk-input size-input-hosName" name="hos_name" placeholder="医療機関名を入力"
            value="<?php if (isset($hos_name)) {
              echo $hos_name;
            } ?>" style="display:inline;">
          <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left"
            tabindex="-1"></i><!--高橋20230331追加　tabindex-->

          <span class="uk-margin-left">医療機関コード：
            <input type=text class="uk-input size-input-hosCd pattern" name="hos_cd" maxlength="10" data-pattern="code"
              value="<?php if (isset($hos_cd)) {
                echo $hos_cd;
              } ?>">
            <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left"
              tabindex="-1"></i><!--高橋20230331追加　tabindex-->
          </span>
        </div>
        <!-- 高橋20230331追加ここまで -->


        <!-- *main_body -->
        <!-- **Tabs ここから -->
        <div class="tab-wrap">
          <!-- 前半4タブ -->
          <input id="tab01" type="radio" name="tab" class="tab-switch" checked="checked"><label class="tab-label"
            for="tab01">基本情報</label>
          <div class="tab-content">
            <p>基本情報</p>
            <!-- PageLink -->
            <a href="#to-kubun" uk-scroll><i class="fas fa-hashtag"></i> 区分</a>
            <a href="#to-Medass" uk-scroll><i class="fas fa-hashtag"></i> 医師会</a>
            <a href="#to-area" uk-scroll><i class="fas fa-hashtag"></i> 所在地</a>
            <a href="#to-address" uk-scroll><i class="fas fa-hashtag"></i> 連絡先</a>
            <a href="#to-note1" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>

            <!-- viewの読込み -->
            <div class="uk-margin">
              <?php include_once('./insert_view/basic_view.php'); ?>
            </div>
          </div>

          <input id="tab02" type="radio" name="tab" class="tab-switch"><label class="tab-label"
            for="tab02">診療時間・診療科等</label>
          <div class="tab-content">
            <p>診療時間・診療科等</p>
            <!-- PageLink -->
            <a href="#to-BedReha" uk-scroll><i class="fas fa-hashtag"></i> 許可病床数・病棟種類・リハビリスタッフ</a>
            <a href="#to-week" uk-scroll><i class="fas fa-hashtag"></i> 診療日・手術日、診療時間</a>
            <a href="#to-Dept" uk-scroll><i class="fas fa-hashtag"></i> 診療科</a>
            <a href="#to-note2" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>

            <!-- viewの読込み -->
            <div class="uk-margin">
              <?php include_once('./insert_view/department_view.php'); ?>
            </div>
          </div>

          <input id="tab03" type="radio" name="tab" class="tab-switch"><label class="tab-label"
            for="tab03">理事長・病院長情報</label><!-- 櫻間20230105-->
          <div class="tab-content">
            <p>理事長・病院長情報</p>
            <!-- PageLink -->
            <a href="#to-Chi" uk-scroll><i class="fas fa-hashtag"></i> 理事長</a>
            <a href="#to-Pre" uk-scroll><i class="fas fa-hashtag"></i> 病院長</a>
            <a href="#to-relative" uk-scroll><i class="fas fa-hashtag"></i> 親族情報</a>
            <a href="#to-note3" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>

            <!-- viewの読込み -->
            <div class="uk-margin">
              <?php include_once('./insert_view/director_view.php'); ?>
            </div>
          </div>

          <input id="tab04" type="radio" name="tab" class="tab-switch"><label class="tab-label"
            for="tab04">部門連絡先</label>
          <div class="tab-content">
            <p>部門連絡先</p>
            <!-- PageLink -->
            <a href="#to-Fiejct" uk-scroll><i class="fas fa-hashtag"></i> 部門連絡先</a>
            <a href="#to-note4" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>

            <!-- viewの読込み -->
            <div class="uk-margin">
              <?php include_once('./insert_view/number_view.php'); ?>
            </div>
          </div>

          <!-- 後半5タブ 高橋20230106追加 -->
          <input id="tab05" type="radio" name="tab" class="tab-switch"><label class="tab-label"
            for="tab05">紹介・逆紹介</label>
          <div class="tab-content">
            <p>紹介・逆紹介</p>
            <!-- viewの読込み -->
            <div class="uk-margin">
              <?php include_once('./insert_view/introduction_view.php'); ?>
            </div>
          </div>

          <input id="tab06" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab06">兼業</label>
          <div class="tab-content">
            <p>院外支援・研修</p>
            <!-- viewの読込み -->
            <div class="uk-margin">
              <?php include_once('./insert_view/support_view.php'); ?>
            </div>
          </div>

          <input id="tab07" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab07">連携状況</label>
          <div class="tab-content">
            <p>連携状況</p>
            <!-- PageLink -->
            <a href="#to-carna" uk-scroll><i class="fas fa-hashtag"></i> カルナコネクト</a>
            <a href="#to-path" uk-scroll><i class="fas fa-hashtag"></i> 連携パス</a>
            <a href="#to-socialMeeting" uk-scroll><i class="fas fa-hashtag"></i> 医療連携懇話会
              参加年度</a><!-- 高橋20231121 懇話会追加 -->
            <a href="#to-note7" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>
            <!-- viewの読込み -->
            <div class="uk-margin">
              <?php include_once('./insert_view/relation_view.php'); ?>
            </div>
          </div>

          <!--高橋8タブ目（コンタクト履歴）：7月1日の導入については見送り　のため非表示-->
          <input id="tab08" type="radio" name="tab" class="tab-switch"><label class="tab-label"
            for="tab08">コンタクト履歴</label>
          <div class="tab-content">
            <p>コンタクト履歴</p>
            <!-- viewの読込み -->
            <div class="uk-margin">
              <?php include_once('./insert_view/contact_view.php'); ?>
            </div>
          </div>

          <!--高橋8タブ目（コンタクト履歴）：7月1日の導入については見送り　のため非表示　 -->

          <input id="tab09" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab09">診療内容</label>
          <div class="tab-content">
            <p>診療内容</p>
            <!-- PageLink -->
            <a href="#to-Medcare" uk-scroll><i class="fas fa-hashtag"></i> 受入可能な診療内容</a>
            <a href="#to-note9" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>
            <!-- viewの読込み -->
            <div class="uk-margin">
              <?php include_once('./insert_view/Medical_view.php'); ?>
            </div>
          </div>
        </div>
        <!-- **Tabs ここまで -->
      </div>

      <div class="uk-card-footer uk-container uk-width-expand uk-flex uk-flex-center">
        <div>
          <!--BUTTONS-->
          <button type="submit" class="uk-button uk-button-large uk-button-primary">確認</button>
        </div>
      </div>

    </main>
  </form>


  <!--js-->
  <!-- table_row.js -->
  <script src="../js/table_row/rel.js"></script>
  <script src="../js/table_row/fie.js"></script>
  <script src="../js/selbox/SocialMeeting.js"></script><!-- 高橋20231121 懇話会追加 -->

  <!-- 高橋20230512　都道府県・地域・地区コード・市・区・町 -->
  <?php $json = json_encode($are_cds, JSON_UNESCAPED_UNICODE); //★ 配列をJSON形式に変換 ?>
  <script>var areaCd_array = <?php echo $json; ?>;//phpから配列を取得</script>
  <script src="../js/selbox/area_selbox.js"></script>

  <!-- checkbox.js 高橋20230123 -->
  <script src="../js/checkbox/week_checkbox.js"></script>
  <script src="../js/checkbox/week_checkbox2.js"></script>


  <script src="./insert_js/validation.js"></script>
  <script src="./insert_js/form_validation.js"></script>
  <script src="./insert_js/error_handler.js"></script>

  <!-- alert.js 高橋20230418 -->
  <script src="../js/alert.js"></script>
</body>

</html>