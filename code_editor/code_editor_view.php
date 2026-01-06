<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>医療機関情報の引き継ぎ</title>
    <link rel="shortcut icon" href="../favicon.ico">

    <!-- UIkit3 -->
    <link rel="stylesheet" href="../css/uikit.min.css" />
    <script src="../js/uikit.min.js"></script>
    <script src="../js/uikit-icons.min.js"></script>
    <!-- <link rel="stylesheet" href="../css/uk-custom.css"> -->

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/buttons.css" />
    <link rel="stylesheet" href="../css/marker.css"/>
    <link rel="stylesheet" href="../css/tables.css" />
    <link rel="stylesheet" href="../css/all.min.css" />

    <link rel="stylesheet" href="code_editor.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

</head>

<body>
    <!-- ヘッダー -->
    <header uk-sticky>
        <?php include_once("../header.php"); ?>
        <!-- パンくず -->
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><a href="../hos_management/manage_control.php">医療機関 管理</a></li>
            <li><span>医療機関情報の引き継ぎ</span></li>
        </ul>
    </header>

    <!-- メインコンテンツ -->
    <main class="uk-container">
        <h1 class="main-title">医療機関情報の引き継ぎ</h1>

        <!-- 検索入力欄 -->
        <div class="uk-margin-large-bottom">
            <input type="text"
                   id="search-input"
                   class="uk-input uk-form-large"
                   placeholder="医療機関コード/医療機関名/住所を入力してください"
                   style="border-radius: 20px; padding: 15px 20px; font-size: 1.1rem;">
        </div>

        <!-- ★ ページネーション（上） -->
        <div id="pagination-container-top" style="text-align: center; margin-bottom: 30px;">
            <!-- JavaScriptで動的生成 -->
        </div>

        <!-- カード型グリッド -->
        <div class="uk-grid-match uk-child-width-1-3@m uk-child-width-1-2@s uk-grid"
             uk-grid
             id="cards-container">
            <!-- JavaScriptで動的生成 -->
        </div>

        <!-- ★ ページネーション（下） -->
        <div id="pagination-container-bottom" style="text-align: center; margin-top: 40px;">
            <!-- JavaScriptで動的生成 -->
        </div>

    </main>

    <!-- ★ 医療機関情報モーダル -->
    <div id="hospital-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" uk-close></button>

            <div class="modal-content">
                <h2 style="margin-bottom: 25px;">この医療機関情報を引き継ぎますか？</h2>

                <div class="input-content">
                    <p class="hospitalcode-modal-label">※ 新たな医療機関コードを右側に入力してください。</p>

                    <div class="hospitalcode-modal-input">
                        <!-- 医療機関コード -->
                        <span class="hospitalcode-modal-value" id="modal-hos-cd"></span>
                        <span class="text-arrow">▶▶▶</span>
                        <input type="number"
                                id="modal-hos-cd-input"
                                placeholder="7/10桁で入力">
                    </div>
                </div>
                        
                <p class="modal-label">病院情報</p>

                <p><i class="far fa-hospital fa-2x modal-icon"></i><span class="modal-value" id="modal-hos-name"></span></p>
                <p><span class="modal-value" id="modal-hos-div"></span>　<span class="">病床数：</span><span class="modal-value" id="modal-hos-bed"></span></p>
                <p><span class="modal-value" id="modal-hos-address"></span></p>

                <!-- ボタン -->
                <div class="modal-buttons">
                    <button id="modal-cancel-btn"
                            class="uk-button uk-button-default">
                        戻る
                    </button>
                    <button id="modal-confirm-btn"
                            class="uk-button uk-button-primary">
                        他の情報を変更する
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/pagination/pagination.js"></script>
    <script src="code_editor.js"></script>
</body>
</html>