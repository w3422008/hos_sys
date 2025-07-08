<!DOCTYPE html>
<html>

<head><link rel="shortcut icon" href="../favicon.ico">
    <title>紹介・逆紹介データ | 医療機関情報システム</title>
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

    <!-- 文字・罫線 -->
    <link rel="stylesheet" href="../../css/import.css" />

    <style>

    </style>

</head>

<!--------------------* -->
<body>
    <!-- **header -->
    <header uk-sticky>
    <?php include_once("../header.php"); ?>
    <!-- パンくず -->
    <ul class="uk-breadcrumb breadcrumb">
    <li><a href="../../menu/MENU_control.php">MENU</a></li>
    <li><a href="../../import/data_select.php">インポート機能</a></li>
            <li><span>逆紹介データ</span></li>
    </ul>
    </header>

    <!-- **footer ページ下部固定-->
<!--     <footer uk-sticky="position: bottom">
        
    </footer>
 -->
    
    <!-- **main -->
    <main>
        <div class="uk-card uk-card-small">
            <!--*main_header-->
            <div class="uk-card-default uk-container uk-container-center uk-width-2-3@m">
                <div class="uk-card-header">
                    <h2>バックアップ完了画面</h2>
                </div>
                
                <main>
                    <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-width-1-2@m uk-width-1-2@l uk-width-1-3@xl" style="display: flex; flex-direction: column; align-items: center;">
                        <div class="import-message" style="text-align: center; width: 140%;">
                            <h2><i class="far fa-check-circle"></i></h2>
                            <h2><?php echo 'データが正常に復元されました。';?></h2>
                        </div>
                            <form action="file_select.php" method="get" style="display:inline;">
                                <button type="submit"  name = "back" value="戻る" class="uk-button uk-button-primary " style="width: 100px; margin: 50px 0 0 20px;">戻る</button>
                            </form>
                    </div>
                </main>
            </div>
    </main>

</body>

</html>

