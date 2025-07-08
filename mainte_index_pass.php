<?php
$_SESSION['admin_pass'] = $_POST['admin_pass']; 
//var_dump($_SESSION['admin_pass']);
// 20240618_大橋_メンテ中画面関係
if($_SESSION['admin_pass'] !== 'kawasaki'){
    $admin_pass_err = '管理者テストのパスワードが違います';
    include_once('./index.php');
}elseif($_SESSION['admin_pass'] === 'kawasaki'){

    
// 個々からはindex.phpの機能
require_once('./config.php');
require_once('./functions.php');
//require_once('functions.php');


session_start();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['user_id'];

    $password = $_POST['password']; 

    $dbh =get_db_connect();
    $errs =array();



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

$_SESSION['token'] = bin2hex(random_bytes(32)); // 64文字のランダムトークン
include_once('./admin_mainte/mainte_index_view.php');
}
