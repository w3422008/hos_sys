<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>医療機関 管理 | 医療機関情報システム</title>
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
          <li><a href="../menu/MENU_control.php">MENU</a></li>
          <li><span>医療機関 管理</span></li>
      </ul>
  </header>


<!--*main-->
<div class="uk-card uk-card-small">

  <!--*main_header-->
  <div class="uk-margin-bottom uk-container uk-width-1-2@m">
    <div class="uk-card">
    <h2 class="uk-card-header">医療機関 管理</h2>
    
    <!--button-->
    <div class="uk-margin-medium-top uk-child-width-1-1@m" uk-grid>
            <div>
            <form action="../insert/insert_control.php">
            <button class="button_3 uk-button uk-width-1-1"><span>新規追加</span></button>
            
            </form>
            </div>

            <div>
            <form action="../delete/hide_hos_control.php">
            <button class="button_3 uk-button uk-width-1-1"><span>削除</span></button>
            
            </form>
            </div>
            <!--櫻間20230511-->
            <div>
            <form action="../insert_log/insert_log_control.php">
            <button class="button_3 uk-button uk-width-1-1"><span>新規追加　ログ</span></button>
            </form>
            </div>
            <!--嶋津20230515-->
            <div>
            <form action="../delete_log/delete_log_control.php">
            <button class="button_3 uk-button uk-width-1-1"><span>削除　ログ</span></button>
            </form>
            </div>
            <!--櫻間20230511-->

          </div>
    </div>
         
</div>
</div>

</body>

</html>