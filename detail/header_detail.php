<?php
require_once('../config.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>詳細 | 医療機関情報システム</title>
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
          
          <link rel="stylesheet" href="../css/test.css"/><!--：test-->
      <!--js-->
        <!-- table_row.js -->
        <script src="../js/table_row/rel.js"></script>
        <script src="../js/table_row/fie.js"></script>
        <!-- 高橋20231121 懇話会追加 -->
        <script src="../js/selbox/SocialMeeting.js"></script>

        <!-- 高橋20230110 5タブ目以降JS 準備中
          <script src="../js/table_row/contact.js"></script>
        -->

        <!-- 高橋20230512　都道府県・地域・地区コード・市・区・町 -->
        <?php $json = json_encode($are_cds, JSON_UNESCAPED_UNICODE); //★ 配列をJSON形式に変換 ?>
        <script>var areaCd_array = <?php echo $json; ?>;//phpから配列を取得</script>
        <script src="../js/selbox/area_selbox.js"></script>

        <!-- 高橋20230512 未入力チェック -->
        <!-- 高橋20231128追記 入力値チェック -->
        <script>
          function Check(){

            //未入力チェックここから
              let array = [];          
              /* if(document.myform.hos_cd.value==""){array.push('医療機関コード'); }//配列の末尾に追加 */
              if(document.myform.hos_name.value==""){array.push('医療機関名'); }//配列の末尾に追加
              if(document.myform.zipcode.value==""){array.push('郵便番号'); }//配列の末尾に追加
              if(document.myform.pre.value==""){array.push('都道府県'); }//配列の末尾に追加
              if(document.myform.are_cd1.value==""&&document.myform.are_cd2.value==""){array.push('地区コード'); }//配列の末尾に追加
              if(document.myform.area1.value==""&&document.myform.area2.value==""){array.push('地域'); }//配列の末尾に追加

            //未入力チェックここまで

            //入力値チェックここから
              let array2 = [];
              if(arr_strCheck(0)==false || arr_strCheck(1)==false || arr_strCheck(2)==false){
                array2.push('「医療連携懇話会 参加年度(連携状況タブ)」');
              }
            //入力値チェックここまで


          //必要に応じてアラートを出す
          if(array.length !== 0){
          alert(array.join('・') + "は必ず入力してください。");
          return false;
          }else if(array2.length !== 0){
          alert(array2.join('、') + "の入力に誤りがあります。");
          return false;
          }else {
          return true;
          }
          
          }
        </script>
        <!-- 高橋20231128追記 入力値チェック -->
        <!-- 高橋20230512 未入力チェック -->

</head>

<body>
    <!-- **header -->
    <?php include_once("../header.php"); ?>
    <header uk-sticky>
      <!-- パンくず -->
      <form class="uk-form-stacked " id="form" action="../search/search_control.php" method="POST">
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="../search/checkbox_control.php">医療機関検索</a></li>
            <li><button name="detail" value="<?php echo $page_id; ?>" id="save" class="uk-text-link" style="border:none; outline:none; background:none;">検索結果</button></li><?php //高橋20230329追記 ページング保持（管理者） ?>
            <li><span>医療機関 詳細</span></li>
        </ul>
      </form>
    </header>
    
  <!-- *Forms -->
  <form action="../update/kakunin.php" method="POST"  name="myform" onsubmit="return Check()" class="validationForm" novalidate>
    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
      <?php include_once("../footer.php"); ?>
    </footer>

    <!-- **main -->
    <main>
    <div class="uk-container uk-width-expand uk-width-5-6@l uk-card-default">
      <!-- *main_header -->
      <div class="uk-card-header">
        <h3>医療機関詳細</h3>        
        <?php
        foreach ($data as $key =>$var):
          $_SESSION['hos_cd'] = $var['hos_cd'];
        ?>
              <h1 style="display:inline;"><?php echo html_escape ($var['hos_name']);?></h1>
              <span class="uk-margin-left">医療機関コード：<u><?php echo html_escape ($var['hos_cd']); ?></u></span>
        <?php
        endforeach;
        ?>
      </div>
      

      <div class="print-area">
      <!-- *main_body -->
        <!-- **Tabs ここから -->
          <div class="tab-wrap">
          <!-- 前半4タブ -->
            <input id="tab01" type="radio" name="tab" class="tab-switch" checked="checked"><label class="tab-label" for="tab01">基本情報</label>
            <div class="tab-content non-printable" id="tab-content01">
            <p>基本情報</p>
            <!-- PageLink -->
              <a href="#to-hospitalName" uk-scroll><i class="fas fa-hashtag"></i> 医療機関名</a>
              <a href="#to-kubun" uk-scroll><i class="fas fa-hashtag"></i> 区分</a>
              <a href="#to-Medass" uk-scroll><i class="fas fa-hashtag"></i> 医師会</a>
              <a href="#to-area" uk-scroll><i class="fas fa-hashtag"></i> 所在地</a>
              <a href="#to-address" uk-scroll><i class="fas fa-hashtag"></i> 連絡先</a>
              <a href="#to-note1" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>
              
            <!-- viewの読込み -->
              <div class="uk-margin tab-print">
                <?php include_once('./view/basic_view.php'); ?>
              </div>
            </div>
            
            <input id="tab02" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab02">診療時間・診療科等</label>
            <div class="tab-content non-printable" id="tab-content02">
            <p>診療時間・診療科等</p>
            <!-- PageLink -->
              <a href="#to-BedReha" uk-scroll><i class="fas fa-hashtag"></i> 許可病床数・病棟種類・リハビリスタッフ</a>
              <a href="#to-week" uk-scroll><i class="fas fa-hashtag"></i> 診療日・手術日、診療時間</a>
              <a href="#to-Dept" uk-scroll><i class="fas fa-hashtag"></i> 診療科</a>
              <a href="#to-note2" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>

            <!-- viewの読込み -->
              <div class="uk-margin tab-print">
                <?php include_once('./view/department_view.php'); ?>
              </div>
            </div>

            <input id="tab03" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab03">理事長・病院長情報</label><!-- 櫻間20230105-->
            <div class="tab-content non-printable" id="tab-content03">
            <p>理事長・病院長情報</p>
            <!-- PageLink -->
              <a href="#to-Chi" uk-scroll><i class="fas fa-hashtag"></i> 理事長</a>
              <a href="#to-Pre" uk-scroll><i class="fas fa-hashtag"></i> 病院長</a>
              <a href="#to-relative" uk-scroll><i class="fas fa-hashtag"></i> 親族情報</a>
              <a href="#to-note3" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>

            <!-- viewの読込み -->
              <div class="uk-margin tab-print">
                <?php include_once('./view/director_view.php'); ?>
              </div>
            </div>

            <input id="tab04" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab04">部門連絡先</label>
            <div class="tab-content non-printable" id="tab-content04">
            <p>部門連絡先</p>
            <!-- PageLink -->
              <a href="#to-Fiejct" uk-scroll><i class="fas fa-hashtag"></i> 部門連絡先</a>
              <a href="#to-note4" uk-scroll><i class="fas fa-hashtag"></i> 備考</a>

            <!-- viewの読込み -->
              <div class="uk-margin tab-print">
                <?php include_once('./view/number_view.php'); ?>
              </div>
            </div>

          <!-- 後半5タブ 高橋20230106追加 -->
            <input id="tab05" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab05">紹介・逆紹介</label>
            <div class="tab-content non-printable" id="tab-content05">
            <p>紹介・逆紹介</p>
            <!-- PageLink -->
              <a href="#to-kurashiki"><i class="fas fa-hashtag"></i> 附属病院（紹介・逆紹介）</a>
              <a href="#to-okayama"><i class="fas fa-hashtag"></i> 総合医療センター（紹介・逆紹介）</a>
              <a href="#to-note5"><i class="fas fa-hashtag"></i> 備考</a>
            <!-- viewの読込み -->
              <div class="uk-margin tab-print">
                <?php include_once('./view/introduction_view.php'); ?>
              </div>
            </div>

            <input id="tab06" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab06">兼業</label>
            <div class="tab-content non-printable" id="tab-content06">
            <p>兼業</p>
            <!-- PageLink -->
              <a href="#to-SprtTrng"><i class="fas fa-hashtag"></i> 兼業</a>
              <a href="#to-note6"><i class="fas fa-hashtag"></i> 備考</a>
            <!-- viewの読込み -->
              <div class="uk-margin tab-print">
                <?php include_once('./view/support_view.php'); ?>
              </div>
            </div>

            <input id="tab07" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab07">連携状況</label>
            <div class="tab-content non-printable" id="tab-content07">
            <p>連携状況</p>
            <!-- PageLink -->
              <a href="#to-carna"><i class="fas fa-hashtag"></i> カルナコネクト</a>
              <a href="#to-path"><i class="fas fa-hashtag"></i> 連携パス</a>
              <a href="#to-socialMeeting"><i class="fas fa-hashtag"></i> 医療連携懇話会 参加年度</a><!-- 高橋20231121 懇話会追加 -->
              <a href="#to-note7"><i class="fas fa-hashtag"></i> 備考</a>
            <!-- viewの読込み -->
              <div class="uk-margin tab-print">
                <?php include_once('./view/relation_view.php'); ?>
              </div>
            </div>
            
            <input id="tab08" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab08">コンタクト履歴</label>
            <div class="tab-content non-printable" id="tab-content08">
            <p>コンタクト履歴</p>
            <!-- PageLink -->
              <a href="#to-contact"><i class="fas fa-hashtag"></i> コンタクト履歴</a>
              <a href="#to-note8"><i class="fas fa-hashtag"></i> 備考</a>
            <!-- viewの読込み -->
              <div class="uk-margin tab-print">
                <?php include_once('./view/contact_view.php'); ?>
              </div>
            </div>

            <input id="tab09" type="radio" name="tab" class="tab-switch"><label class="tab-label" for="tab09">診療内容</label>
            <div class="tab-content non-printable" id="tab-content09">
            <p>診療内容</p>
            <!-- PageLink -->
              <a href="#to-Medcare"><i class="fas fa-hashtag"></i> 受入可能な診療内容</a>
              <a href="#to-note9"><i class="fas fa-hashtag"></i> 備考</a>
            <!-- viewの読込み -->
              <div class="uk-margin tab-print">
                <?php include_once('./view/Medical_view.php'); ?>
              </div>
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
    <!--BUTTONS ここから-->
    <div class="uk-flex uk-flex-center">
    <?php foreach ($data as $key =>$var): ?>
      <div>
      <a href="../delete/hide_control.php?sid=<?php echo $var['hos_cd'];?>" class="uk-button uk-button-large uk-button-default"><i class="fas fa-ban fa-2x"></i> 停止</a>  
      </div>
    <?php endforeach; ?>
      <div>
      <button type="submit" class="uk-button uk-button-large uk-button-default"><i class="fas fa-edit fa-2x"></i> 変更</button>
      </div>

      <!-- 20241001 三宅 -->
      <!-- ページ全体を印刷するボタン -->
      <!-- ドロップダウンメニューと印刷ボタン -->
      <div class="uk-inline">
          <button id="printPageButton" class="uk-button uk-button-large uk-button-default" type="button"><i class="fas fa-print fa-2x"></i> 印刷</button>
            <div uk-dropdown="mode: click">
              <ul class="uk-nav uk-dropdown-nav">
                <li><a href="#" id="tab-content01" data-tab-name="基本情報" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">基本情報</a></li>
                <li><a href="#" id="tab-content02" data-tab-name="診療時間・診療科等" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">診療時間・診療科等</a></li>
                <li><a href="#" id="tab-content03" data-tab-name="理事長・病院長情報" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">理事長・病院長情報</a></li>
                <li><a href="#" id="tab-content04" data-tab-name="部門連絡先" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">部門連絡先</a></li>
                <li><a href="#" id="tab-content05" data-tab-name="紹介・逆紹介" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">紹介・逆紹介</a></li>
                <li><a href="#" id="tab-content06" data-tab-name="兼業" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">兼業</a></li>
                <li><a href="#" id="tab-content07" data-tab-name="連携状況" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">連携状況</a></li>
                <li><a href="#" id="tab-content08" data-tab-name="コンタクト履歴" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">コンタクト履歴</a></li>
                <li><a href="#" id="tab-content09" data-tab-name="診療内容" onclick="printTab(this.id, this.getAttribute('data-tab-name'))">診療内容</a></li>
              </ul>
            </div>
        </div>

      <!-- 20241107 三宅_印刷ボタンのjava-->
        <script src="./print.js"></script>   
    </main>
  </form>
  <!--BUTTONS ここまで-->


<!-- checkbox.js 高橋20230123 -->
<script src="../js/checkbox/week_checkbox.js"></script>
<script src="../js/checkbox/week_checkbox2.js"></script>


<!--櫻間-->
<script>
    //.validationForm を指定した（最初の）要素を取得
const validationForm = document.querySelector('.validationForm');
//pattern クラスを指定された要素の集まり
const patternElems =  document.querySelectorAll('.pattern');
 
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
                //data-pattern 属性の値が tel の場合
                case 'tel' :
          pattern = /^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/;
          errorMessage = '電話番号の形式が正しくありません。ハイフンありで数字10桁を入力してください。';
          break;
                  //data-pattern 属性の値が fax の場合
        case 'fax' :
          pattern = /^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/;
          errorMessage = 'FAX番号の形式が正しくありません。ハイフンありで数字10桁を入力してください。';
          break;
           //data-pattern 属性の値が mail の場合
        case 'mail' :
          pattern = /^[a-zA-Z0-9_.+-]+[@][a-zA-Z0-9.-]+$/;
          errorMessage = 'メールアドレスの形式が正しくありません。正しい形で入力してください。';
          break;
        //data-pattern 属性の値が zip の場合
        case 'zip' :
          pattern = /^[0-9]{7}$/;
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
      }
    }
  });
  
}); 
</script>
<script>
    //エラーメッセージを表示する span 要素を生成して親要素に追加する関数
    const createError = (elem, errorMessage) => {
      const errorSpan = document.createElement('span');
      errorSpan.classList.add('error');
      errorSpan.setAttribute('aria-live', 'polite');
      errorSpan.textContent = errorMessage;
      elem.parentNode.appendChild(errorSpan);
    }
    </script>
<!--櫻間-->




<!-- alert.js 高橋20230418 -->
<script src="../js/alert.js"></script>

</body>
</html>
