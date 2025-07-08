<?php 
require_once('config.php');
require_once('functions.php');
$dbh = get_db_connect();
$data = get_log_insert($dbh);
?>

<!DOCTYPE html>
<html>
    <head>
    <!-- *全画面必須 ---------->
        <!--UIkit3-->
        <link rel="stylesheet" href="css/uikit.min.css" />
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>

        <!--style.css-->
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/buttons.css" /><!--※-->
        <!--font awesome-->
        <link rel="stylesheet" href="css/all.min.css" />
        <!--------------------* -->
        <style>
    .log-tb1{
        margin:auto;
        table-layout: fixed;
        width: 100%;
        border-collapse:collapse;
    }
    .log-tb1 th{
        padding:0.5rem;
    }
    .log-tb1 tr{
        border-bottom:1px dashed #e5e5e5;
    }


    .shinki{
    color:blue;
    }
    .hosname{
        width:calc(100vh/3);
    }

        </style>

    </head>
    <body>
    <table class="log-tb1">

    <?php foreach($data as $key => $var): ?>
    

    <tr>
    <td class="uk-text-center"><?php echo html_escape($var['log_data']);?></td>
    <td class="uk-text-left hosname"><?php echo html_escape($var['hos_name']);?></td>
    <td class="uk-text-center"><?php echo html_escape($var['user_name']);?></td>
    <td class="uk-text-center">
    <?php 
    if($var['ins']==='0'){
        echo "附属病院";
    }elseif($var['ins']==='1'){
        echo "総合医療センター";
    }elseif($var['ins']==='2'){
        echo "高齢者センター";
    }
    ?>
    <br>
    （<?php //しまづ
        if($var['ins'] === '0'){
        foreach($user_bel as $key=>$row):?>
        <?php if($var['bel'] === (string)$key){
            echo $row;
        };?>
        <?php endforeach;
        }elseif($var['ins'] === '1'){
        foreach($center_bel as $key=>$row):?>
        <?php if($var['bel'] === (string)$key){
            echo $row;
        };?>
        <?php endforeach;
        }elseif($var['ins'] === '2'){
        foreach($kourei_bel as $key=>$row):?>
        <?php if($var['bel'] === (string)$key){
            echo $row;
        };?>
        <?php endforeach;                               
        } ;?>）
    </td>
    <!-- <td class="uk-text-center shinki">新規追加</td> -->
    </tr>

    <?php endforeach;?>
    </table>
    </body>
</html>