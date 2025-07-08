<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>全件出力</title>
    <!--CSS/JS-->
    <!-- *全画面必須 ---------->
        <!--UIkit3-->
        <link rel="stylesheet" href="../css/uikit.min.css" />
        <script src="../js/uikit.min.js"></script>
        <script src="../js/uikit-icons.min.js"></script>
        <link rel="stylesheet" href="../css/uk-custom.css">
        <!--style.css-->
        <link rel="stylesheet" href="../css/style.css"/>
          <link rel="stylesheet" href="../css/buttons.css" /><!--※-->
        <link rel="stylesheet" href="../css/tables.css"/>
        <link rel="stylesheet" href="../css/form_parts.css" />
        <link rel="stylesheet" href="../css/marker.css"/><!--:*marker CSS-->
        <!--*font awesome-->
        <link rel="stylesheet" href="../css/all.min.css" />
    <!--------------------* -->
        <link rel="stylesheet" href="../css/cards.css"/>
    <style>
    </style>
</head>
<!--櫻間20230801-->
<body>
    <!-- **header -->
    <?php include_once("../header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><span>全件出力</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
      <?php include_once("../footer.php"); ?>
    </footer>

    <!-- **main -->    
    <main>
        <div class="uk-alert-success" uk-alert>
        <div class="uk-card-header">
        <h2>全件出力</h2>
            <p>医療機関情報の基本情報を全件出力します。</p>
        </div>
        </div>

        <!--button-->
        <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-widrh-1-2@m uk-width-1-2@l uk-width-1-3@xl">
            <div class="uk-margin">
        <div>
            <form action="./all_download_control.php">
            
     <button type="submit" class="button_1 uk-button-large uk-circle uk-width-1-1"><span class="fas fa-hospital"></span> <span>全件出力</span></button>
            
            </form>
            </div>
              </div>
                </div>
        
    </main>
<!--櫻間20230801-->
</body>
</html>
