<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>医療機関削除 | 医療機関情報システム</title>
<!--CSS/JS-->
  <!-- *全画面必須 ---------->
    <!--UIkit3-->
    <link rel="stylesheet" href="../css/uikit.min.css" />
    <script src="../js/uikit.min.js"></script>
    <script src="../js/uikit-icons.min.js"></script>

    <!--style.css-->
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/form_parts.css" />
    <link rel="stylesheet" href="../css/marker.css"/><!--:*marker CSS-->

    <!--*font awesome-->
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
                <li><span>医療機関削除</span></li>
            </ul>
    </header>

<!-- **main -->
<div class="uk-card uk-card-small">
    <!--*main_header-->
    <div class="uk-container uk-container-center uk-width-2-3@m">
        <h2 class="uk-card-header">医療機関削除</h2>
    </div>

    <!--*main_body-->
    <div class="uk-margin uk-container uk-container-center uk-width-2-3@m">
    <?php
  if(!empty($data)):
foreach($data as $key => $var):
?>
        <!--*Cards-->
        <div class="uk-margin uk-card uk-card-default" style="padding:1em;">
            <div>医療機関コード：<?php echo $var['hos_cd'];?></div>
            <div>医療機関名：<?php echo $var['hos_name'];?></div>

            <div class="uk-flex uk-flex-right">
                <!--再表示ボタン、非表示ボタン-->
                <div class="uk-flex uk-flex-right">
                    <div>
                    <ul class="uk-iconnav">
                        <li><a class="uk-text-secondary" href="undoing_control.php?id=<?php echo $var['hos_cd'];?>"><span uk-icon="icon: unlock"></span> 再表示</a></li>
                        <li><a class="RED_marker uk-text-danger" href="delete_control.php?id=<?php echo $var['hos_cd'];?>"><span uk-icon="icon: trash"></span> 削除</a></li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
<?php
endforeach;
else:
    echo'データなし';
endif;
?>
    </div>


</div>
</body>
</html>
