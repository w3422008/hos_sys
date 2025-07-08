<!DOCTYPE html>
<html>

<head><link rel="shortcut icon" href="../favicon.ico">
    <title>コンタクト履歴データ | 医療機関情報システム</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- *全画面必須 ---------->
    <!--UIkit3-->
    <link rel="stylesheet" href="../../css/uikit.min.css" />
    <script src="../../js/uikit.min.js"></script>
    <script src="../../js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="../../css/uk-custom.css">

    <!--style.css-->
    <link rel="stylesheet" href="../../css/style.css"/>
    <link rel="stylesheet" href="../../css/buttons.css" /><!--※-->
    <link rel="stylesheet" href="../../css/form_parts.css" />
    <link rel="stylesheet" href="../../css/marker.css"/>
    <link rel="stylesheet" href="../../css/tables.css" />

    <!--*font awesome-->
    <link rel="stylesheet" href="../../css/all.min.css" />

    <!-- ファイルのドラッグアンドドロップエリア 注意書き -->
    <link rel="stylesheet" href="../../css/import.css" />

<!--------------------* -->

    <!-- ドラッグアンドドロップのjs -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="../../import/inport_js/shared_scripts.js"></script>  
    </head>
    
    <body>
        <!-- **header -->
        <header uk-sticky>
        <?php include_once("../../header.php"); ?>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
        <li><a href="../../menu/MENU_control.php">MENU</a></li>
        <li><a href="../../import/data_select.php">インポート機能</a></li>
        <li><span>コンタクト履歴データ</span></li>
        </ul>
        </header>


        
        <!-- 注意書き -->
        <div class="mt-3 caution">
            <h4 class="custom-text">　!　確認事項（以下の状態ではデータインポート、アップデートが実行されない場合があります）</h4>
            <p>・ファイルのデータ形式が「csv」でない場合</p>
            <p>・ファイル内のデータ項目が異なる、または必要項目に未記載などの不備がある場合</p>
            <p>・その他含め問題があるファイルで実行した場合は、エラーメッセージが表示されます。</p>
        </div>
        
        <!-- ファイルのドラッグアンドドロップ欄（データインポート） -->
        <div class="mt-3">
            <div class="detail-section" id="training_in"><!-- 区分 -->
                <div style="width: 72%; margin-left: 4%;">
                    <h4>1か月</h4>
                </div>
        
            <form id="file_upload_form" method="post" enctype="multipart/form-data" action="file_check_month.php">
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <div id="file_drag_drop_area1" class="text-center p-3 rounded col-md-10 mx-auto dashed-border" style="width: 70%;">
                        ここにファイルをドラッグ&ドロップ<br/>
                        <span>または</span><br/>
                        <input id="myFile1" type="file" name="filename" multiple />
                    </div>
        
                    <div class="d-flex justify-content-center mt-2" style="width: 20%;">
                        <button type="submit" name="training_add" value="送信" class="uk-button uk-button-primary">送信</button>
                    </div>
                </div> 
            </form>
        </div>

        <!-- ファイルのドラッグアンドドロップ欄（データインポート） -->
        <div class="mt-3">
            <div class="detail-section" id="training_in"><!-- 区分 -->
                <div style="width: 72%; margin-left: 4%;">
                    <h4>1年</h4>
                </div>
        
            <form id="file_upload_form" method="post" enctype="multipart/form-data" action="file_check.php">
                <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                    <div id="file_drag_drop_area2" class="text-center p-3 rounded col-md-10 mx-auto dashed-border" style="width: 70%;">
                        ここにファイルをドラッグ&ドロップ<br/>
                        <span>または</span><br/>
                        <input id="myFile2" type="file" name="filename" multiple />
                    </div>
        
                    <div class="d-flex justify-content-center mt-2" style="width: 20%;">
                        <button type="submit" name="training_add" value="送信" class="uk-button uk-button-primary">送信</button>
                    </div>
                </div> 
            </form>
        </div>

        <div class="mt-3">
        <div class="detail-section" id="intro_backup">
            <div style="width: 72%; margin-left: 4%;">
                <h4>コンタクト履歴バックアップ復元</h4>
            </div>

            <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-widrh-1-2@m uk-width-1-2@l uk-width-1-3@xl">
                <fieldset class="uk-fieldset" id="search-area">
                    <div>
                        <form id="BackupForm" action="file_backup.php">
                            <button type="submit" class="button_3 uk-button uk-width-1-1"><span class=""></span> <span>バックアップ時点に戻す</span></button>
                        </form>
                        <p style="color: #4c84af;">　<span class="far fa-folder"></span> バックアップデータの最新年月：<?php echo $contactB_ym ?></p>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

</body>
</html>