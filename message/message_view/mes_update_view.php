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
        <script src="../../js/uikit-icons.min.js"></script>

        <!--style.css-->
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/form_parts.css" />
        <link rel="stylesheet" href="../css/marker.css"/>

        <!--*font awesome-->
        <link rel="stylesheet" href="../css/all.min.css" />
    <!--------------------* -->
    <style>
    .uk-table th {
        vertical-align: middle;
    }
    
    .meslog {
        resize: none;
    }
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
    <form action = "mes_update_comp.php" method="POST">

    <!--*main_header-->
    <div class="uk-card-default uk-container uk-container-center uk-width-2-3@m">
        <div class="uk-card-header">
            <h2>登録内容変更</h2>
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
                            <td>               
                                <div class="uk-form-controls">
                                    <label><?php if(isset($req_fac)){echo $req_fac; } ?>
                                </div>
                            </td>
                        </tr>

                        <tr>
                        <th>依頼者　所属</th>
                            <td>
                                <div class="uk-form-controls">
                                    <label><?php if(isset($req_dep)){echo $req_dep; } ?></label>
                                </div>
                            </td>
                        </tr>

                        <tr>

                        <tr>
                        <th>依頼日</th>
                            <td>
                                <div class="uk-form-controls">
                                    <?php if(isset($req_date)){echo $req_date; } ?>
                                </div>
                            </td>
                        </tr>

                        <tr>
                        <th>対応日</th>
                            <td>
                        <input type="date" class="uk-input size-input-hosCd pattern" name="res_date" value="<?php if(isset($res_date)){echo $res_date; } ?>" min="2000-01-01" max="2030-12-31" >
                            </td>
                        </tr>
                        
                        <th>バージョン</th>
                            <td>
                                <div class="uk-form-controls">
                                <input type=text class="uk-input size-input-hosCd pattern" name="version" maxlength="10" data-pattern="code" value="<?php if(isset($version)){echo $version; } ?>">
                                </div>
                            </td>
                        </tr>

                        <th>対応状況</th>
                            <td>
                            <select name="situation" class="uk-select size-input-pre" id="selbox2" onchange="change();">
                                <option value = 0 <?php if(!empty($situation) && $situation == '0'){ echo 'selected';} ?>>未対応</option>
                                <option value = 10 <?php if(!empty($situation) && $situation =='10'){ echo 'selected';} ?>>対応中</option> 
                                <option value = 11 <?php if(!empty($situation) && $situation =='11'){ echo 'selected';} ?>>対応済</option> 
                            </select>
                            </td>
                        </tr>

                        <!-- 三宅20231219 -->
                        <tr>
                        <th>表示／非表示</th>
                            <td>                    
                                <select name="view" class="uk-select size-input-pre" id="selbox3" onchange="change();">
                                    <option value =1 <?php if($view == '1'){ echo 'selected' ;}?>>表示</option>
                                    <option value =0 <?php if($view =='0'){ echo 'selected';}?>>非表示</option> 
                                </select>
                            </td>
                        </tr>

                        <tr>
                        <th>変更箇所・内容
                            (100文字以内)</th>
                            <td>
                                <div><textarea class="uk-textarea size-textarea-Notes meslog" rows="3" name="comment" maxlength="100"><?php if(isset($comment)){echo $comment; } ?></textarea></div>
                            </td>
                        </tr>


                                                
                    </table>
                </div>
        </div>
        </div>
    </div>

            <!--button-->
            <div class="uk-flex uk-flex-between">
                <div class=" uk-flex-last">            
                    <button type="submit" name = "mes_update" value="変更" class="uk-button  uk-button-primary">変更</button>
                </div>
                <div class=" uk-flex-first">
                    <button type="submit" name = "back" value="戻る" class="uk-button  uk-button-primary">戻る</button> 
                </div>
            </div>
    


</form>
</div>

        <!-- footerが付いたときに行を空ける対策 -->
        <br></br>
        
</main>
</body>

</html>


