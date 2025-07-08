<?php
require_once('config.php');
require_once('functions.php');
//require_once('functions.php');


session_start();
$errs =array();

$_SESSION["time_out"]= time() + 60 * 30; //セッションの有効期限を30分に設定

// 20240618_大橋_メンテ中画面関係
if(isset($admin_pass_err)){
    $_SESSION['admin_pass_err'] = $admin_pass_err;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['user_id'];

    $password = $_POST['password']; 

    $dbh =get_db_connect();




    if(!$member = select_member($dbh, $id, $password)){    
        $errs['passwrod'] = 'IDまたはパスワードが一致しません。';
    }else{ //高橋20221123ここから
    $hide_member = get_result2($dbh);
    foreach($hide_member as $key=> $var):
        if($id === $hide_member[$key]['user_id']){
            $errs['passwrod'] = '利用停止中';
        }
    endforeach;
    } //高橋2022112 ここまで



    if(empty($errs)){
        session_regenerate_id(true);

        $_SESSION['member'] = $member;
        header('Location:'.SITE_URL.'./menu/MENU_control.php');
        exit;
    }
}

// 三宅20240813 versionの取得
if(empty($version)){
    $dbh =get_db_connect();
    $errs =array();
    $version = get_version($dbh);
}

include_once('./index_view.php');

