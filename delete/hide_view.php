<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>医療機関停止 | 医療機関情報システム</title>
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
      <!--js-->
</head> 

<body>
<?php $hos_cd=$_SESSION['hos_cd']; ?>

    <!-- **header -->
    <?php include_once("../header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="../detail/detail_control.php?cd=<?php echo $hos_cd;?>" >医療機関　詳細</a></li>
            <li><span>医療機関停止</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
    <?php include_once("../footer.php"); ?>
    </footer>

    <!--**main-->
    <main>
    <?php
    foreach ($data as $key =>$var):
    ?>
        <div class="uk-alert-success">
            <!--*main_header-->
            <div class="uk-card-header">
                <h2><i class="fas fa-lock fa-lg"></i> 医療機関 停止</h2>
                <p>「<b>停止</b>」をクリックすると 医療機関は <u>停止</u> され、検索結果一覧に表示されなくなります。</p>
            </div>
        </div>
        
        <div class="uk-width-1-1 uk-container">
            <!--*main_body-->
            <p>
                医療機関名：<b class="YELLOW_marker"><?php echo html_escape ($var['hos_name']);?></b>　／　医療機関コード：<b class="YELLOW_marker"><?php echo html_escape ($var['hos_cd']); ?></b>
            </p>

            <!--button-->
            <div class="uk-card-footer border-footer">
            <div class="uk-flex uk-flex-between">
                <div class="uk-margin-left">
                    <a href="../detail/detail_control.php?cd=<?php echo $var['hos_cd']; ?>" class="uk-button uk-button-primary">戻る</a>
                </div>
                <div class="uk-margin-right">
                    <a href="swich_control.php?id=<?php echo $var['hos_cd'];?>" class="uk-button uk-button-primary">停止</a>
                </div>
            </div>
            </div>
        </div>
    <?php
    endforeach;
    ?>
    </main>
</body>
</html>


