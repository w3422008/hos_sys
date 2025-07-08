<?php
require_once('../functions.php');
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}


$id = $_POST['user_id'];
$name = $_POST['user_name'];
$ins = $_POST['ins'];
//嶋津20231012
if($ins === '0'){
    $bel = $_POST['bel'];
}elseif($ins === '1'){
    $bel = $_POST['bel2'];
}elseif($ins === '2'){
    $bel = $_POST['bel3'];
}

$adm_user = $_POST['adm_user'];

$user = array();
$_SESSION['user']['user_id'] = $id;
$_SESSION['user']['user_name'] = $name;
$_SESSION['user']['ins'] = $ins;
$_SESSION['user']['bel'] = $bel;
$_SESSION['user']['adm_user'] = $adm_user; /*高橋20230108修正 */


include_once('update_check_view.php');
?>