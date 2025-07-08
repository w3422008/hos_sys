<!DOCTYPE html>
<html>
    <head><link rel="shortcut icon" href="favicon.ico">
        <title>ログイン画面 | 医療機関情報システム</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--CSS/JS-->
        <!-- *全画面必須 ---------->
        <!--UIkit3-->
        <link rel="stylesheet" href="css/uikit.min.css" />
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>

        <!--style.css-->
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/buttons.css" /><!--※-->
        <!--font awesome-->
        <link rel="stylesheet" href="css/all.min.css" />
        <!--------------------* -->
    <style>
      div.modified{
        
        padding: 1rem;
        margin-bottom:30px;
        height:auto;
        width:auto;
        background-color: white;
        text-align:left;
        font-size: 0.8rem;
        border:1px solid grey;
        

    }
    .modified ul, dl{
        margin-top: 0;
    }
    .modified p{
        margin-top: 0;
        margin-bottom: 0;
    }

    ul.tab-wrap2{
        overflow-y: auto;
    }
    ul.tab-wrap1 + ul.tab-wrap2{
        height: calc(100vh/3);
        /* border:1px solid grey; */

    }
    .login-wrap{
        width:850px;
        margin:0 auto 50px;
    }

    </style>


    </head>
    <body>
    
    <header>
    <nav class="uk-navbar-container">
        <div class="uk-navbar uk-flex-middle bg-navbar3">
            <div><!--Logo-->
                <a class="uk-navbar-item uk-logo" href="">医療機関情報システムver<?php echo $version?></a>
            </div>
        </div>
    </nav>
    </header>


    <?php
    
    require_once('functions.php');
    
    $dbh = get_db_connect();
    
     //大橋＿メンテナンスモード判断「メンテナンス開始テーブルのviewが１(オン)かどうか」
    $data = get_start_announce($dbh);
    
    //大橋＿メンテナンスモード判断「オンならメンテモード」
    if(!empty($data)){
    include_once('./admin_mainte/out_of_service_view.php');
    }else{
    
    ?>


        <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-large-top">
        <div class="uk-container">
        <form class="uk-form-stacked" action="" method="POST">
            <div class="uk-margin">
                <label class="uk-form-label">ログインID</label>
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: user"></span>
                    <input type="id" name="user_id" class="uk-input" required autofocus>
                </div>
                <span class="uk-text-danger">
                <?php 
                    if(isset($errs['id'])){ 
                        echo '<br>' . $errs['id'];
                    } 
                ?>
                </span>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label">パスワード</label>
                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                    <input type="password" name="password" class="uk-input" required>
                </div>
                <span class="uk-text-danger">
                <?php 
                    if(isset($errs['passwrod'])){ 
                        echo '<br>' . $errs['passwrod'];
                    } 
                ?>
                </span>
            </div>
            <div class="uk-margin">
                <button class="uk-button-primary uk-button uk-width-1-1">ログイン</button>
            </div>
           
        </form>
        </div>
        </div>

        <!--嶋津20231106-->
        <!--メンテナンス表示-->

        <?php include_once('./message_log/announce.php');?>

        <div class="login-wrap">
        <!--メッセージ表示-->
        <p><i class="fas fa-history fa-lg"></i> 対応状況</p>
        <div class="modified">
        <ul class="tab-wrap1" uk-tab>
        <li><a href="#"><p><span class="uk-label">対応済</span></p></a></li>
        <li><a href="#"><p><span class="uk-label uk-label-success">対応中</span></p></a></li>
        <li><a href="#"><p><span class="uk-label uk-label-danger">未対応（後半納期分）</span></p></a></li>
        <li><a href="#"><p><span>マニュアル</span></p></a></li>
        </ul>

        <ul class="uk-switcher uk-list uk-link-text tab-wrap2">
    <!-- 大橋　message対応 -->
        <!--対応済--><li><?php include_once('./message_log/check_done.php'); ?></li>
        <!--対応中--><li><?php include_once('./message_log/check_respons.php'); ?></li>
        <!--未対応--><li><?php include_once('./message_log/check_unsupport.php'); ?></li>
      
        <ul>
            <li><a href="./message_log/医療機関情報システムマニュアル.pdf" target="_blank">医療機関情報システムマニュアル</a> </li>
            <li><a href="./message_log/新規医療機関の医療機関コードの調べ方.pdf" target="_blank">新規医療機関の医療機関コードの調べ方</a> </li>
            <li><a href="https://kouseikyoku.mhlw.go.jp/chugokushikoku/chousaka/iryoukikanshitei.html" target="_blank">中国四国厚生局　医療機関一覧</a>
            </li>
        </ul>
        </ul>
        </div>


        <!--ログ表示-->
        <p><i class="fas fa-history fa-lg"></i> 医療機関　更新履歴</p>
        <div class="modified">
        <ul class="tab-wrap1" uk-tab>
        <li><a href="#">新規追加ログ</a></li>
        <li><a href="#">削除ログ</a></li>
        </ul>

        <ul class="uk-switcher tab-wrap2">
        <li><?php include_once('./message_log/log_insert.php');?></li>
        <li><?php include_once('./message_log/log_delete.php');?></li>
        </ul>
        </div>
        </div>

        <?php } ?>
    </body>
</html>