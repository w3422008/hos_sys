<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー削除 | 医療機関情報システム</title>
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
    <style>
    </style>
</head> 

<body>
    <!-- **header -->
    <?php include_once("../header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="user_MT_control.php">ユーザー管理</a></li>
            <li><span>ユーザー削除</span></li>
            <li><span>削除完了</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
      <?php include_once("../footer.php"); ?>
    </footer>

    <!-- **main -->    
    <main>
    <div class="uk-container uk-card userCard uk-width-expand uk-width-5-6@l uk-width-2-3@xl">
        <!--*main_header-->
        <div class="uk-card-header">
            <h2><i class="fas fa-trash"></i> 削除完了</h2>
        </div>
        <!--*main_body-->
        <div class="uk-alert-success" uk-alert>
        <span>ユーザー削除完了：ユーザーが削除されました。</span>
        </div>

        <!--button-->
        <div class="uk-flex uk-flex-left">
            <div class="uk-margin-left">
                <a href="user_MT_control.php" class="uk-button uk-button-primary">ユーザー管理画面に戻る</a>
            </div>
        </div>
    </div>
    </main>

</body>
</html>






