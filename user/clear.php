<?php
require_once('../functions.php');

session_start();

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$user_id = $_GET['id'];

if(isset($_SESSION['password_clear'])){		
    $pw1 = $_SESSION['password_clear']['pw'];	
    $pw4= $_SESSION['password_clear']['pw1'];	

    }

$dbh = get_db_connect();

$data = get_data1($dbh,$user_id);

include_once('clear_view.php');