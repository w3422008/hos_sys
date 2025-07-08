<?php 
require_once('config.php');
require_once('functions.php');
$dbh = get_db_connect();
$data = get_log_delete($dbh);
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
    .sakujo{
        color:red;
    }
    .hosname{
        width: calc(100vh/4); 
    }
        </style>

    </head>
    <body>
    <table class="log-tb1">
    
    <?php foreach($data as $key => $var): ?>
    

    <tr>
    <td class="uk-text-center"><?php echo html_escape($var['log_data']);?></td>
    <td class="uk-text-left  hosname"><?php echo html_escape($var['hos_name']);?></td>
    <td class="uk-text-center"><?php echo html_escape($var['user_name']);?></td>
    <td class="uk-text-center"><?php 
    if($var['ins']==='0'){
        echo "附属病院";
    }elseif($var['ins']==='1'){
        echo "総合医療センター";
    }elseif($var['ins']==='2'){
        echo "医療センター";
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
    <!-- <td class="uk-text-center sakujo">削除</td> -->
    </tr>

    <?php endforeach;?>

    </table>

    </body>
</html>