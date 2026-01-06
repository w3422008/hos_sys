<?php
require_once('../config.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <link rel="shortcut icon" href="../favicon.ico">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>詳細 | 医療機関情報システム</title>
  
  <!-- CSS/JS -->
  <link rel="stylesheet" href="../css/uikit.min.css" />
  <script src="../js/uikit.min.js"></script>
  <script src="../js/uikit-icons.min.js"></script>
  <link rel="stylesheet" href="../css/uk-custom.css">
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/tables.css" />
  <link rel="stylesheet" href="../css/form_parts.css" />
  <link rel="stylesheet" href="../css/marker.css" />
  <link rel="stylesheet" href="../css/all.min.css" />
  <link rel="stylesheet" href="../css/cards.css" />
  <link rel="stylesheet" href="../css/tab.css" />
  <link rel="stylesheet" href="../css/test.css" />
  
  <style>
    .uk-input, .uk-select, .uk-textarea {
      border-color: #000;
    }
  </style>
  
  <!-- JavaScript -->
  <script src="../js/table_row/rel.js"></script>
  <script src="../js/table_row/fie.js"></script>
  <script src="../js/selbox/SocialMeeting.js"></script>
  
  <?php if($user_type === 'admin'): ?>
    <?php $json = json_encode($are_cds, JSON_UNESCAPED_UNICODE); ?>
    <script>var areaCd_array = <?php echo $json; ?>;</script>
    <script src="../js/selbox/area_selbox.js"></script>
    
    <script>
    function Check() {
      let array = [];
      if (document.myform.hos_name.value == "") { array.push('医療機関名'); }
      if (document.myform.zipcode.value == "") { array.push('郵便番号'); }
      if (document.myform.pre.value == "") { array.push('都道府県'); }
      if (document.myform.are_cd1.value == "" && document.myform.are_cd2.value == "") { array.push('地区コード'); }
      if (document.myform.area1.value == "" && document.myform.area2.value == "") { array.push('地域'); }

      let array2 = [];
      if (arr_strCheck(0) == false || arr_strCheck(1) == false || arr_strCheck(2) == false) {
        array2.push('「医療連携懇話会 参加年度(連携状況タブ)」');
      }

      if (array.length !== 0) {
        alert(array.join('・') + "は必ず入力してください。");
        return false;
      } else if (array2.length !== 0) {
        alert(array2.join('、') + "の入力に誤りがあります。");
        return false;
      } else {
        return true;
      }
    }
    </script>
  <?php endif; ?>
</head>

<body>
  <!-- Header -->
  <?php include_once("../header.php"); ?>
  
  <header uk-sticky>
    <?php if($user_type === 'admin'): ?>
      <!-- Admin用パンくず -->
      <form class="uk-form-stacked" id="form" action="../search/search_control.php" method="POST">
        <ul class="uk-breadcrumb breadcrumb">
          <li><a href="../menu/MENU_control.php">MENU</a></li>
          <li><a href="../search/checkbox_control.php">医療機関検索</a></li>
          <li><button name="detail" value="<?php echo $page_id; ?>" id="save" class="uk-text-link" style="border:none; outline:none; background:none;">検索結果</button></li>
          <li><span>医療機関 詳細</span></li>
        </ul>
      </form>
    <?php else: ?>
      <!-- Office/User用パンくず -->
      <ul class="uk-breadcrumb breadcrumb">
        <li><a href="../search/checkbox_control.php">医療機関検索</a></li>
        <li><a href="../search/search_control.php?page_id=<?php echo $page_id; ?>">検索結果</a></li>
        <li><span>医療機関 詳細</span></li>
      </ul>
    <?php endif; ?>
  </header>

  <!-- Footer -->
  <footer uk-sticky="position: bottom">
    <?php include_once("../footer.php"); ?>
  </footer>

  <!-- Main -->
  <main>
    <div class="uk-container uk-width-expand uk-width-5-6@l uk-card-default">
      <!-- Main Header -->
      <div class="uk-card-header">
        <h3>医療機関詳細</h3>
        <?php foreach ($data as $key => $var): ?>
          <h1 style="display:inline;"><?php echo html_escape($var['hos_name']); ?></h1>
          <span class="uk-margin-left">医療機関コード：<u><?php echo $hos_cd; ?></u></span>
        <?php endforeach; ?>
      </div>

      <!-- Form / Content -->
      <?php if($user_type === 'admin'): ?>
        <form action="../update/kakunin.php" method="POST" name="myform" onsubmit="return Check()" class="validationForm" novalidate>
      <?php else: ?>
        <form name="myform" class="validationForm" novalidate>
      <?php endif; ?>
      
      <div class="print-area">
        <!-- Tabs -->
        <div class="tab-wrap">
          <!-- Tab 01: 基本情報 -->
          <input id="tab01" type="radio" name="tab" class="tab-switch" checked="checked">
          <label class="tab-label" for="tab01">基本情報</label>
          <div class="tab-content <?php echo $user_type === 'admin' ? 'non-printable' : ''; ?>" id="tab-content01">
            <p>基本情報</p>
            <a href="#to-hospitalName" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 医療機関名</a>
            <a href="#to-kubun" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 区分</a>
            <a href="#to-Medass" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 医師会</a>
            <a href="#to-area" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 所在地</a>
            <a href="#to-address" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 連絡先</a>
            <a href="#to-note1" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 備考</a>
            
            <div class="uk-margin tab-print">
              <?php include_once('./view/basic_view.php'); ?>
            </div>
          </div>

          <!-- Tab 02: 診療時間・診療科等 -->
          <input id="tab02" type="radio" name="tab" class="tab-switch">
          <label class="tab-label" for="tab02">診療時間・診療科等</label>
          <div class="tab-content <?php echo $user_type === 'admin' ? 'non-printable' : ''; ?>" id="tab-content02">
            <p>診療時間・診療科等</p>
            <a href="#to-BedReha" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 許可病床数・病棟種類・リハビリスタッフ</a>
            <a href="#to-week" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 診療日・手術日、診療時間</a>
            <a href="#to-Dept" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 診療科</a>
            <a href="#to-note2" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 備考</a>
            
            <div class="uk-margin tab-print">
              <?php include_once('./view/department_view.php'); ?>
            </div>
          </div>

          <!-- Tab 03: 理事長・病院長情報（管理者用） -->
          <?php if($user_type === 'admin'): ?>
          <input id="tab03" type="radio" name="tab" class="tab-switch">
          <label class="tab-label" for="tab03">理事長・病院長情報</label>
          <div class="tab-content non-printable" id="tab-content03">
            <p>理事長・病院長情報</p>
            <a href="#to-Chi" uk-scroll><i class="fas fa-hashtag"></i> 理事長</a>
            <a href="#to-Pre" uk-scroll><i class="fas fa-hashtag"></i> 病院長</a>
            <a href="#to-relative" uk-scroll><i class="fas fa-hashtag"></i> 親族情報</a>
            <a href="#to-note3" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>
            
            <div class="uk-margin tab-print">
              <?php include_once('./view/director_view.php'); ?>
            </div>
          </div>
          <?php endif; ?>

          <!-- Tab 04: 部門連絡先 -->
          <input id="tab04" type="radio" name="tab" class="tab-switch">
          <label class="tab-label" for="tab04">部門連絡先</label>
          <div class="tab-content <?php echo $user_type === 'admin' ? 'non-printable' : ''; ?>" id="tab-content04">
            <p>部門連絡先</p>
            <a href="#to-Fiejct" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 部門連絡先</a>
            <a href="#to-note4" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 備考</a>
            
            <div class="uk-margin tab-print">
              <?php include_once('./view/number_view.php'); ?>
            </div>
          </div>

          <!-- Tab 05: 紹介・逆紹介 -->
          <input id="tab05" type="radio" name="tab" class="tab-switch">
          <label class="tab-label" for="tab05">紹介・逆紹介</label>
          <div class="tab-content <?php echo $user_type === 'admin' ? 'non-printable' : ''; ?>" id="tab-content05">
            <p>紹介・逆紹介</p>
            <a href="#to-kurashiki" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 附属病院（紹介・逆紹介）</a>
            <a href="#to-okayama" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 総合医療センター（紹介・逆紹介）</a>
            <a href="#to-note5" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 備考</a>
            
            <div class="uk-margin tab-print">
              <?php include_once('./view/introduction_view.php'); ?>
            </div>
          </div>

          <!-- Tab 06: 兼業 -->
          <input id="tab06" type="radio" name="tab" class="tab-switch">
          <label class="tab-label" for="tab06">兼業</label>
          <div class="tab-content <?php echo $user_type === 'admin' ? 'non-printable' : ''; ?>" id="tab-content06">
            <p>兼業</p>
            <a href="#to-SprtTrng" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 兼業</a>
            <a href="#to-note6" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 備考</a>
            
            <div class="uk-margin tab-print">
              <?php include_once('./view/support_view.php'); ?>
            </div>
          </div>

          <!-- Tab 07: 連携状況 -->
          <input id="tab07" type="radio" name="tab" class="tab-switch">
          <label class="tab-label" for="tab07">連携状況</label>
          <div class="tab-content <?php echo $user_type === 'admin' ? 'non-printable' : ''; ?>" id="tab-content07">
            <p>連携状況</p>
            <a href="#to-carna" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> カルナコネクト</a>
            <a href="#to-path" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 連携パス</a>
            <a href="#to-socialMeeting" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 医療連携懇話会 参加年度</a>
            <a href="#to-note7" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 備考</a>
            
            <div class="uk-margin tab-print">
              <?php include_once('./view/relation_view.php'); ?>
            </div>
          </div>

          <!-- Tab 08: コンタクト履歴 -->
          <input id="tab08" type="radio" name="tab" class="tab-switch">
          <label class="tab-label" for="tab08">コンタクト履歴</label>
          <div class="tab-content <?php echo $user_type === 'admin' ? 'non-printable' : ''; ?>" id="tab-content08">
            <p>コンタクト履歴</p>
            <a href="#to-contact" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> コンタクト履歴</a>
            <a href="#to-note8" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 備考</a>
            
            <div class="uk-margin tab-print">
              <?php include_once('./view/contact_view.php'); ?>
            </div>
          </div>

          <!-- Tab 09: 診療内容 -->
          <input id="tab09" type="radio" name="tab" class="tab-switch">
          <label class="tab-label" for="tab09">診療内容</label>
          <div class="tab-content <?php echo $user_type === 'admin' ? 'non-printable' : ''; ?>" id="tab-content09">
            <p>診療内容</p>
            <a href="#to-Medcare" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 受入可能な診療内容</a>
            <a href="#to-note9" <?php echo $user_type === 'admin' ? 'uk-scroll' : ''; ?>><i class="fas fa-hashtag"></i> 備考</a>
            
            <div class="uk-margin tab-print">
              <?php include_once('./view/Medical_view.php'); ?>
            </div>
          </div>
        </div>
      </div>

      <hr>
      
      <!-- Logs -->
      <div class="uk-flex uk-flex-between">
        <?php
        $d = get_log_henkou($dbh, $_SESSION['hos_cd']);
        foreach ($d as $key => $var):
        ?>
          <div>
            <i class="fas fa-history fa-lg"></i> 最終更新日：<?php echo html_escape($var['log_data']); ?>
          </div>
          <div>
            <i class="fas fa-user-edit fa-lg"></i>
            更新者：<?php echo html_escape($var['log_name']); ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <br>
    
    <!-- Buttons -->
    <div class="uk-flex uk-flex-center">
      <?php if($user_type === 'admin'): ?>
          <div>
            <a href="../delete/hide_control.php?sid=<?php echo $hos_cd; ?>" class="uk-button uk-button-large uk-button-default">
              <i class="fas fa-ban fa-2x"></i> 停止
            </a>
          </div>
        <div>
          <button type="submit" class="uk-button uk-button-large uk-button-default">
            <i class="fas fa-edit fa-2x"></i> 変更
          </button>
        </div>
      <?php endif; ?>
      
      <!-- Print Button -->
      <div class="uk-inline">
        <button id="printPageButton" class="uk-button uk-button-large uk-button-default" type="button">
          <i class="fas fa-print fa-2x"></i> 印刷
        </button>
        <div uk-dropdown="mode: click">
          <ul class="uk-nav uk-dropdown-nav">
            <li><a href="#" id="tab-content01" data-tab-name="基本情報" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">基本情報</a></li>
            <li><a href="#" id="tab-content02" data-tab-name="診療時間・診療科等" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">診療時間・診療科等</a></li>
            <?php if($user_type === 'admin'): ?>
              <li><a href="#" id="tab-content03" data-tab-name="理事長・病院長情報" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">理事長・病院長情報</a></li>
            <?php endif; ?>
            <li><a href="#" id="tab-content04" data-tab-name="部門連絡先" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">部門連絡先</a></li>
            <li><a href="#" id="tab-content05" data-tab-name="紹介・逆紹介" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">紹介・逆紹介</a></li>
            <li><a href="#" id="tab-content06" data-tab-name="兼業" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">兼業</a></li>
            <li><a href="#" id="tab-content07" data-tab-name="連携状況" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">連携状況</a></li>
            <li><a href="#" id="tab-content08" data-tab-name="コンタクト履歴" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">コンタクト履歴</a></li>
            <li><a href="#" id="tab-content09" data-tab-name="診療内容" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">診療内容</a></li>
          </ul>
        </div>
      </div>
      
      <script src="./print.js"></script>
    </div>
    
    </form>
  </main>

  <!-- Checkbox Scripts -->
  <script src="../js/checkbox/week_checkbox.js"></script>
  <script src="../js/checkbox/week_checkbox2.js"></script>

  <!-- Form Validation -->
  <script>
    const validationForm = document.querySelector('.validationForm');
    const patternElems = document.querySelectorAll('.pattern');

    validationForm.addEventListener('submit', (e) => {
      const errorElems = e.currentTarget.querySelectorAll('.error');
      errorElems.forEach((elem) => { elem.remove(); });

      patternElems.forEach((elem) => {
        let dataPattern = elem.getAttribute('data-pattern');
        let pattern;
        let errorMessage = '入力された形式が正しくないようです。';
        
        if (dataPattern) {
          switch (dataPattern) {
            case 'tel':
              pattern = /^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/;
              errorMessage = '電話番号の形式が正しくありません。ハイフンありで数字10桁を入力してください。';
              break;
            case 'fax':
              pattern = /^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/;
              errorMessage = 'FAX番号の形式が正しくありません。ハイフンありで数字10桁を入力してください。';
              break;
            case 'mail':
              pattern = /^[a-zA-Z0-9_.+-]+[@][a-zA-Z0-9.-]+$/;
              errorMessage = 'メールアドレスの形式が正しくありません。正しい形で入力してください。';
              break;
            case 'zip':
              pattern = /^[0-9]{7}$/;
              errorMessage = '郵便番号の形式が正しくありません。ハイフンなしで7桁の数字を入力してください。';
              break;
            case 'year':
              pattern = /^(19|20)\d{2}$/;
              errorMessage = '年度の形式が正しくありません。4桁の数字で西暦を入力してください。';
              break;
            default:
              pattern = new RegExp(dataPattern);
          }
        }

        if (elem.value.trim() !== '' && !pattern.test(elem.value)) {
          createError(elem, errorMessage);
          e.preventDefault();
        }
      });
    });

    const createError = (elem, errorMessage) => {
      const errorSpan = document.createElement('span');
      errorSpan.classList.add('error');
      errorSpan.setAttribute('aria-live', 'polite');
      errorSpan.textContent = errorMessage;
      elem.parentNode.appendChild(errorSpan);
    }
  </script>

  <script src="../js/alert.js"></script>
</body>
</html>
