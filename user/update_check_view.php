<?php
//$name = $_POST['name'];
?>

<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー情報 変更 | 医療機関情報システム</title>
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
        <div class="breadcrumb uk-container  uk-width-expand">
            <ul class="uk-breadcrumb">
                <li><a href="../menu/MENU_control.php">MENU</a></li>
                <li><a href="user_MT_control.php">ユーザー管理</a></li>
                <li><a href="javascript:history.back();">変更内容入力</a></li>
                <li><span>変更内容確認</span></li>
            </ul>
        </div>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
      <?php include_once("../footer.php"); ?>
    </footer>

    <!-- **main -->
    <main>
    <div class="uk-container uk-card userCard uk-width-expand uk-width-5-6@l">
        <!--*main_header-->
        <div class="uk-card-header uk-alert-success" uk-alert>
            <h2>変更確認</h2>
            <span>この内容でよろしいですか？</span>
        </div>
        <!--高橋UIゾーン--><!--アイコンの位置-->
        <!--*main_body-->
        <span>ID：<?php echo $id;?></span><!--櫻間-->
        <table class="uk-table tbl-bubble">
            <tr>
                <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> 氏名</th><!--櫻間-->
                <td><?php echo $name;?></td>
            </tr>
            <tr>
                <th> <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> 施設</th>
                <td><?php
                if($ins === '0'){
                    echo "附属病院";
                }elseif($ins === '1'){
                    echo "総合医療センター";
                }elseif($ins === '2'){
                    echo "高齢者医療センター";
                };?></td>
            </tr>
            <tr>
                <th> <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> 所属</th>
                <td>
                <?php 
                //嶋津20231012
                    if($ins === '0'){
                        foreach($user_bel as $key=>$var):?>
                        <?php if($bel === (string)$key){
                                echo $var;
                        };?>
                        <?php endforeach;
                    }elseif($ins === '1'){
                        foreach($center_bel as $key=>$var):?>
                            <?php if($bel === (string)$key){
                                    echo $var;
                            };?>
                            <?php endforeach;                               
                    } elseif($ins === '2'){
                        foreach($kourei_bel as $key=>$var):?>
                            <?php if($bel === (string)$key){
                                    echo $var;
                            };?>
                            <?php endforeach;                               
                    } ?>
                </td>
            </tr>
            <!--櫻間-->
            <tr>
                <th> <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> 権限</th>
                <td>
                <?php echo get_adm_txt($adm_user)?>
                </td>
            </tr>
        </table>

        <!--button-->
        <div class="uk-flex uk-flex-between">
            <div class="uk-flex-last"><!--変更-->
                <a href="updated.php" class="uk-button uk-button-primary">変更</a>
            </div>

            <div class="uk-flex-first"><!--戻る-->
                <a href="javascript:history.back();" class="uk-button uk-button-primary">戻る</a>
            </div>
        </div>
    </div>
    </main>
</body>
</html>