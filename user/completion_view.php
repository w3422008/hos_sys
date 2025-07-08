<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー新規追加 | 医療機関情報システム</title>
<!--CSS/JS-->
  <!-- *全画面必須 ---------->
    <!--UIkit3-->
    <link rel="stylesheet" href="../css/uikit.min.css" />
    <script src="../js/uikit.min.js"></script>
    <script src="../js/uikit-icons.min.js"></script>

    <!--style.css-->
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/form_parts.css" />
    <link rel="stylesheet" href="../css/marker.css"/><!--:*marker CSS-->

    <!--*font awesome-->
    <link rel="stylesheet" href="../css/all.min.css" />
  <!--------------------* -->
    
    <style>
    </style>
</head> 

<body>
    <!-- **header -->
    <header uk-sticky>
        <?php include_once("../header.php"); ?>
        <!-- パンくず -->
            <ul class="uk-breadcrumb breadcrumb">
                <li><a href="../menu/MENU_control.php">MENU</a></li>
                <li><a href="user_MT_control.php">ユーザー管理</a></li>
                <li><span>新規追加</span></li>
                <li><span>追加内容確認</span></li>
                <li><span>追加完了</span></li>
            </ul>
    </header>

<!-- **main -->
<div class="uk-container uk-container-center uk-width-2-3@m">
<div class="uk-card uk-card-default uk-card-small">

    <div class="uk-container uk-container-center uk-width-1-1@m">
        <!--*main_header-->
        <h4 class="uk-card-header"><i class="fas fa-lock"></i> 新規ユーザ追加完了</h4>

        <!--*main_body-->
        <div class="uk-alert-success" uk-alert>
        <span>追加完了：ユーザーが追加されました。</span>
        </div>
    </div>

    <!--button-->
    <div class="uk-margin-top uk-container uk-width-1-1@m">
    <div class="uk-flex uk-flex-left">
        <div class="uk-margin-left"><!--ユーザー利用停止-->
            <a href="user_MT_control.php" class="uk-button uk-button-primary">ユーザー管理画面に戻る</a>
        </div>
    </div>
    </div>

</div>
</div>



</body>
</html>