<?php
define("KAWASAKI_URL", "https://w.kawasaki-m.ac.jp/");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" href="../favicon.ico">
    <title>データインポート | 医療機関情報システム</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--UIkit3-->
    <link rel="stylesheet" href="../css/uikit.min.css" />
    <script src="../js/uikit.min.js"></script>
    <script src="../js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="../css/uk-custom.css">

    <!--style.css-->
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/buttons.css" /><!--※-->
    <link rel="stylesheet" href="../css/form_parts.css" />
    <link rel="stylesheet" href="../css/marker.css"/>
    <link rel="stylesheet" href="../css/tables.css" />

    <!--*font awesome-->
    <link rel="stylesheet" href="../css/all.min.css" />

    <!-- ファイルのドラッグアンドドロップエリア 注意書き -->
    <link rel="stylesheet" href="../css/import.css" />

    <!-- jQuery & ドラッグアンドドロップ共通JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

</head>
<body>
    <!-- **header -->
    <header uk-sticky>
        <?php include_once("../header.php"); ?>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><span>データインポート</span></li>
        </ul>
    </header>
    
    <!-- 付箋風メッセージ表示用エリア -->
    <div id="sticky-note-area"></div>
    <!-- 注意書き -->
    <div class="mt-3 caution">
        <div class="caution-contents">
            <h4 class="custom-text">　!　確認事項（以下の状態ではデータインポート、アップデートが実行されない場合があります）</h4>
            <p>・ファイルのデータ形式が「csv」でない場合</p>
            <p>・ファイル内のデータ項目が異なる、または必要項目に未記載などの不備がある場合</p>
            <!-- <p>・ファイルデータの年度・年月が複数ある場合（例：2023のみ〇、2023,2024...×）</p> -->
            <p>・その他含め問題があるファイルで実行した場合は、エラーメッセージが表示されます。</p>
        </div>
    </div>

    <!-- データ種別切り替えタブ -->
    <!-- <div class="uk-flex uk-flex-center"> -->
        <ul class="uk-tab uk-flex-center" data-uk-tab>
            <li class="uk-active"><a href="#">紹介データ</a></li>
            <li><a href="#">逆紹介データ</a></li>
            <li><a href="#">コンタクト履歴データ</a></li>
            <li><a href="#">兼業データ</a></li>
        </ul>
    <!-- </div> -->

    <ul class="uk-switcher uk-margin">
        <!-- 紹介データ -->
        <li>
            <div class="mt-3">
                <div class="import-section">
                    <div class="band">
                        <h4>紹介データインポート（1ヶ月）</h4>
                    </div>
                    <form id="file_upload_form_intro_month" method="post" enctype="multipart/form-data">
                        <div class="uplade_content">
                            <div id="file_drag_drop_area_intro_month" class="file_drag_drop_area display_left rounded dashed-border">
                                <span class="upload_font-size">ここにファイルをドラッグ&ドロップ<br/>または<br/></span>
                                <button type="button" id="customFileBtn_intro_month" class="uk-button uk-button-default upload_font-size">こちらからファイルを選択</button>
                                <input id="myFile_intro_month" type="file" name="filename" multiple style="display:none;" />
                            </div>
                            <span id="fileName_intro_month" class="display_left"></span>
                            <div class="d-flex justify-content-center mt-2 text-center">
                                <button type="submit" name="introM_add" value="送信" class="uk-button uk-button-primary">送信</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- バックアップ復元 -->
                <div class="backup-section">
                    <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-width-1-2@m uk-width-1-3@xl">
                        <fieldset class="uk-fieldset uk-margin" id="search-area">
                            <form id="introBackupForm">
                                <button type="submit" class="button_3 uk-button uk-width-1-1"> 
                                    <span></span> <span>バックアップ</span>
                                </button>
                            </form>

                            <p style="color: #4c84af;">　<span class="far fa-folder"></span> インポート済データの最新年月：<?php echo $intro_ym ?? ""; ?></p>
                            <p style="color: #4c84af;">　<span class="far fa-calendar"></span> 最終バックアップ年月日：<span id="IntroLatestBackup"></span></p>
                        </fieldset>
                    </div>
                </div>
            </div>
        </li>
        <!-- 逆紹介データ -->
        <li>
            <div class="mt-3">
                <div class="import-section">
                    <div class="band">
                        <h4>逆紹介データインポート（1ヶ月）</h4>
                    </div>
                    <form id="file_upload_form_invintro_month" method="post" enctype="multipart/form-data">
                        <div class="uplade_content">
                            <div id="file_drag_drop_area_invintro_month" class="file_drag_drop_area display_left rounded dashed-border">
                                <span class="upload_font-size">ここにファイルをドラッグ&ドロップ<br/>または<br/></span>
                                <button type="button" id="customFileBtn_invintro_month" class="uk-button uk-button-default upload_font-size">こちらからファイルを選択</button>
                                <input id="myFile_invintro_month" type="file" name="filename" multiple style="display:none;" />
                            </div>
                            <span id="fileName_invintro_month" class="display_left"></span>
                            <div class="d-flex justify-content-center mt-2 text-center">
                                <button type="submit" name="inversintroM_add" value="送信" class="uk-button uk-button-primary">送信</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- バックアップ復元 -->
                <div class="backup-section">
                    <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-width-1-2@m uk-width-1-3@xl">
                        <fieldset class="uk-fieldset uk-margin" id="search-area">
                            <form id="invIntroBackupForm" action="inv_intro_file_backup.php">
                                <button type="submit" class="button_3 uk-button uk-width-1-1"><span></span> <span>バックアップ</span></button>
                            </form>
                            <p style="color: #4c84af;">　<span class="far fa-folder"></span> インポート済データの最新年月：<?php echo $inv_ym ?? ""; ?></p>
                            <p style="color: #4c84af;">　<span class="far fa-calendar"></span> 最終バックアップ年月日：<span id="InvIntroLatestBackup"></span></p>
                        </fieldset>
                    </div>
                </div>
            </div>
        </li>
        <!-- コンタクト履歴データ -->
        <li>
            <div class="mt-3">
                <div class="import-section">
                    <div class="band">
                        <h4>コンタクト履歴データインポート（1ヶ月）</h4>
                    </div>
                    <form id="file_upload_form_contact_month" method="post" enctype="multipart/form-data">
                        <div class="uplade_content">
                            <div id="file_drag_drop_area_contact_month" class="file_drag_drop_area display_left rounded dashed-border">
                                <span class="upload_font-size">ここにファイルをドラッグ&ドロップ<br/>または<br/></span>
                                <button type="button" id="customFileBtn_contact_month" class="uk-button uk-button-default upload_font-size">こちらからファイルを選択</button>
                                <input id="myFile_contact_month" type="file" name="filename" multiple style="display:none;" />
                            </div>
                            <span id="fileName_contact_month" class="display_left"></span>
                            <div class="d-flex justify-content-center mt-2 text-center">
                                <button type="submit" name="contactM_add" value="送信" class="uk-button uk-button-primary">送信</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- バックアップ復元 -->
                <div class="backup-section">
                    <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-width-1-2@m uk-width-1-3@xl">
                        <fieldset class="uk-fieldset" id="search-area">
                            <form id="contactBackupForm" action="file_backup.php">
                                <button type="submit" class="button_3 uk-button uk-width-1-1"><span></span> <span>バックアップ</span></button>
                            </form>
                            <p style="color: #4c84af;">　<span class="far fa-folder"></span> インポート済データの最新年月：<?php echo $contact_ym ?? ""; ?></p>
                            <p style="color: #4c84af;">　<span class="far fa-calendar"></span> 最終バックアップ年月日：<span id="ContactLatestBackup"></span></p>
                        </fieldset>
                    </div>
                </div>
            </div>
        </li>
        <!-- 兼業データ -->
        <li>
            <div class="mt-3">
                <div class="import-section">
                    <div class="band">
                        <h4>兼業データインポート</h4>
                    </div>
                    <form id="file_upload_form_training" method="post" enctype="multipart/form-data">
                        <div class="uplade_content">
                            <div id="file_drag_drop_area_training" class="file_drag_drop_area display_left rounded dashed-border">
                                <span class="upload_font-size">ここにファイルをドラッグ&ドロップ<br/>または<br/></span>
                                <button type="button" id="customFileBtn_training" class="uk-button uk-button-default upload_font-size">こちらからファイルを選択</button>
                                <input id="myFile_training" type="file" name="filename" multiple style="display:none;" />
                            </div>
                            <span id="fileName_training" class="display_left"></span>
                            <div class="d-flex justify-content-center mt-2 text-center">
                                <button type="submit" name="training_add" value="送信" class="uk-button uk-button-primary">送信</button>
                            </div>
                        </div>
                        <div class="aaa"></div>
                    </form>
                </div>
                <!-- バックアップ復元 -->
                <div class="backup-section">
                    <div class="uk-margin-large-top uk-margin-large-bottom uk-container uk-container-center uk-width-1-2@m uk-width-1-3@xl">
                        <fieldset class="uk-fieldset uk-margin" id="search-area">
                            <form id="trainingBackupForm" action="file_backup.php">
                                <button type="submit" class="button_3 uk-button uk-width-1-1"><span></span> <span>バックアップ</span></button>
                            </form>
                            <p style="color: #4c84af;">　<span class="far fa-folder"></span> インポート済データの最新年度：<?php echo $training_year ?? ""; ?></p>
                            <p style="color: #4c84af;">　<span class="far fa-calendar"></span> 最終バックアップ年月日：<span id="TrainingLatestBackup"></span></p>
                        </fieldset>
                    </div>
                </div>
            </div>
        </li>
    </ul>

    <!-- 確認用モーダル -->
    <div id="import-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <div id="import-modal-message"></div>
            <div class="uk-text-center uk-margin-top">
                <button id="import-modal-submit" class="uk-button uk-button-primary" style="margin-right:20px;">インポート</button>
                <button id="import-modal-cancel" class="uk-button uk-button-default">戻る</button>
            </div>
        </div>
    </div>

    <!-- 不一致確認用モーダル -->
    <div id="mismatch-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body" style="width: 90%; max-width: 1200px;">
            <div id="mismatch-modal-message"></div>
            <div class="uk-text-center uk-margin-top">
                <button id="mismatch-modal-submit" class="uk-button uk-button-danger" style="margin-right:20px;">了承し、インポートを行う</button>
                <button id="mismatch-modal-cancel" class="uk-button uk-button-default">キャンセル</button>
            </div>
        </div>
    </div>

    <!-- バックアップ一覧モーダル -->
    <div id="backup-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h3 id="backup-modal-title">バックアップ一覧</h3>
            <ul id="backup-list"></ul>
            <div class="uk-text-center uk-margin-top">
                <button id="close-backup-modal" class="uk-button uk-button-default" uk-modal-close>閉じる</button>
            </div>
        </div>
    </div>

    <!-- インポート中モーダル -->
    <div id="loading-modal" uk-modal class="loading-modal">
        <div class="uk-modal-dialog uk-modal-body uk-text-center">
            <div uk-spinner="ratio: 2"></div>
            <h3>インポート処理中...</h3>
            <p>しばらくお待ちください。</p>
        </div>
    </div>

    <script>
        // PHPからJSへデータ受け渡し        
        const folderFiles = <?php echo json_encode($folderFiles); ?>;
        window.folderFiles = folderFiles;
    </script>
    <script src="import_js/functions.js"></script>
    <script src="import_js/main.js"></script>
    
</body>
</html>