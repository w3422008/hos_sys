<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者画面　｜　医療機関システム</title>

    <!--CSS/JS-->
    <!-- *全画面必須 ---------->
        <!--UIkit3-->
        <link rel="stylesheet" href="../css/uikit.min.css" />
        <script src="../js/uikit.min.js"></script>
        <script src="../js/uikit-icons.min.js"></script>

        <!--style.css-->
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/form_parts.css" />
        <link rel="stylesheet" href="../css/marker.css"/>

        <!--*font awesome-->
        <link rel="stylesheet" href="../css/all.min.css" />
    <!--------------------* -->

        <style>

        </style>

</head>

<body>
    <!-- **header -->
    <?php include_once("./mes_header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="./login.php">管理者ログイン</a></li>
            <li><a href="./mes_log.php">メッセージ画面</a></li>
            <li><span>確認画面</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定-->
    <footer uk-sticky="position: bottom">
        <?php include_once("./mes_footer.php"); ?>
    </footer>


    <!-- 三宅20231211 確認内容 --> 
    <!-- **main -->
    <main>
    <div class="uk-card uk-card-small">
    <form action = "mes_add_comp.php" method="POST">

    <!--*main_header-->
    <div class="uk-card-default uk-container uk-container-center uk-width-2-3@m">
        <div class="uk-card-header">
            <h2>新規登録内容確認</h2>
            <span>この内容でよろしいですか？</span>
        </div>

    <!--*main_body-->
    <div class="uk-margin uk-container uk-container-center uk-width-1-1@m">
        <!--*Cards(NOTAccordion)-->
        <div class="uk-margin uk-card" style="padding:1em;">
        <div class="uk-width-1-1@m">

    <!--⭐UIゾーン--><!--アイコンの位置-->
                <div>
                    <table class="uk-table uk-table-divider">
                        <tr>
                        <th>依頼者　施設</th>
                            <td><?php if($req_fac === '附'){echo "附属病院";}
                                    elseif($req_fac === '総'){echo "総合医療センター";}
                                    elseif($req_fac === '福祉大'){echo "医療福祉大学";}
                                    elseif($req_fac === 'その他'){echo "その他";}?>
                            </td>
                        </tr>

                        <tr>
                        <th>依頼者　所属</th>
                            <td><?php echo $req_dep;?>
                            </td>
                        </tr>

                        <tr>
                        <th>対応状況</th>
                            <td>未対応</td>
                        </tr>

                        <tr>
                        <th>依頼日</th>
                            <td><?php echo $req_date; ?>
                            </td>
                        </tr>


                        <!-- 三宅20231219 -->
                        <tr>
                        <th>表示／非表示</th>
                            <td><?php if($view === "0"){echo "非表示";}
                                    elseif($view === "1"){echo "表示";} ?>
                            </td>
                        </tr>

                        <tr>
                        <th>変更箇所・内容</th>
                            <td><?php echo $comment; ?>
                            </td>
                        </tr>
                                                
                    </table>
                </div>
        </div>
        </div>
    </div>

            <!-- 三宅20240213 ボタンの表示（左に戻る、右に追加） -->
            <!--button-->
            <div class="uk-flex uk-flex-between">
                <div class=" uk-flex-last">
                    <button type="submit" name = "mes_add" value="追加" class="uk-button uk-button-primary">追加</button> 
                </div>
                <div class=" uk-flex-first">
                    <button type="submit" name = "back" value="戻る" class="uk-button uk-button-primary">戻る</button> 
                </div>
            </div>

</form>



</div>
</main>
</body>

</html>