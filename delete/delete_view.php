<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>医療機関 削除 | 医療機関情報システム</title>
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
    <!-- **header -->
    <?php include_once("../header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="hide_hos_control.php">医療機関 削除</a></li>
            <li><span>削除確認</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
    <?php include_once("../footer.php"); ?>
    </footer>

    <!-- **main -->
    <main>
    <?php
    foreach ($data as $key =>$var):
    ?>
        <div class="uk-alert-danger">
            <!--*main_header-->
            <div class="uk-card-header">
                <h2><i class="fas fa-ban fa-lg"></i> 医療機関 削除</h2>
                <p>「<b>削除</b>」をクリックすると、医療機関が削除されます</p>
                <u class="uk-text-secondary">※一度削除した医療機関は元に戻すことはできません。</u>
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
                <div class="uk-margin-left"><!--詳細画面へ戻る-->
                    <a href="hide_hos_control.php" class="uk-button uk-button-primary">戻る</a>
                </div>
                <div class="uk-margin-right"><!--非表示-->
                    <a href="deleted_control.php?sid=<?php echo $var['hos_cd'];?>&sname=<?php echo $var['hos_name'];?>" class="uk-button uk-button-primary">削除</a>
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
