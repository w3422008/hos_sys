<?php
require_once('../functions.php');

session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}
include_once('../config.php');


$user_id = $_GET['id'];

$dbh = get_db_connect();

$data = get_data1($dbh,$user_id);

foreach($data as $key=>$var):
$user_name = $var['user_name'];
$ins = $var['ins'];
$bel = $var['bel'];

$adm_user = $var['adm_user'];
endforeach;

if(isset($_SESSION['user'])){
$user_id1 = $_SESSION['user']['user_id'];
$user_name1 = $_SESSION['user']['user_name'];
$ins1 = $_SESSION['user']['ins'];
$bel1 = $_SESSION['user']['bel'];

$adm_user1 = $_SESSION['user']['adm_user'];
}

if(isset($bel1)){
    $bel = $bel1;
}

if(isset($ins1)){
    $ins = $ins1;
}

include_once('update_view.php');
?>