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
            <li><span>パスワード初期化</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
      <?php include_once("../footer.php"); ?>
    </footer>


    <!-- **main -->    
    <main>
    <div class="uk-container uk-card userCard uk-width-expand uk-width-5-6@l uk-width-2-3@xl">
    <form action = "clear_check.php" method="POST">
        <!--*main_header--> <!--高橋UIゾーン--><!--アイコンの位置-->
        <div class="uk-card-header">
            <h2><i class="fas fa-key"></i> パスワード 初期化</h2>
            <span>新規パスワードを入力して<b>「次へ」</b>ボタンをクリックしてください。</span><br>
            <span>※ <u>8文字以上、大文字小文字の英数字を含むもの</u></span>
        </div>

        <!--*main_body-->
        <?php
        foreach($data as $key => $var):
        ?>
            <!-- 高橋2023.01修正 -->
            <input type="hidden" name="user_id" value="<?php echo $var['user_id'];?>">
            <input type="hidden" name="user_name" value="<?php echo $var['user_name'];?>">
            <span>ID：<?php echo $var['user_id'];?> ／ 名前：<?php echo $var['user_name'];?></span>
                    <!--高橋UIゾーン--><!--アイコンの位置-->
            <?php if(isset($pw1)&&isset($pw4)):?>
                <div class="uk-margin">
                    <label>新規パスワード <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></label>
                    <!-- 高橋要確認 maxlength -->
                    <!-- 8文字以上、大文字小文字の英数字を含むもの -->
                    <div class="uk-form-control">
                        <input class="uk-input size-input-password" type="password" name="pw" id="pw" value="<?php echo $pw1;?>" maxlength="20">
                        <span id="pw_chk" style="display: none; color: red;">※半角英字大文字・小文字と数字を組み合わせた8文字以上で設定してください</span>
                    </div>
                </div>
                <div class="uk-margin">
                    <label>新規パスワード（確認） <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></label>
                    <div class="uk-form-control">
                        <input class="uk-input size-input-password" type="password" id="repass" name="name" value="<?php echo $pw1;?>" id="inputPassword1" maxlength="20">
                        <span id="repass_chk" style="display: none; color: red;">パスワードが一致しません</span>
                    </div>
                </div>
            <?php else:?>  
            <!--高橋UIゾーン--><!--アイコンの位置-->
                <div class="uk-margin">
                    <label>新規パスワード <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></label>
                    <!-- 高橋要確認 maxlength -->
                    <!-- 8文字以上、大文字小文字の英数字を含むもの -->
                    <div class="uk-form-control">
                        <input class="uk-input size-input-password" type="password" name="pw" id="pw" value="" maxlength="20">
                        <span id="pw_chk" style="display: none; color: red;">※半角英字大文字・小文字と数字を組み合わせた8文字以上で設定してください</span>
                    </div>
                </div>
                <div class="uk-margin">
                    <label>新規パスワード（確認）<i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></label>
                    <div class="uk-form-control">
                        <input class="uk-input size-input-password"  type="password" id="repass" name="name" value="" id="inputPassword1" maxlength="20">
                        <span id="repass_chk" style="display: none; color: red;">パスワードが一致しません</span>
                    </div>
                </div>
            <?php endif;?>
            <br>
            <!--button-->
            <div class="uk-flex uk-flex-between">
                <div class="uk-margin-right uk-flex-last"><!--次へ(form button)-->
                    <input type="submit"  class="uk-button uk-button-primary" value="次へ" id="touroku">
                </div>
                <div class="uk-margin-left uk-flex-first"><!--戻る(link)-->
                <!--櫻間-->
                    <a href="../user/user_MT_control.php" class="uk-button uk-button-primary">戻る</a>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </form>
    </div>
    </main>


<script>
//櫻間20221104
document.getElementById("touroku").onclick = function() { 

const pw = document.getElementById("pw").value;     


const repass = document.getElementById("repass").value;  
var flag = 0; 

if(pw.length == 0){ flag = 1; }    


if(repass.length == 0){ flag = 1; }  

if(flag == 1){ alert('必須項目が未記入の箇所があります'); return false; }     else{         flag_chk = 0;         


var regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/;        
if(regexp.test(pw) != true){ document.getElementById('pw_chk').style.display = "block"; flag_chk = 1; }          
else{ document.getElementById('pw_chk').style.display = "none"; }    


if(pw != repass){ document.getElementById('repass_chk').style.display = "block"; flag_chk = 1; }        


else{ document.getElementById('repass_chk').style.display = "none"; }     

if(flag_chk == 1){ return false; }       
else{ return ture; } 
}}; 
//櫻間20221104</script>
</body>
</html>
