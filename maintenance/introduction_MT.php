<?php
//櫻間
session_start();
//櫻間
$user_adm = $_SESSION['member']['adm_user'];
//櫻間
?>
<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メンテナンス 紹介・逆紹介データ取込み | 医療機関情報システム</title>
<!--CSS/JS-->
  <!-- *全画面必須 ---------->
    <!--UIkit3-->
    <link rel="stylesheet" href="../css/uikit.min.css" />
    <script src="../js/uikit.min.js"></script>
    <script src="../js/uikit-icons.min.js"></script>

    <!--style.css-->
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/form_parts.css" />
    <link rel="stylesheet" href="../css/form_parts.css" />
  <!--------------------* -->
    <style>
        h5{
            color:#2e8b57;
            font-weight:bold;
        }
        html {
            background-color:#ffffff;
        }
        body{
            font-size:0.86rem;
            background-color:#ffffff;
        }
    </style>
</head>
<body>
<!--**header-->
<header>
    <?php include_once("../header.php"); ?>
  <div class="uk-flex uk-flex-left">
  <div class="uk-margin-left">
  <ul class="uk-breadcrumb breadcrumb">
      <li><a href="../menu/MENU_control.php">MENU</a></li>
      <li><span>メンテナンス　紹介・逆紹介データ取込み</span></li>
  </ul>
  </div>
</div>
</header>

  <!--**main-->
<div class="uk-card uk-card-small">
    <!--*main_header-->
    <div class="uk-container uk-container-center uk-width-2-3@m">
        <div class="uk-card-header">
        <h4 class='uk-heading-primary'>メンテナンス　紹介・逆紹介データ取込み</h4>
        </div>
    </div>
<br><br>
    <!--*main_body-->
    <div class="uk-container uk-container-center uk-width-1-1@m">
        <div class="uk-child-width-1-3@m" uk-grid>
            <!--新年度分のデータ追加用-->
            <div>
            <h5>新年度分のデータ追加用</h5>
                ◆ 紹介・逆紹介データのファイルを指定してください。
                <form class="uk-form-stacked" action="" method="POST">
                <div class="uk-margin-top">
                    <label class="uk-form-label">対象ファイル</label>
                    <div class="uk-form-controls">
                        <div uk-form-custom="target: true" class="uk-form-custom uk-width-1-1@s uk-width-auto@m">
                            <input type="file">
                            <input class="uk-input" type="text" placeholder="ファイルを選択してください">
                        </div>
                    <div class="uk-margin-top">
                        <button class="uk-button uk-button-primary uk-width-1-1@s uk-width-auto@m">
                            <span uk-icon="icon: download"></span> 取込み
                        </button>
                    </div>
                    </div>
                </div>
                </form>
            </div>
            <!--データ削除-->
            <div>
            <h5>データ削除</h5>
                ◆ データを削除する年度・施設を指定して下さい。
                <form class="uk-form-horizontal" action="" method="POST">
                    <div class="uk-margin-top">
                        <label class="uk-form-label">年度</label>
                        <div class="uk-form-controls">
                            <select class="uk-select uk-form-width-small" name="year">
    <?php       //foreach ?>
                                <option value="">Option 01</option>
                                <option value="">Option 02</option>
    <?php       //foreach ?>
                            </select>
                        </div>
                    </div>
                    <div class="uk-margin-top">
                        <label class="uk-form-label">施設</label>
                        <div class="uk-form-controls uk-form-controls-text">
                            <label for="附属病院" class="uk-form-label">
                                <input class="uk-radio" type="radio" id="附属病院" name="kawasaki" value="1">
                                附属病院
                            </label>
                            <label for="総合医療センター" class="uk-form-label">
                                <input class="uk-radio" type="radio" id="総合医療センター" name="kawasaki" value="0">
                                総合医療センター
                            </label>
                        </div>
                    </div>
                    <span>
                        <button class="uk-button uk-button-danger uk-width-1-1@s uk-width-auto@m">
                            <span uk-icon="icon: trash"></span> 削除
                        </button>
                    </span>
                </form>
            </div>
            <!--データ確認用-->
            <div>
            <h5>データ確認用</h5>
                <form class="uk-form-horizontal" action="" method="POST">
                    <label>◆ 更新前・更新後のファイルを確認</label>
                    <input type="hidden" name="" value="">
                    <div class="uk-margin-top">
                        <button class="uk-button uk-button-primary uk-width-1-1@s uk-width-auto@m">
                            <span uk-icon="icon: folder"></span> フォルダへ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<br><br>
</div>
</body>
</html>
