<?php
//$id = $_POST['id'];
$name = $_POST['name'];

$id = $_SESSION['user']['user_id'];
$name = $_SESSION['user']['user_name'];
$ins = $_SESSION['user']['ins'];
$bel = $_SESSION['user']['bel'];
$pw = $_SESSION['user']['pw'];
$adm_user = $_SESSION['user']['adm_user'];
?>



<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー新規追加 | 医療機関情報システム</title>
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
                <li><a href="user_MT_control.php">ユーザー管理</a></li>
                <li><a href="registration.php">新規追加</a></li>
                <li><span>登録内容確認</span></li>
            </ul>
    </header>


<!--【Error】；登録済のuseridが入力されたときのエラー-->
<?php //嶋津	
if(isset($err)):
?>
<div class="uk-card uk-card-small">
    <div class="uk-margin-top uk-container uk-container-center uk-width-4-5@m">
        <p class="uk-text-danger"><span uk-icon="warning"></span> <b>エラー </b>：<?php echo $err; ?></p>
    </div>

    <!--button-->	
    <div class="uk-margin-top uk-container uk-width-4-5@m">	
    <div class="uk-flex uk-flex-left">	
    <div class="uk-margin-left uk-flex-first"><!--戻る(link)-->	
        <a href="registration.php" class="uk-button uk-button-primary" name='modoru' methot=POST>戻る</a>	
    </div>	
    </div>	
    </div>	
</div>


<?php	
else:	
?>


<!--*main-->
<div class="uk-card uk-card-small">
<form action = "completion.php" method="POST">
    <!--*main_header-->
    <div class="uk-card-default uk-container uk-container-center uk-width-2-3@m">
        <div class="uk-card-header">
            <h2>新規登録内容確認</h2>
            <span>この内容でよろしいですか？</span>
        </div>

    <!--*main_body-->
    <div class="uk-margin uk-container uk-container-center uk-width-1-1@m">
        <!--*Cards(NOTAccordion)-->
        <div class="uk-margin uk-card" style="padding:1em;">
        <div class="uk-width-1-1@m">
<!--高橋UIゾーン--><!--アイコンの位置-->
                <div>
                <div>
                        <span class="uk-icon-button uk-margin-small-right" uk-icon="user"></span><!--櫻間-->
                        <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> ID：<?php echo $id;?>
                    </div>

                    <table class="uk-table uk-table-divider">
                        <tr>
                        <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> 氏名</th><!--櫻間-->
                            <td><?php echo $name;?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> 施設</th>
                            <!--嶋津20231012-->
                            <td><?php if($ins === '0'){
                                        echo "附属病院";
                                    }elseif($ins === '1'){
                                        echo "総合医療センター";
                                    }elseif($ins === '2'){
                                        echo "高齢者医療センター";
                                    };?>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> 所属</th>
                            <td>
                            <!--嶋津20231012-->
                            <?php 
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
                            }elseif($ins === '2'){
                                foreach($kourei_bel as $key=>$var):?>
                                    <?php if($bel === (string)$key){
                                            echo $var;
                                    };?>
                                    <?php endforeach; }?>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> パスワード</th>
                            <td><?php echo $pw;?></td>
                        </tr>
                        <tr>
                            <th><i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> 権限</th>
                            <td><?php echo get_adm_txt($adm_user) ?>
                            </td>
                        </tr>
                    </table>
                </div>
        </div>
        </div>
    </div>

    <!--button-->
    <div class="uk-margin-top uk-container uk-width-1-1@m">
    <div class="uk-flex uk-flex-between">
        <div class="uk-margin-right uk-flex-last"><!--次へ(form button)-->
            <input type="submit" class="uk-button uk-button-primary" value="登録">
        </div>
        <div class="uk-margin-left uk-flex-first"><!--戻る(link)-->
            <a href="registration.php" class="uk-button uk-button-primary" name='modoru' methot=POST>戻る</a>
        </div>
    </div>
    </div>
</form>
<?php endif;?>
</div>
</body>

</html>


















    
    

