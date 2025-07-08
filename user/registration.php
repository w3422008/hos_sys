<?php
//櫻間
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

include_once('../config.php');

$ins1 = '0';
//櫻間
$user_adm = $_SESSION['member']['adm_user'];
if(isset($_SESSION['user'])){	
    $user_id1 = $_SESSION['user']['user_id'];	
    $user_name1 = $_SESSION['user']['user_name'];	
    $ins1 = $_SESSION['user']['ins'];	
    $bel1 = $_SESSION['user']['bel'];	
    $pw1 = $_SESSION['user']['pw'];	
    $pw4= $_SESSION['user']['pw1'];	
    $adm_user1 = $_SESSION['user']['adm_user'];	
    }





/*
$i = 0;
$j = 0;
$k = 0;
*/

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
    <!--櫻間-->
    <script>
//嶋津20231012
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
    } else if(selboxValue == "2"){
       //文字3を表示
      document.getElementById("txt3").style.display = "";
      //文字1を非表示
      document.getElementById("txt1").style.display = "none"; 
      //文字2を非表示
      document.getElementById("txt2").style.display = "none";
    }

  }
}
</script>


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
                <li><span>新規追加</span></li>
            </ul>
    </header>

<!-- **main -->
<div class="uk-card uk-card-small">
<form action = "registration_check.php" method="POST">
    <!--*main_header-->


    <div class="uk-card-default uk-container uk-container-center uk-width-2-3@m">
        <div class="uk-card-header">
            <h2 class="uk-heading-primary">ユーザー 新規追加</h2>
            <span>ユーザー情報を入力してください。</span>
        </div>

<!--高橋UIゾーン--><!--アイコンの位置-->
    <!--*main_body-->
    <div class="uk-margin uk-container uk-container-center uk-width-1-1@m">
        <!--*Cards(NOTAccordion)-->
        <div class="uk-margin uk-card" style="padding:1em;">
        <div class="uk-width-1-1@m">

                <div>
                    <div>
                        <!--ユーザーID-->
                        
                        <h5> <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->ID：<?php if(isset($user_id1)):?><input class="uk-input uk-form-width-medium" type="text" name="user_id" id="user_id" value="<?php echo $user_id1;?>" style="border:none; font-size:1.2rem;"><!--櫻間--></h5>
	
<?php else:?>
                        <input type="text" class="uk-input uk-form-width-medium" name="user_id" id="user_id">
                        <?php endif;?>
                    </div>

                    <table class="uk-table uk-table-divider">
                        <tr>
                            <th>  <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->氏名</th>
                            <?php if(isset($user_name1)):?>
                                <td><input type="text" class="uk-input uk-form-width-large" name="user_name" id="user_name" placeholder="" value="<?php echo $user_name1;?>"></td>	
                            <?php else: ?>
                                <td><input type="text" class="uk-input uk-form-width-large" name="user_name" id="user_name" placeholder=""></td>	
                            <?php endif; ?>
                            <td></td>
                        </tr>
                        <tr>
<th> <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->施設</th>
<!--櫻間　附属なら附属の所属機関のみ表示-->
    <td>
        <!--嶋津20231012-->
        <select class="uk-select uk-form-width-large"  name="ins" id="selbox" onchange="change();">
        <?php if(isset($ins1)):?>
            <option value="0"<?php if($ins1==='0'){echo 'selected';}?>>附属病院</option>	
            <option value="1"<?php if($ins1==='1'){echo 'selected';}?>>総合医療センター
            </option>
            <option value="2"<?php if($ins1==='2'){echo 'selected';}?>>高齢者医療センター
            </option>
        <?php else:?>
            <option value="0">附属病院</option>	
            <option value="1">総合医療センター</option>	
            <option value="2">高齢者医療センター</option>
        <?php endif;?>
        </select>
    </td>
    <td></td>
    </tr>
    <tr>

<th> <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->所属</th>
    <td>
    <!--附属-->
        <select id="txt1" class="uk-select uk-form-width-large" name="bel" <?php if($ins1 !== '0'){ ?>style="display:none"<?php }?>>
                                
        <?php foreach($user_bel as $key=>$var):?>
        <?php if(isset($bel1)):?> 
             <option value="<?php echo $key;?>"<?php if($bel1===(string)$key)
             {echo'selected';}?>><?php echo $var;?></option>
        <?php else:?>
            <option value="<?php echo $key;?>"><?php echo $var;?></option>	
        <?php endif;?>
        <?php 
            endforeach;?>
        </select>
      
    <!--総合医療センター-->
        <select id="txt2" class="uk-select uk-form-width-large" name="bel2" <?php if($ins1 !== '1'){ ?>style="display:none"<?php }?>>
        <?php foreach($center_bel as $key1=>$var1):?>
        <?php if(isset($bel1)):?>
            <option value="<?php echo $key1;?>"<?php if($bel1===(string)$key1){echo'selected';}?>><?php echo $var1;?></option>
        <?php else:?>
             <option value="<?php echo $key1;?>"><?php echo $var1;?></option>	
        <?php endif;?>
        <?php 
            endforeach;?>
        </select>
    <!--嶋津20231012-->
    <!--高齢者医療センター-->
    <select id="txt3" class="uk-select uk-form-width-large" name="bel3" <?php if($ins1 !== '2'){ ?>style="display:none"<?php }?>>
        <?php foreach($kourei_bel as $key2=>$var2):?>
        <?php if(isset($bel1)):?>
            <option value="<?php echo $key2;?>"<?php if($bel1===(string)$key2){echo'selected';}?>><?php echo $var2;?></option>
        <?php else:?>
             <option value="<?php echo $key2;?>"><?php echo $var2;?></option>	
        <?php endif;?>
        <?php 
            endforeach;?>
        </select>
        
        
    </td>

    </tr>




                        <tr>
<!-- 櫻間20221104-->
<th> <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->パスワード</th>
                        <?php if(isset($pw1)&&isset($pw4)):?>
                            <th><input type="password" class="uk-input uk-width-medium"  maxlength="20" placeholder="8文字以上、大文字小文字の英数字を含むもの" id="pw"name="pw" value="<?Php echo $pw1;?>"></th>
<th id="pw_chk" style="display: none; color: red;">※半角英字大文字・小文字と数字を組み合わせた8文字以上で設定してください。</th>
</tr>
<?php //elseif(isset($pw4)): ?>
<tr>
<!-- 嶋津-->
<th> <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex--> パスワード再入力</th>
<th><input type="password" class="uk-input uk-form-width-large" maxlength="20" placeholder="8文字以上、大文字小文字の英数字を含むもの" id="repass"name="name" value="<?Php echo $pw1;?>"></th>
<th id="repass_chk" style="display: none; color: red;">パスワードが一致しません。</th>

<!-- 櫻間20221104-->
                            <?php else:?>                           
<th><input type="password" class="uk-input uk-form-width-large" maxlength="20" placeholder="8文字以上、大文字小文字の英数字を含むもの" id="pw"name="pw"></th>
<th id="pw_chk" style="display: none; color: red;">※半角英字大文字・小文字と数字を組み合わせた8文字以上で設定してください。</th>
</tr>
<tr>
    <!-- 嶋津-->
<th> <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->パスワード再入力</th>
<th><input type="password"class="uk-input uk-form-width-large" maxlength="20" placeholder="8文字以上、大文字小文字の英数字を含むもの" id="repass"name="name"></th>
<th id="repass_chk" style="display: none; color: red;">パスワードが一致しません。</th>
<?php endif;?>
</tr>
                        <tr>
                            <th> <i class="fas fa-exclamation-circle fa-lg uk-text-danger" uk-tooltip="title:入力は必須です; pos: bottom-left" tabindex="-1"></i><!--高橋20230331追加　tabindex-->権限</th>
                            <td> 
                                <select class="uk-select uk-form-width-large" name="adm_user">
                                    <?php if(isset($adm_user1)):?>
                                    <option value="0" <?php if($adm_user1==='0'){echo 'selected';}?>>一般</option>
                                    <option value="1" <?php if($adm_user1==='1'){echo 'selected';}?>>管理者</option>
                                    <option value="2" <?php if($adm_user1==='2'){echo 'selected';}?>>一般（事務）</option>
                                    <?php if($adm_user1==='3'){?><option value="3" selected>システム管理者</option><?php } ?>
                                    <?php else:?>
                                        <option value="0">一般</option>
                                    <option value="2" >一般（事務）</option>
                                    <option value="1" >管理者</option>
                                    <?php if($user_adm==='3'){ ?><option value="3" >システム管理者</option><?php } ?>
                                    <?php endif;?>
                                </select>
                            </td>
                            <td></td>
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
            <input type="submit"  class="uk-button uk-button-primary" value="次へ" id="touroku">
        </div>
        <div class="uk-margin-left uk-flex-first"><!--戻る(link)-->
            <a href="user_MT_control.php" class="uk-button uk-button-primary">戻る</a>
        </div>
    </div>
    </div>
</form>
<script>
 
 
 document.getElementById("touroku").onclick = function() { 

 
    const user_id = document.getElementById("user_id").value;

    const user_name = document.getElementById("user_name").value;     
 
    const pw = document.getElementById("pw").value;

    const repass = document.getElementById("repass").value;  


 var flag = 0; 

 if(user_id.length == 0){ flag = 1; }

 if(user_name.length == 0){ flag = 1; }

 if(pw.length == 0){ flag = 1; }    
 
 if(repass.length == 0){ flag = 1; }  
 
 if(flag == 1){ alert('必須項目が未記入の箇所があります'); return false; }     else{         flag_chk = 0;         
 
//櫻間20221104
var regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}$/;    
 if(regexp.test(pw) != true){ document.getElementById('pw_chk').style.display = "block"; flag_chk = 1; }          
   else{ document.getElementById('pw_chk').style.display = "none"; }    
 
 
 if(pw != repass){ document.getElementById('repass_chk').style.display = "block"; flag_chk = 1; }        
 
 
  else{ document.getElementById('repass_chk').style.display = "none"; }     

  if(flag_chk == 1){ return false; }       
   else{ return ture; } 
}}; </script>
</div>
</body>

</html>










