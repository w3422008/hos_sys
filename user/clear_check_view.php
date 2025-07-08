<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード初期化 | 医療機関情報システム</title>
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
            <li><a href="javascript:history.back();">パスワード初期化</a></li>
            <li><span>変更内容確認</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
      <?php include_once("../footer.php"); ?>
    </footer>

    <!-- **main -->
    <main>
    <div class="uk-container uk-card userCard uk-width-expand uk-width-5-6@l uk-width-2-3@xl">
    <form action="cleard.php?id=<?php echo $id;?>">
        <!--*main_header-->  
        <div class="uk-card-header">
            <h2 class="uk-heading-primary"><i class="fas fa-key"></i> 入力内容確認</h2>
            <span>この内容でよろしいですか？</span>
        </div>
<!--高橋UIゾーン--><!--アイコンの位置-->
        <!--*main_body-->
        <table class="uk-table">
            <tr>
                <th>新規パスワード <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></th>
                <td><span class="GREEN_marker"><?php echo $pw1;?></span></td>
            </tr>
        </table>
        <br>
        <!--button-->
        <div class="uk-flex uk-flex-between">
            <div class="uk-flex-last"><!--変更-->
                <input type="submit"  class="uk-button uk-button-primary" value="初期化">
            </div>
            <div class="uk-flex-first"><!--戻る-->
            <!--櫻間-->
                <a href="./clear.php?id=<?php echo $id;?>" class="uk-button uk-button-primary">戻る</a>
            </div>
        </div>
    </form>
    </div>
    </main>


</body>
</html>