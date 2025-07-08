<!DOCTYPE html>
<html lang="ja">
<head><link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--櫻間20230511-->
    <title>削除　ログ | 医療機関情報システム</title>
    <!--CSS/JS-->
    <!-- *全画面必須 ---------->
        <!--UIkit3-->
        <link rel="stylesheet" href="../css/uikit.min.css" />
        <script src="../js/uikit.min.js"></script>
        <script src="../js/uikit-icons.min.js"></script>
        <link rel="stylesheet" href="../css/uk-custom.css">

        <!--style.css-->
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/form_parts.css" />
        <link rel="stylesheet" href="../css/marker.css"/>
        <link rel="stylesheet" href="../css/tables.css" />

        <!--*font awesome-->
        <link rel="stylesheet" href="../css/all.min.css" />
    <!--------------------* -->
<!--20231031櫻間-->


</head> 

<body>
    <!-- **header -->
    <?php include_once("../header.php"); ?>
    <header uk-sticky>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="../hos_management/manage_control.php">医療機関管理</a></li>
            <li><span>削除　ログ</span></li>
        </ul>
    </header>

    <!-- **footer ページ下部固定 -->
    <footer uk-sticky="position: bottom">
        <?php include_once("../footer.php"); ?>
    </footer>

    <!-- **main -->
    <main>
    <div class="uk-container uk-width-expand">
        <!-- *main_header -->
            <div class="uk-card-header uk-flex uk-flex-middle uk-flex-between">
                <h2>削除　ログ</h2>

            </div>

        <!-- *main_body -->

        <?php 
        if(!empty($data)){
        ?>               
               

                <!-- **Table -->
                <table class="uk-table uk-table-hover uk-table-responsive tbl-line fixed-thead">
                    <thead>
                        <tr>
                        <th class="uk-table-shrink"></th>
                            <th class="uk-table-shrink"></th>
                            <th class="uk-table-shrink"></th>
                            <th class="uk-table-medium">医療機関コード</th>
                            <th class="uk-table-expand">医療機関名</th>
                            <th class="uk-table-medium">登録ユーザーID／登録ユーザー氏名</th>
                            <th class="uk-width-medium">登録ユーザー施設／登録ユーザー所属</th>
                            <th class="uk-width-medium">登録日</th>
                            <th class="uk-table-shrink"></th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach($data as $key => $var):
                        ?>
                        <tr>
                        <div>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                    <label for="hos_cd">ID：</label>
                                    <u><?php echo html_escape($var['hos_cd']); ?></u>
                              
                            </td>    
                            <td>
                            <span style="font-size:1.2em;">
                                    <?php echo html_escape($var['hos_name']); ?>
                        </span>
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
                            </td>
                            <td class="uk-text-truncate">
                                <div>
                                    <?php if($var['ins'] === '0'){ ?>
                                        <span><?php echo "附属病院"; ?></span>
                                    <?php }elseif($var['ins'] === '1'){ ?>
                                        <span><?php echo "総合医療センター"; ?></span>
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
                                    } 
                                    ?>
                                ）</div>
                            </td>
                            <td>
                                <div><?php echo html_escape($var['log_data']); ?></div>
                            </td>

                        </tr>
                        <?php
                        endforeach; 
                        ?>
                    </tbody>

                </table>
                <!-- **Tableここまで -->

  

       <?php  
         }else{
               if(!(isset($_GET['user_id']))){ 
                /*データなし*/ ?>
                <div class="uk-margin-top uk-container uk-container-center uk-width-1-1@l">
                    <p class="uk-text-danger"><span uk-icon="warning"></span> <b style="border-bottom:1px solid;">データなし</b>：新規追加ログがありません</p>
                </div>
        <?php  }
            } 
        ?> 
        </div>
    </main>
<!--櫻間20230511-->

</body>
    

</html>