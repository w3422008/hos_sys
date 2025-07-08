<!DOCTYPE html>
<html>
    <head><link rel="shortcut icon" href="favicon.ico">
        <title>管理者ログイン画面| 医療機関情報システム</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--CSS/JS-->
        <!-- *全画面必須 ---------->
        <!--UIkit3-->
        <link rel="stylesheet" href="../css/uikit.min.css" />
        <script src="../js/uikit.min.js"></script>
        <script src="../js/uikit-icons.min.js"></script>

        <!--style.css-->
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/buttons.css" /><!--※-->
        <!--font awesome-->
        <link rel="stylesheet" href="../css/all.min.css" />
        <!--------------------* -->
        <style>
        </style>

    </head>
    <body>    


  <!-- **header -->
  <header uk-sticky>
    <?php include_once("../header.php"); ?>
    <!-- パンくず -->
      <ul class="uk-breadcrumb breadcrumb">
          <li><a href="../menu/MENU_control.php">MENU</a></li>
          <li><span>管理者ログイン</span></li>
      </ul>
  </header>

    <!-- **body -->
        <div class="uk-flex uk-flex-center uk-flex-middle uk-margin-large-top">
        <div class="uk-container">
        <form class="uk-form-stacked" action="" method="POST">
            <div class="uk-margin">
                <label class="uk-form-label">合言葉は？</label>

                <div class="uk-inline">
                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                    <input type="password" name="aikotoba" class="uk-input" required>
                </div>
                <span class="uk-text-danger">
                <?php 
                    if(isset($errs['aikotoba'])){ 
                        echo '<br>' . $errs['aikotoba'];
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
     </body>
</html>