

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
        <link rel="stylesheet" href="../../css/uikit.min.css" />
        <script src="../../js/uikit.min.js"></script>
        <script src="../../js/uikit-icons.min.js"></script>

        <!--style.css-->
        <link rel="stylesheet" href="../../css/style.css"/>
        <link rel="stylesheet" href="../../css/form_parts.css" />
        <link rel="stylesheet" href="../../css/marker.css"/>

        <!--*font awesome-->
        <link rel="stylesheet" href="../../css/all.min.css" />

        <!--------------------* -->
        <link rel="stylesheet" href="../css/mes_log.css">

        <!--------------------* -->   

        <style>
        .uk-table th {
            vertical-align: middle;
        }


        .haba {
        width: 20em;
/*         max-width: 100%; */
        }

        .meslog {
        resize: none;
        }
        </style>
</head>

<body>
    <!-- **header -->
    <?php include_once("header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../../menu/MENU_control.php">MENU</a></li>
            <li><a href="./login.php">管理者ログイン</a></li>
            <!-- <li><a href="message/message_view/login_view.php">メッセージ画面</a></li> -->
            <li><span>メンテナンス通知画面</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
        <?php //include_once("./footer.php"); ?>
    </footer>


    <!-- **main -->
    <main>
    <!-- 全体的に中央に寄る -->
    <div class=" uk-container uk-width-expand">

    <!-- 新規追加の欄 -->
    <div class="uk-container uk-width-expand uk-width-5-6@l uk-card-default">
    <form action="mes_add.php" method="POST"  name="myform" onsubmit="return Check()" class="validationForm" >
        <p></p>

    <!-- 新規追加タイトル -->
        <!--*main_header-->
        <div class="uk-card-default uk-container uk-container-center uk-width-2-3@m">
            <div class="uk-card-header">
                <h2>メンテナンス通知入力</h2>
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
                        <td><div class="uk-form-controls">
                            <input type="text" class="uk-input pattern haba" name="mai_title" value="<?php if(isset($title)){echo $title; } ?>" maxlength="100" data-pattern="code" required>
                        </div></td>
                    </tr>

                    <tr>
                    <th>アップロード日</th>
                        <td><div class="uk-form-controls">
                            <input type="date" class="uk-input size-input-hosCd pattern" name="mai_upload_date"  value="<?php if(isset($upload_date)){echo $upload_date; } ?>" min="2000-01-01" max="2030-12-31" required>
                        </div></td>
                    </tr>
 
                    <tr>
                    <th>日程</th>
                        <td><div class="uk-form-controls">
                            <input type="date" class="uk-input size-input-hosCd pattern" name="mai_date" value="mai_date" value="<?php if(isset($date)){echo $date; } ?>" min="2000-01-01" max="2030-12-31" required>
                        </div></td>
                    </tr>

                    <tr>
                    <th>時刻</th>
                        <td><div class="uk-form-controls">
                        <input type="time" class="uk-input size-input-hosCd pattern" name="start_time" step="900" value="<?php if(isset($start_time)){echo $start_time; } ?>" required>～
                        <input type="time" class="uk-input size-input-hosCd pattern" name="end_time" step="900" value="<?php if(isset($end_time)){echo $end_time; } ?>" required>
                        </div></td>
                    </tr>

                    <tr>
                    <th>表示／非表示</th>
                        <td><div class="uk-form-controls">
                            <select name="mai_view" value="mai_view" class="uk-select size-input-pre" id="selbox3" onchange="change();">
                                <option value = 1>表示</option>

                                <option value = 0>非表示</option> 
                            </select>
                        </div></td>
                    </th>

                    <tr>
                    <th>変更箇所・内容(150文字以内)</th>   
                        <td><div><textarea class="uk-textarea size-textarea-Notes meslog" rows="4" name="mai_comment" value="mai_comment" maxlength="150"></textarea></div></td>
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
                    <button type="submit" name = "mes_sub" value="保存" class="uk-button uk-button-primary">保存</button> 
                </div>
                
                <!-- required対策 -->
                <div class=" uk-flex-first">
                    <button type="button" onclick="window.history.back();" value="戻る" class="uk-button uk-button-primary">
                </div>
            </div>

    </form>