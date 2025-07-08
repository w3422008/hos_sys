

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者画面　｜　医療機関システム</title>

    <!--CSS/JS-->
    <!-- *全画面必須 ---------->
        <!--UIkit3-->
        <link rel="stylesheet" href="../../css/uikit.min.css" />
        <script src="../../js/uikit.min.js"></script>
        <script src="../../js/uikit-icons.min.js"></script>
        <link rel="stylesheet" href="../../css/uk-custom.css">

        <!--style.css-->
        <link rel="stylesheet" href="../../css/style.css"/>
        <link rel="stylesheet" href="../../css/form_parts.css" />
        <link rel="stylesheet" href="../../css/marker.css"/>
        <link rel="stylesheet" href="../../css/tables.css" />

        <!--*font awesome-->
        <link rel="stylesheet" href="../../css/all.min.css" />
    <!--------------------* -->
        <link rel="stylesheet" href="../../css/bubble.css">
        <link rel="stylesheet" href="../../css/mes_log.css">

</head>

<body>
    <!-- **header -->
    <?php include_once("../mess_mainte/header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../../menu/MENU_control.php">MENU</a></li>
            <li><a href="../../message/login.php">管理者ログイン</a></li>
            <li><span>メンテナンス通知画面</span></li>
        </ul>
    </header>


    <!-- 三宅20231211 確認内容 --> 
    <!-- **main -->
    <main>
    <div class="uk-card uk-card-small">
    <form action = "../mess_mainte/add_comp.php" method="POST">

    <!--*main_header-->
    <div class="uk-card-default uk-container uk-container-center uk-width-2-3@m">
        <div class="uk-card-header">
            <h2>登録内容確認</h2>
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
                        <th>通知タイトル</th>
                            <td><?php echo $title;?>
                            </td>
                        </tr>

                        <tr>
                        <th>アップロード日</th>
                            <td><?php echo $upload_date; ?>
                            </td>
                        </tr>

                        <tr>
                        <th>作業日</th>
                            <td><?php echo $date; ?>
                            </td>
                        </tr>
                        
                        <th>作業予定時刻</th>
                            <td><?php echo $start_time; ?>～<?php echo $end_time; ?>
                            </td>
                        </tr>


                        <tr>
                        <th>表示／非表示</th>
                            <td><?php if($view === "0"){echo "非表示";}
                                    elseif($view === "1"){echo "表示";} ?>
                            </td>
                        </tr>

                        <tr>
                        <th>実施内容</th>
                            <td style="white-space: pre-line;"><?php echo htmlspecialchars($comment); ?>
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
                    <button type="submit" name = "add" value="追加" class="uk-button uk-button-primary">保存</button> 
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