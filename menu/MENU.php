<!DOCTYPE html>
<html>
<head><link rel="shortcut icon" href="../favicon.ico">
    <title>MENU | 医療機関情報システム</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--CSS/JS-->
<!-- *全画面必須 ---------->
  <!--UIkit3-->
  <link rel="stylesheet" href="../css/uikit.min.css" />
  <script src="../js/uikit.min.js"></script>
  <script src="../js/uikit-icons.min.js"></script>

  <!--style.css-->
  <link rel="stylesheet" href="../css/style.css"/>
  <link rel="stylesheet" href="../css/buttons.css" /><!--※-->
  <link rel="stylesheet" href="../css/marker.css"/><!--:*marker CSS-->

  <!--font awesome-->
  <link rel="stylesheet" href="../css/all.min.css" />
<!--------------------* -->
</head>
<body>
  <!-- **header -->
  <header uk-sticky>
    <?php include_once("../header.php"); ?>
    <!-- パンくず -->
      <ul class="uk-breadcrumb breadcrumb">
          <li><span>MENU</span></li>
      </ul>
  </header>


  <!-- **main -->
    <!--*main_body-->
    <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-widrh-1-2@m uk-width-1-2@l uk-width-1-3@xl">
      <div class="uk-margin">
        <form action="../search/checkbox_control.php">
          <button type="submit" class="button_1 uk-button-large uk-circle uk-width-1-1" name='search'><span>医療機関検索</span></button>
        </form>
      </div>

<?php
      //加藤20250527
      if($user_adm == '1' || $user_adm == '3'){
?>

        <fieldset class="uk-fieldset uk-margin" id="search-area">
          <div class="uk-margin-medium-top uk-child-width-1-1@m" uk-grid>
            <!--櫻間20221117-->
            <div>
              <!-- 医療機関 管理 -->
              <form action="../hos_management/manage_control.php">
                <button class="button_3 uk-button uk-width-1-1"><span class="fas fa-hospital"></span> <span>医療機関 管理</span></button>
              </form>
            </div>

             <!--櫻間20230801-->
            <div>
              <!-- 全件出力 -->
              <form action="../all_csv/all_control.php">
                <button class="button_3 uk-button uk-width-1-1"><span class="fas fa-hospital"></span> <span>全件出力</span></button>
              </form>
            </div>

            <div>
              <!-- インポート機能 -->
              <form action="../import/file_select.php">
                <button type="submit" class="button_3 uk-button uk-width-1-1"><span class="fas fa-file-import"></span> <span>インポート機能</span></button>
              </form>
            </div>
              <!--櫻間20221117-->
            <div>
              <!-- ユーザー管理 -->
              <form action="../user/user_MT_control.php">
                <button type="submit" class="button_3 uk-button uk-width-1-1"><span uk-icon="users"></span> <span>ユーザー管理</span></button>
              </form>
            </div>
<?php
            //加藤20250527
            if($user_adm == '3'){
?>
              <!--三宅-->
              <div>
                <!-- メッセージ管理 -->
                <form action="../message/login.php">
                  <button type="submit" class="button_3 uk-button uk-width-1-1"><span class="fas fa-envelope"></span> <span>メッセージ管理</span></button>
                </form>
              </div>
<?php
            }
?>
          </div>
        </fieldset>
<?php 
      }
?>
    </div>
</body>
</html>




