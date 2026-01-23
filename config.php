<?php

// 20250522_畑　local-Link
// DB関連
define('DSN', 'mysql:dbname=hosplistdb;host=localhost;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
// define('SITE_URL','http://localhost:8080/hos_sys/'); 
define('SITE_URL', 'http://localhost:8080/hos_sys/');

// サイト関連
define('password_URL', SITE_URL . 'password/password_control.php');
define('logout_URL', SITE_URL . 'login/logout.php');
define('MENU_URL', SITE_URL . 'menu/MENU_control.php');
define('search_URL', SITE_URL . 'search/checkbox_control.php?search=');
define('user_URL', SITE_URL . 'user/user_MT_control.php');
define('hospital_URL', SITE_URL . 'hos_management/manage_control.php');
define('comments_URL', SITE_URL . 'contact_us/history.php');

// マニュアル
// 一般・事務用マニュアル
define('MANUAL_URL', SITE_URL . 'manual/manual_general.pdf');
// 管理者用マニュアル
define('ADM_MANUAL_URL', SITE_URL . 'manual/manual_admin.pdf');
// システム管理者用マニュアル
define('SYSADM_MANUAL_URL', SITE_URL . 'manual/manual.pdf');


// CSS関連
define('headerCss_URL', SITE_URL . 'css/header.css');

// 20250522_畑　Server-Link
// DB関連
// define('DSN','mysql:dbname=hosplistdb;host=localhost;charset=utf8mb4');
// define('DB_USER','hosplist_adm');
// define('DB_PASSWORD','q3#FZXcQs');

// サイト関連
// define('SITE_URL','https://hosplist.kawasaki-m.ac.jp/'); 
// define('password_URL', SITE_URL.'password/password_control.php');
// define('logout_URL', SITE_URL.'login/logout.php');

// define('MENU_URL', SITE_URL.'menu/MENU_control.php');
// define('search_URL', SITE_URL.'search/checkbox_control.php?search=');
// define('user_URL', SITE_URL.'user/user_MT_control.php');
// define('hospital_URL', SITE_URL.'hos_management/manage_control.php');
// define('comments_URL', SITE_URL.'contact_us/history.php');

// マニュアル
// define('manual_URL', SITE_URL.'manual/5th_manual.pdf');
// define('adm_manual_URL', SITE_URL.'manual/5th_adm_manual.pdf');
define('Sysadm_manual_URL', SITE_URL . 'manual/5th_manual_admin.pdf');

// CSS関連
// define('headerCss_URL', SITE_URL . 'css/header.css');

//嶋津
$user_bel = array(
    '0' => '患者診療支援センター',
    '1' => '企画部企画室',
    '2' => '病院働き方改革推進室',
    '3' => '病院庶務課',
    '4' => '医療資料部',
    '5' => '医事課'
);
//櫻間20221107、嶋津20221110
$center_bel = array(
    '0' => '患者診療支援センター',
    '1' => '医事課',
    '2' => '医療資料部',
    '3' => '病院庶務課 庶務係'
);
$kourei_bel = array(
    '0' => '病院事務室',
    '1' => '患者診療支援センター',
);

//時刻場所（タイムゾーン）東京
date_default_timezone_set('Asia/Tokyo');
?>