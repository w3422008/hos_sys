<?php
require_once('../functions.php');
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}
$user_id = $_POST['user_id'];
$user_name = $_POST['user_name'];
$ins = $_POST['ins'];
//嶋津20231012
if($ins === '0'){
    $bel = $_POST['bel'];
}elseif($ins === '1'){
    $bel = $_POST['bel2'];
}elseif($ins === '2'){
    $bel = $_POST['bel3'];
}
$pw = $_POST['pw'];
$pw3=$_POST['name'];
$adm_user = $_POST['adm_user'];


//嶋津
$dbh = get_db_connect();
$user_check = user_check($dbh,$user_id);
foreach($user_check as $key => $var):
    if($user_id === $var['user_id']){
        $err="そのIDはすでに登録されています。";
}
endforeach;


$user = array();
$_SESSION['user']['user_id'] = $user_id;
$_SESSION['user']['user_name'] = $user_name;
$_SESSION['user']['ins'] = $ins;
$_SESSION['user']['bel'] = $bel;
$_SESSION['user']['pw'] = $pw;
$_SESSION['user']['pw1'] = $pw3;
$_SESSION['user']['adm_user'] = $adm_user;

include_once('registration_check_view.php');
?>