<?php
require_once('../functions.php');
session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}
$id = $_POST['user_id'];
$pw1 = $_POST['pw'];
$pw3=$_POST['name'];

$password_clear = array();
    $_SESSION['password_clear']['id'] = $id;
    $_SESSION['password_clear']['pw'] = $pw1;
    $_SESSION['password_clear']['pw1'] = $pw3;

  //櫻間  

include_once('clear_check_view.php');



?>