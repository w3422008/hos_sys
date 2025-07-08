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
        <li><a href="/hos_sys/menu/MENU_control.php">MENU</a></li>
                <li><span>インポート選択</span></li>
      </ul>
  </header>

  <!-- **main -->
    <!--*main_body-->
    <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-widrh-1-2@m uk-width-1-2@l uk-width-1-3@xl">
        <fieldset class="uk-fieldset uk-margin" id="search-area">
            <div class="uk-margin-medium-top uk-child-width-1-1@m" uk-grid>
                <div>
                    <form action="./intro/file_select.php">
                    <button type="submit" class="button_3 uk-button uk-width-1-1"><span class=""></span> <span>紹介・逆紹介データ</span></button>
                    </form>
                </div>

                <div>
                    <form action="./training/file_select.php">
                    <button type="submit" class="button_3 uk-button uk-width-1-1"><span class=""></span> <span>兼業データ</span></button>
                    </form>
                </div>
            
                <div>
                    <form action="./contact/file_select.php">
                    <button type="submit" class="button_3 uk-button uk-width-1-1"><span class=""></span> <span>コンタクト履歴データ</span></button>
                    </form>
                </div>

<!--                 <div>
                    <form action="">
                    <button type="submit" class="button_3 uk-button uk-width-1-1"><span class="fas fa-history"></span> <span>インポート履歴</span></button>
                    </form>
                </div> -->
            </div>
        </div>
    </fieldset>
</body>
</html>