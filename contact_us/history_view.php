<!-- 20241028　加藤 ページ全体作成 -->
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="../favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>問い合わせ管理｜医療機関システム</title>

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
        <link rel="stylesheet" href="../css/contact_us.css" />

        <!--*font awesome-->
        <link rel="stylesheet" href="../css/all.min.css" />
        <!--------------------* -->

    </head>

    <body class="h_body">
        <!-- **header -->
        <?php include_once("../header.php"); ?>
        <script>
            // 部署情報をJavaScript変数に代入
            var u_bel=<?php echo $json_user_bel; ?>;
            var c_bel=<?php echo $json_center_bel; ?>;
            var k_bel=<?php echo $json_old_bel; ?>;
            var user_id="<?php echo $user_id; ?>";
            var adm_id="<?php echo $adm_id; ?>";
        </script>
        <header uk-sticky>
            <!-- パンくず -->
            <ul class="uk-breadcrumb breadcrumb">
                <li><a href="../menu/MENU_control.php">MENU</a></li>
                <li><span>お問い合わせ</span></li>
            </ul>
        </header>

        <!-- **footer ページ下部固定-->
        <footer uk-sticky="position: bottom">
            <!--  下から一番上に直ぐ戻ってくるボタン  -->
            <div style="position: relative;">
                <a href="#" class="to-top" uk-scroll><i class="fas fa-angle-up fa-lg"></i></a>
            </div>
        </footer>

        <!-- **main -->
        <main>
            <!-- 全体的に中央に寄る -->
            <div class=" uk-container uk-width-expand set-width">
                <h2 id="contact_h2">依頼一覧</h2>

                <!-- 依頼内容入力フォーム -->
                <ul uk-accordion id="add_question">
                    <li>
                        <a class="uk-accordion-title" href="#">依頼内容を入力</a>
                        <div class="uk-accordion-content">
                            <div class="ci_body">
                                <!-- 依頼入力欄 -->
                                <div class="uk-container">
                                    <form id="contactForm" enctype="multipart/form-data">
                                        <div class="uk-grid-small uk-child-width-auto uk-grid">
                                            <div class="toggle-button">
                                                <input class="uk-radio" type="radio" id=normal name="emerg" value="0" checked>
                                                <label for="normal">通常</label>
                                                <input class="uk-radio" type="radio" id=urgent name="emerg" value="1">
                                                <label for="urgent">緊急</label>
                                            </div>
                                            <div class="uk-margin">
                                                <input class="c_image-input" type="file" id="consultationImage" name="consultationImage" accept="image/*" required>
                                            </div>
                                        </div>
                                        <div>
                                            <textarea class="uk-con-textarea" type="text" id="consultationText" name="consultationText" placeholder="相談内容を入力" rows="6" required></textarea>
                                        </div>
                                        <div class="openmodalbutton">
                                            <button class="uk-button uk-button-primary" type="button" id="openModalButton">確認</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <!-- 依頼履歴一覧 -->
                <table class="uk-table uk-table-hover uk-table-divider table-width" id="history_table">
                    <thead id="history_thead">

                        <!-- JavaScriptよりデータ表示 -->
                         
                    </thead>
                    <tbody id="history_tbody">

                        <!-- JavaScriptよりデータ表示 -->

                    </tbody>
                </table>

                <!-- 詳細モーダル -->
                <div id="detailModal" class="uk-modal" uk-modal>
                    <div id="modal-content" class="uk-modal-dialog uk-modal-body uk-width-1-2 modal-font-size">
                        <!-- 詳細情報 -->
                        <div id="modalContent"></div>
                        <div class="uk-text-right">
                            <button class="uk-button uk-button-default uk-modal-close" type="button">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- 依頼未登録の場合 -->
            <div id="noDataModal" uk-modal>
                <div class="uk-modal-dialog uk-modal-body no_data">
                    <h2 class="uk-modal-title">通知</h2>
                    <p>依頼は登録されていません。新規依頼を登録してください。</p>
                    <div class="uk-text-right">
                        <button class="uk-button uk-button-default uk-modal-close" type="button">閉じる</button>
                    </div>
                </div>
            </div>

            <!-- 内容確認モーダル -->
            <div id="confirmationModal" class="modal-size" uk-modal>
                <div class="uk-modal-dialog uk-modal-header padding-modal">
                    <span class="uk-modal-title">確認</span><br>
                    <span>以下の内容を送信します。よろしいですか？</span>
                </div>
                <div class="uk-modal-dialog uk-modal-body">
                    <span class="consultationvalue-text">相談内容</span><span id="modalEmerg"></span><br>
                    <textarea id="modalConsultationText" readonly></textarea>
                    <img class="text-center" id="modalImagePreview" src="#" alt="画像プレビュー">
                </div>
                <div class="uk-modal-dialog uk-modal-footer uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">変更</button>
                    <button class="uk-button uk-button-primary" id="submitFormButton">送信</button>
                </div>
            </div>

            <!-- ロード画面 -->
            <div id="loadingOverlay">
                <div class="spinner"></div>
            </div>

            <!-- 送信完了モーダル -->
            <div id="completionModal" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <h2 class="uk-modal-title"></h2>
                    <span class="message"></span>
                    <div class="uk-text-right">
                        <button class="uk-button uk-button-default" type="button" id="goHomeButton">ホームへ戻る</button>
                        <button class="uk-button uk-button-primary" type="button" id="goHistoryButton">再読み込み</button>
                    </div>
                </div>
            </div>
            
        </main>

        <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.3/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.16.3/dist/js/uikit-icons.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.6.16/js/uikit.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.6.16/js/uikit-icons.min.js"></script>
        <script src="./contact_js/shared_scripts.js"></script>
        <script src="./contact_js/admin_scripts.js"></script>
        <script src="./contact_js/client_scripts.js"></script>

    </body>

</html>