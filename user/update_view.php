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

    <!--櫻間-->

    <script>
        function change() {
        if (document.getElementById("selbox")) {
        selboxValue = document.getElementById("selbox").value;
        if (selboxValue == "0") {
            //文字1を表示
            document.getElementById("txt1").style.display = "";
            //文字2を非表示
            document.getElementById("txt2").style.display = "none";
            //文字3を非表示
            document.getElementById("txt3").style.display = "none";
        } else if (selboxValue == "1") {
            //文字2を表示
            document.getElementById("txt2").style.display = "";
            //文字1を非表示
            document.getElementById("txt1").style.display = "none";
            //文字3を非表示
            document.getElementById("txt3").style.display = "none";
        }else if (selboxValue == "2") {
            //文字3を表示
            document.getElementById("txt3").style.display = "";
            //文字1を非表示
            document.getElementById("txt1").style.display = "none";
            //文字2を非表示
            document.getElementById("txt2").style.display = "none";
        }
        }
        }
        //櫻間20230315
        function Check(){
        
        if(document.myform.user_name.value==""){
        alert("氏名は必ず入力してください。");
        return false;
        }
        return true;

        }

    
   </script>
</head> 

<body>
    <!-- **header -->
    <?php include_once("../header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="user_MT_control.php">ユーザー管理</a></li>
            <li><span>変更内容入力</span></li>
        </ul>
        
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
      <?php include_once("../footer.php"); ?>
    </footer>

    <!-- **main -->    
    <main>
    <div class="uk-container uk-card userCard uk-width-expand uk-width-5-6@l">
        <!--*main_header-->
        <div class="uk-card-header border-header">
            <h2>ユーザー情報 変更</h2>
            <span>変更したい内容を入力して<b>「変更」</b>ボタンをクリックしてください。</span>
        </div>

        <!--*main_body-->
        <!--櫻間20230315-->
        <form action = "update_check.php" method="POST" name="myform" onsubmit="return Check()" class="validationForm" novalidate>
            <?php
            foreach($data as $key => $var):
            //$_SESSION['pw'] = $var['pw'];
            ?>
                <!-- 高橋2023.01修正 -->
                <label>ID：<?php echo $var['user_id'];?></label>
                <input type="hidden" name="user_id" value="<?php echo $var['user_id'];?>"><!--櫻間-->
                <table class="uk-table tbl-bubble">
                    <thead>
                        <tr>
                            <td></td><!--項目名-->
                            <td>変更前</td><!--前-->
                            <td></td>
                            <td>変更後</td><!--後-->
                        </tr>
                    </thead>
<!--高橋UIゾーン--><!--アイコンの位置-->
                    <tbody>
                        <tr>
                            <th>氏名 <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></th><!--項目名-->
                            
                            <td style="font-size:0.9rem;"><?php echo $var['user_name'];?></td>

                            <td><i class="fas fa-arrow-right"></i></td>

                            <?php if(isset($user_name1)):?>
                            <td><input type="text" class="uk-input size-input-userName" name="user_name" value="<?php echo $user_name1;?>"></td>
                            <?php else:?>
                            <td><input type="text" class="uk-input size-input-userName" name="user_name" value="<?php echo $var['user_name'];?>"></td>
                            <?php endif;?>
                        </tr>
                        <tr>
                            <th>施設 <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></th><!--項目名-->
                            <!--櫻間　附属なら附属の所属機関のみ表示-->
                            <td><?php   
                            if($var['ins'] === '0'){
                            echo '附属病院';
                            }elseif($var['ins'] === '1'){
                            echo '総合医療センター';
                            }elseif($var['ins'] === '2'){
                            echo '高齢者医療センター';
                            };?></td>

                            <td><i class="fas fa-arrow-right"></i></td>

                            <td><select class="uk-select size-select-Ins" name="ins" id="selbox" onchange="change();">
                            <?php if(isset($ins1)):?>
                            <option value="0"<?php if($ins1==='0'){echo'selected';}?>>附属病院</option>
                            <option value="1"<?php if($ins1==='1'){echo'selected';}?>>総合医療センター</option>
                            <option value="2"<?php if($ins1==='2'){echo'selected';}?>>高齢者医療センター</option>
                            <?php else:?>
                            <option value="0"<?php if($ins==='0'){echo'selected';}?>>附属病院</option>
                            <option value="1"<?php if($ins==='1'){echo'selected';}?>>総合医療センター</option>
                            <option value="2"<?php if($ins==='2'){echo'selected';}?>>高齢者医療センター</option>
                            <?php endif;?>
                            </select></td>
                        </tr>
                        <tr>
                            <th>所属 <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></th>
                                <td><!--附属-->
                            <?php  foreach($user_bel as $key => $var1):
                                    if($var['bel'] === (string)$key){
                                        echo $var1;
                                    }
                                    endforeach;
                            ?>

                            <td><i class="fas fa-arrow-right"></i></td>

                            <td>
                                <select id="txt1" class="uk-select size-select-Bel" name="bel" <?php if($ins !== '0'){ ?>style="display:none"<?php }?>>
                                <?php foreach($user_bel as $key=>$var1):?>
                                        <option value="<?php echo $key;?>"<?php if($bel===(string)$key)
                                        {echo'selected';}?>><?php echo $var1;?></option>
                                <?php 
                                    endforeach;?>
                                </select>

                                <!--総合医療センター-->
                                <select id="txt2" class="uk-select size-select-Bel" name="bel2" <?php if($ins !== '1'){ ?>style="display:none"<?php }?>>
                                <?php foreach($center_bel as $key2=>$var2):?>
                                    <option value="<?php echo $key2;?>"<?php if($bel===(string)$key2){echo'selected';}?>><?php echo $var2;?></option>
                                <?php 
                                    endforeach;?>
                                </select>

                                <!--高齢者医療センター-->
                                <select id="txt3" class="uk-select size-select-Bel" name="bel3" <?php if($ins !== '2'){ ?>style="display:none"<?php }?>>
                                <?php foreach($kourei_bel as $key3=>$var3):?>
                                    <option value="<?php echo $key3;?>"<?php if($bel===(string)$key3){echo'selected';}?>><?php echo $var3;?></option>
                                <?php 
                                    endforeach;?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <!--櫻間-->
                            <th>権限 <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--></th>
                            <td><?php echo get_adm_txt($var['adm_user']); ?>
                            </td>

                            <td><i class="fas fa-arrow-right"></i></td>

                            <td> 
                                <select class="uk-select size-select-permission" name="adm_user">
                                <?php if(isset($adm_user1)):?>
                                <option value="0"<?php if($adm_user1==='0'){echo'selected';}?>>一般</option>
                                <option value="2"<?php if($adm_user1==='2'){echo'selected';}?>>一般（事務）</option>
                                <option value="1"<?php if($adm_user1==='1'){echo'selected';}?>>管理者</option>
                                <?php if($adm_user1==='3'){ ?><option value="3"<?php if($adm_user1==='3'){echo'selected';}?>>システム管理者</option><?php } ?>
                                <?php else:?>
                                <option value="0"<?php if($var['adm_user']==='0'){echo'selected';}?>>一般</option>
                                <option value="2"<?php if($var['adm_user']==='2'){echo'selected';}?>>一般（事務）</option>
                                <option value="1"<?php if($var['adm_user']==='1'){echo'selected';}?>>管理者</option>
                                <?php if($var['adm_user']==='3'){ ?><option value="3"<?php if($var['adm_user']==='3'){echo'selected';}?>>システム管理者</option><?php } ?>
                                <?php endif;?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php
            endforeach;
            ?>

            <!--button-->
            <div class="uk-flex uk-flex-between">
                <div class=" uk-flex-last"><!--次へ(form button)-->
                    <input type="submit"  class="uk-button uk-button-primary" value="次へ"  id="touroku" onclick="return checkForm();">
                </div>
                <div class=" uk-flex-first"><!--戻る(link)-->
                    <a href="user_MT_control.php" class="uk-button uk-button-primary">戻る</a>
                </div>
            </div>
        </form>
    </div>
    </main>
    
</body>
</html>
