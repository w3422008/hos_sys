<!DOCTYPE html>
<html>

<head><link rel="shortcut icon" href="../favicon.ico">
    <title>紹介データ | 医療機関情報システム</title>
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
    <script src="./file_drag_drop.js"></script>  
    <script>
     $(function(){
        var fileSelected1 = false;
        var fileSelected2 = false;
    
        // ドラッグしたままエリアに乗った＆外れたとき（#file_drag_drop_area1）
        $(document).on('dragover', '#file_drag_drop_area1', function (event) {
            event.preventDefault();
            if (!fileSelected1) {
                $(this).css("background-color", "#daecda");
            }
        });
        $(document).on('dragleave', '#file_drag_drop_area1', function (event) {
            event.preventDefault();
            if (!fileSelected1) {
                $(this).css("background-color", "transparent");
            }
        });
    
        // ドラッグした時（#file_drag_drop_area1）
        $(document).on('drop', '#file_drag_drop_area1', function (event) {
            let org_e = event;
            if (event.originalEvent) {
                org_e = event.originalEvent;
            }
    
            org_e.preventDefault();
            $('#myFile1')[0].files = org_e.dataTransfer.files;
            $(this).css("background-color", "#daecda"); // 背景色を#daecdaに設定
            fileSelected1 = true;
        });
    
        // ファイル選択時（#myFile1）
        $('#myFile1').on('change', function() {
            if (this.files.length > 0) {
                $('#file_drag_drop_area1').css("background-color", "#daecda"); // 背景色を#daecdaに設定
                fileSelected1 = true;
            } else {
                $('#file_drag_drop_area1').css("background-color", "transparent"); // 背景色を元に戻す
                fileSelected1 = false;
            }
        });
    
        // ファイル選択がキャンセルされた場合（#myFile1）
        $('#myFile1').on('click', function() {
            $(this).val(null); // ファイル選択をキャンセル
            $('#file_drag_drop_area1').css("background-color", "transparent"); // 背景色を元に戻す
            fileSelected1 = false;
        });
    
        // ドラッグしたままエリアに乗った＆外れたとき（#file_drag_drop_area2）
        $(document).on('dragover', '#file_drag_drop_area2', function (event) {
            event.preventDefault();
            if (!fileSelected2) {
                $(this).css("background-color", "#daecda");
            }
        });
        $(document).on('dragleave', '#file_drag_drop_area2', function (event) {
            event.preventDefault();
            if (!fileSelected2) {
                $(this).css("background-color", "transparent");
            }
        });
    
        // ドラッグした時（#file_drag_drop_area2）
        $(document).on('drop', '#file_drag_drop_area2', function (event) {
            let org_e = event;
            if (event.originalEvent) {
                org_e = event.originalEvent;
            }
    
            org_e.preventDefault();
            $('#myFile2')[0].files = org_e.dataTransfer.files;
            $(this).css("background-color", "#daecda"); // 背景色を#daecdaに設定
            fileSelected2 = true;
        });
    
        // ファイル選択時（#myFile2）
        $('#myFile2').on('change', function() {
            if (this.files.length > 0) {
                $('#file_drag_drop_area2').css("background-color", "#daecda"); // 背景色を#daecdaに設定
                fileSelected2 = true;
            } else {
                $('#file_drag_drop_area2').css("background-color", "transparent"); // 背景色を元に戻す
                fileSelected2 = false;
            }
        });
    
        // ファイル選択がキャンセルされた場合（#myFile2）
        $('#myFile2').on('click', function() {
            $(this).val(null); // ファイル選択をキャンセル
            $('#file_drag_drop_area2').css("background-color", "transparent"); // 背景色を元に戻す
            fileSelected2 = false;
        });
    
    // ページが読み込まれたときにファイル入力フィールドをリセット
    $(document).ready(function() {
        $('#myFile1').val(null);
        $('#file_drag_drop_area1').css("background-color", "transparent");
        fileSelected1 = false;

        $('#myFile2').val(null);
        $('#file_drag_drop_area2').css("background-color", "transparent");
        fileSelected2 = false;
    });
    
        // どちらもファイル選択されていない場合
        $(document).ready(function() {
            $('form').not('#introBackupForm,#invIntroBackupForm').on('submit', function(e) {
                var fileInput1 = $('#myFile1')[0];
                var fileInput2 = $('#myFile2')[0];
                if (fileInput1.files.length === 0 && fileInput2.files.length === 0) {
                    e.preventDefault();
                    alert('ファイルが選択されていません。');
                }
            });
        });
        
        // backupFormをクリックした際にアラートを表示
        $('#introBackupForm,#invIntroBackupForm').on('click', function(e) {
        e.preventDefault(); // デフォルトのフォーム送信を防止
        var result = confirm('バックアップ時点に戻していいですか？');
        if (result) {
             // ユーザーが「はい」を選択した場合、フォームを送信
             $(this).closest('form').submit();
        } else {
            // ユーザーが「いいえ」を選択した場合、何もしない
            return false;
        }
        });
    });
    </script>
    </head>

<body>
    <!-- **header -->
    <header uk-sticky>
    <?php include_once("../header.php"); ?>
    <!-- パンくず -->
    <ul class="uk-breadcrumb breadcrumb">
    <li><a href="../../menu/MENU_control.php">MENU</a></li>
    <li><a href="../../import/data_select.php">インポート機能</a></li>
            <li><span>紹介・逆紹介データ</span></li>
    </ul>
    </header>

    <!-- 注意書き -->
    <div class="mt-3 caution">
        <h4 class="custom-text">　!　確認事項（以下の状態ではデータインポート、アップデートが実行されない場合があります）</h4>
        <p>・ファイルのデータ形式が「csv」でない場合</p>
        <p>・ファイル内のデータ項目が異なる、または必要項目に未記載などの不備がある場合</p>
        <p>・ファイルデータの年度が複数ある場合（2023のみ〇、2023,2024...×）</p>
        <p>・その他含め問題があるファイルで実行した場合は、エラーメッセージが表示されます。</p>
    </div>

    <!-- ファイルのドラッグアンドドロップ欄（紹介データインポート） -->
    <div class="mt-3">
        <div class="detail-section" id="intro_in"><!-- 区分 -->
            <div style="width: 72%; margin-left: 4%;">
                <h4>紹介データインポート</h4>
            </div>

        <form id="file_upload_form1" method="post" enctype="multipart/form-data" action="intro_file_check.php">
            <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                <div id="file_drag_drop_area1" class="text-center p-3 rounded col-md-10 mx-auto dashed-border" style="width: 70%;">
                    ここにファイルをドラッグ&ドロップ<br/>
                    <span>または</span><br/>
                    <input id="myFile1" type="file" name="filename" multiple />
                </div>

                <div class="d-flex justify-content-center mt-2" style="width: 20%;">
                    <button type="submit" name = "intro_add" value="送信" class="uk-button uk-button-primary">送信</button>
                </div>
            </div> 
        </form>
    </div>


    <div class="mt-3">
        <div class="detail-section" id="intro_backup">
            <div style="width: 72%; margin-left: 4%;">
                <h4>紹介バックアップ復元</h4>
            </div>

            <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-widrh-1-2@m uk-width-1-2@l uk-width-1-3@xl">
                <fieldset class="uk-fieldset uk-margin" id="search-area">
                    <div>
                        <form id="introBackupForm" action="intro_file_backup.php">
                            <button type="submit" class="button_3 uk-button uk-width-1-1"><span class=""></span> <span>バックアップ時点に戻す</span></button>
                        </form>
                        <p style="color: #4c84af;">　<span class="far fa-folder"></span> バックアップデータの最新年度：<?php echo $introB_year; ?></p>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>

    <!-- ファイルのドラッグアンドドロップ欄（逆紹介データインポート）-->
    <div class="mt-3">
        <div class="detail-section" id="invers_intro_in"><!-- 区分 -->
            <div style="width: 72%; margin-left: 4%;">
                <h4>逆紹介データインポート</h4>
            </div>

        <form id="file_upload_form2" method="post" enctype="multipart/form-data" action="inv_intro_file_check.php">
            <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                <div id="file_drag_drop_area2" class="text-center p-3 rounded col-md-10 mx-auto dashed-border" style="width: 70%;">
                    ここにファイルをドラッグ&ドロップ<br/>
                    <span>または</span><br/>
                    <input id="myFile2" type="file" name="filename" multiple />
                </div>

                <div class="d-flex justify-content-center mt-2" style="width: 20%;">
                    <button type="submit" name = "invers_intro_add" value="送信" class="uk-button uk-button-primary">送信</button>
                </div>
            </div> 
        </form>
    </div>

    <!-- ファイルのドラッグアンドドロップ欄（編集） -->
    <!-- <div class="mt-3">
        <div class="detail-section" id="training_up">区分 -->
            <!-- <div style="width: 72%; margin-left: 4%;">
                <h4>データアップデート（編集：UPDATE）</h4>
            </div>

        <form id="file_upload_form" method="post" enctype="multipart/form-data" action="training_import.php">
            <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                <div id="file_drag_drop_area" class="text-center p-3 rounded col-md-10 mx-auto dashed-border" style="width: 70%;">
                    ここにファイルをドラッグ&ドロップ<br/>
                    <span>または</span><br/>
                    <input id="myFile" type="file" name="filename" multiple />
            </div>

            <div class="d-flex justify-content-center mt-2" style="width: 20%;">
                <button type="submit" name = "training_add" value="送信" class="uk-button uk-button-primary">送信</button>
            </div>
        </div> 
        </form>
    </div> -->

    <!-- バックアップ時点に戻すボタン -->
    <div class="mt-3">
        <div class="detail-section" id="intro_backup">
            <div style="width: 72%; margin-left: 4%;">
                <h4>逆紹介バックアップ復元</h4>
            </div>

            <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-widrh-1-2@m uk-width-1-2@l uk-width-1-3@xl">
                <fieldset class="uk-fieldset uk-margin" id="search-area">
                    <div>
                        <form id="invIntroBackupForm" action="inv_intro_file_backup.php">
                            <button type="submit" class="button_3 uk-button uk-width-1-1"><span class=""></span> <span>バックアップ時点に戻す</span></button>
                        </form>
                        <p style="color: #4c84af;">　<span class="far fa-folder"></span> バックアップデータの最新年度：<?php echo $invB_year; ?></p>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>