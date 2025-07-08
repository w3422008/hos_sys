<!DOCTYPE html>
<html>

<head><link rel="shortcut icon" href="../favicon.ico">
    <title>コンタクト履歴データ | 医療機関情報システム</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- *全画面必須 ---------->
    <!--UIkit3-->
    <link rel="stylesheet" href="../../css/uikit.min.css" />
    <script src="../../js/uikit.min.js"></script>
    <script src="../../js/uikit-icons.min.js"></script>

    <!--style.css-->
    <link rel="stylesheet" href="../../css/style.css"/>
    <link rel="stylesheet" href="../../css/form_parts.css" />
    <link rel="stylesheet" href="../../css/marker.css"/>

    <!--*font awesome-->
    <link rel="stylesheet" href="../../css/all.min.css" />

    <!-- 注意書き -->
    <link rel="stylesheet" href="../../css/import.css" />

    <style>

    </style>

</head>

<!--------------------* -->
<body>
    <!-- **header -->
    <header uk-sticky>
    <?php include_once("../../header.php"); ?>
    <!-- パンくず -->
    <ul class="uk-breadcrumb breadcrumb">
    <li><a href="../../menu/MENU_control.php">MENU</a></li>
    <li><a href="../../import/data_select.php">インポート機能</a></li>
            <li><span>コンタクト履歴データ</span></li>
    </ul>
    </header>

    <!-- **footer ページ下部固定-->
<!--     <footer uk-sticky="position: bottom">

    </footer>
 -->
    
    <!-- **main -->
    <main>
        <span>
            <div class="import-message">
                <h2><i class="far fa-check-circle"></i></h2>
                <h2><?php if(empty($imp_err)){ echo 'データが正常にインポートされました。';}else{echo $imp_err;}?></h2>
            </div>
                <form action="file_select.php" method="get" style="display:inline;">
                    <button type="submit"  name = "back" value="戻る" class="uk-button uk-button-primary bt">戻る</button>
                </form>
        </span>

    </main>
</body>

</html>

