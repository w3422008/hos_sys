<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー利用停止 解除 | 医療機関情報システム</title>
    <!--CSS/JS-->
    <!-- *全画面必須 ---------->
        <!--UIkit3-->
        <link rel="stylesheet" href="../css/uikit.min.css" />
        <script src="../js/uikit.min.js"></script>
        <script src="../js/uikit-icons.min.js"></script>
        <link rel="stylesheet" href="../css/uk-custom.css">
        <!--style.css-->
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/tables.css"/>
        <link rel="stylesheet" href="../css/form_parts.css" />
        <link rel="stylesheet" href="../css/marker.css"/><!--:*marker CSS-->
        <!--*font awesome-->
        <link rel="stylesheet" href="../css/all.min.css" />
    <!--------------------* -->
        <link rel="stylesheet" href="../css/cards.css"/>
    <style>
    </style>
</head> 

<body>
    <!-- **header -->
    <?php include_once("../header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="user_MT_control.php">ユーザー管理</a></li>
            <li><span>停止解除</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
      <?php include_once("../footer.php"); ?>
    </footer>

    <!-- **main -->
    <main>
    <div class="uk-container uk-card userCard uk-width-expand uk-width-5-6@l uk-width-2-3@xl">
        <!--*main_header-->
        <div class="uk-card-header">
            <h2><i class="fas fa-unlock-alt"></i> ユーザー利用停止 解除</h2>
            <span>「<b>停止解除</b>」をクリックすると、ユーザー利用停止が解除されます</span>
        </div>


        <!--*main_body
            --確認画面へのユーザー情報出力 -->
        <?php
        foreach($data as $key => $var):
        ?>
            <!-- **Table -->
            <table class="uk-table uk-table-hover uk-table-responsive">
                <thead>
                    <tr>
                        <th class="uk-table-shrink"></th>
                        <th class="uk-table-shrink"></th>
                        <th class="uk-table-shrink"></th>
                        <th class="uk-table-expand">ID／氏名</th>
                        <th class="uk-width-medium">施設／所属</th>
                        <th class="uk-width-medium">履歴</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <?php if($var['onf']==='0'){ ?>
                                <i class="fas fa-check-circle"></i>
                            <?php }elseif($var['onf']==='1'){ ?>
                                <i class="fas fa-ban"></i>
                            <?php } ?>
                        </td>
                        <td>
                            <i class="fas fa-user-circle fa-2x" style="color:#aaa;"></i>
                        </td>
                        <td>            
                            <!-- 権限ごとにlabelの色を変更 -->
                            <?php echo get_adm_label($var['adm_user']); ?>
                        </td>
                        <td>
                            <div>
                                <label for="user_id">ID：</label>
                                <u><?php echo html_escape($var['user_id']); ?></u>
                            </div>
                            <div>
                                <span style="font-size:1.2em;">
                                <?php echo html_escape($var['user_name']); ?>
                                </span>
                            </div>
                        </td>
                        <td class="uk-text-truncate">
                            <div>
                                <!--嶋津20231012-->
                                <?php if($var['ins'] === '0'){ ?>
                                    <span><?php echo "附属病院"; ?></span>
                                <?php }elseif($var['ins'] === '1'){ ?>
                                    <span><?php echo "総合医療センター"; ?></span>
                                <?php }elseif($var['ins'] === '2'){ ?>
                                    <span><?php echo "高齢者医療センター"; ?></span>
                                <?php };?>                      
                            </div>
                            <div>（
                                <?php //嶋津
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
                                } 
                                ?>
                            ）</div>
                        </td>
                        <td>
                            <?php if($var['onf']==='0'){ ?>
                            <div>開始日：<?php echo html_escape($var['start']); ?></div>
                            <div>変更日：<?php echo html_escape($var['up_date']); ?></div>
                            <?php }elseif($var['onf']==='1'){ ?>
                            <div>利用停止日：<?php echo html_escape($var['end']); ?></div>
                            <?php } ?>
                        </td>
                    </tr>

                </tbody>
            </table>
            <!-- **Tableここまで -->

            <br>

            <!--button-->
            <div class="uk-flex uk-flex-between">
                <div class="uk-margin-left"><!--ユーザー利用停止-->
                    <a href="user_MT_control.php" class="uk-button uk-button-secondary">戻る</a>
                </div>
                <div class="uk-margin-right"><!--新規-->
                    <a href="undid.php?id=<?php echo $var['user_id'];?>" class="uk-button uk-button-primary">停止解除</a>
                </div>
            </div>    
        <?php
        endforeach; 
        ?>

    </div>
    </main>
</body>
</html>

