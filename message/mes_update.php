<?php
require_once('../config.php');
require_once('../functions.php');


session_start();

$id = $_GET['id'];

$dbh = get_db_connect();
$change_data = get_select_message($dbh,$id);


if(!empty($change_data)){
$situation = $change_data[0]['situation'];
if( $change_data['0']['req_fac']==="附"){
    $req_fac = '附属病院';
}elseif( $change_data['0']['req_fac']==="総"){
    $req_fac = '総合医療センター';
}elseif( $change_data['0']['req_fac']==="福祉大"){
    $req_fac = '医療福祉大学';
}elseif( $change_data['0']['req_fac']==="その他"){
    $req_fac = 'その他';
}
$req_dep = $change_data[0]['req_dep'];
$req_date = $change_data[0]['req_date'];
$res_date = $change_data[0]['res_date'];
$version = $change_data[0]['version'];
$comment = $change_data[0]['comment'];
$view = $change_data[0]['view'];
}




    $_SESSION['message']['id'] = $id;
    $_SESSION['message']['req_fac'] = $req_fac;
    $_SESSION['message']['req_dep'] = $req_dep;
    $_SESSION['message']['req_date'] = $req_date;
/*     $_SESSION['message']['situation'] = $situation;
    $_SESSION['message']['req_fac'] = $req_fac;
    $_SESSION['message']['req_dep'] = $req_dep;
    $_SESSION['message']['date'] = $date;
    $_SESSION['message']['comment'] = $comment;
    $_SESSION['message']['view'] = $view; */
   



include_once('./message_view/mes_update_view.php');
?>