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

    <!-- 文字・罫線 -->
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
        <?php include_once(".././mes_footer.php"); ?>
    </footer>
 -->
    
    <!-- **main -->
    <main>
    <div class="uk-card uk-card-small">
    <form action = "import.php" method="POST">

        <!--*main_header-->
        <div class="uk-card-default uk-container uk-container-center uk-width-2-3@m">
            <div class="uk-card-header">
                <h2>インポート内容確認</h2>
                <span>この内容でよろしいですか？</span>
            </div>

            
            <!--*main_body-->
                <div class="uk-margin uk-container uk-container-center uk-width-1-1@m">
                        <!--*Cards(NOTAccordion)-->
                        <div class="uk-margin uk-card" style="padding:1em;">
                            <div class="uk-width-1-1@m">
                                <div class="uk-margin">
                                    <table>
                                        <tr>
                                        <th label class="uk-form-label" for="form-stacked-text">ファイル名　：　</label></th>
                                        <td><div class="uk-form-controls">
                                            <input class="uk-input" id="form-stacked-text" type="text" name="file_name" value="<?php echo htmlspecialchars( basename( $file_name)); ?>" readonly>
                                        </div></td>
                                        </tr>
                                    </table>

                                    <?php if(!empty($errors)){
                                        echo '<div class="note error-message">';
                                        echo '<strong><span style="font-size: 20px; font-weight: bold;">! エラーチェック結果（下記に表示された内容に問題があります。確認後再度実行してください。）</span></strong><br>';
                                        echo implode('<br>', $errors) . '</p></div>';
                                        }else{
                                            echo '<div class="note"><p>' . $check . '</div></p>';
                                        } ?>
                                </div>
                            </div>
                        </div>
                    </div>

            <div class="uk-flex uk-flex-between">
                <div class=" uk-flex-last">
                    <?php if(empty($errors)){?>
                        <input type="hidden" name="year" value='1年'>
                    <button type="submit" name = "year" value="<?php echo htmlspecialchars( basename( $file_name)); ?>" class="uk-button uk-button-primary">追加</button>  
                    <?php }?>
                </div>
 
                <div class=" uk-flex-first"> 
                    <button type="button" onclick="window.history.back();" value="戻る" class="uk-button uk-button-primary">戻る</button>
                </div> 
            </div>

    </form>
    </div>

</body>

</html>

