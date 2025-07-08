<?php

require_once('../config.php');
require_once('../functions.php');

session_start();

$errs['aikotoba'] = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $aikotoba = $_POST['aikotoba'];

$dbh =get_db_connect();
$errs =array();


if($aikotoba != "kawasaki"){    
    $errs['aikotoba'] = "合言葉が違います。";
}else{
    header('Location:'.SITE_URL.'message/mes_log.php');
    exit;
}
}


include_once('./message_view/login_view.php');
