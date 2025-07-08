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
        <link rel="stylesheet" href="css/bt-login.css" />
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
                <a class="uk-navbar-item uk-logo" href="./index.php">医療機関情報システム　メンテナンス：テストモード</a>
            </div>
        </div>
    </nav>
    </header>

    <div class="uk-container">
        <div class="bt-container">
            <form class="uk-form-stacked" action="" method="POST">
                <div class="uk-margin">
                    <div class="uk-inline">
                        <input type="hidden" name="user_id"  value='555' >
                        <input type="hidden" name="password"  value='Aa555555' >
                        <button class="lg-button SysAdmin uk-width-1-1">システム管理者</button>
                    </div>
                    <span class="uk-text-danger">
                    <?php 
                        if(isset($errs['id'])){ 
                            echo '<br>' . $errs['id'];
                        } 
                    ?>
                    </span>
                </div>
            </form>
            <form class="uk-form-stacked" action="" method="POST">
            <div class="uk-margin">
                <div class="uk-inline">
                    <input type="hidden" name="user_id"  value='111' >
                    <input type="hidden" name="password"  value='Aa111111' >
                    <button class="lg-button admin uk-width-1-1">管理者</button>
                </div>
                <span class="uk-text-danger">
                <?php 
                    if(isset($errs['id'])){ 
                        echo '<br>' . $errs['id'];
                    } 
                ?>
                </span>
            </div>
            </form>

            <form class="uk-form-stacked" action="" method="POST">
                <div class="uk-margin">
                    <div class="uk-inline">
                        <input type="hidden" name="user_id"  value='222' >
                        <input type="hidden" name="password"  value='Aa222222' >
                        <button class="lg-button office uk-width-1-1">一般 (事務)</button>
                </div>
                <span class="uk-text-danger">
                <?php 
                    if(isset($errs['id'])){ 
                        echo '<br>' . $errs['id'];
                    } 
                ?>
                </span>
            </div>
            </form>


            <form class="uk-form-stacked" action="" method="POST">
                <div class="uk-margin">
                    <div class="uk-inline">
                        <input type="hidden" name="user_id"  value='333' >
                        <input type="hidden" name="password"  value='Aa333333' >
                        <button class="lg-button general uk-width-1-1">一般</button>
                    </div>
                <span class="uk-text-danger">
                <?php 
                    if(isset($errs['id'])){ 
                        echo '<br>' . $errs['id'];
                    } 
                ?>
                </span>
            </div>
            </form>
        </div>
    </div>

    <!-- メンテナンスメッセージの表示 -->
    <?php  include_once('./message_log/announce.php');?>

    