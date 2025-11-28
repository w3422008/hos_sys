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
    <link rel="stylesheet" href="../css/uk-custom.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/buttons.css" />
    <link rel="stylesheet" href="../css/marker.css"/>
    <link rel="stylesheet" href="../css/tables.css" />
    <link rel="stylesheet" href="../css/all.min.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <style>
        .card-button {
            height: auto;
            padding: 30px 20px;
            border-radius: 15px;
            border: 2px solid #ddd;
            transition: all 0.3s ease;
            text-align: left;
            background: white;
            cursor: pointer;
        }

        .card-button:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: #999;
        }

        .card-button h4 {
            margin: 0 0 15px 0;
            font-weight: bold;
            font-size: 1.2rem;
            word-break: break-word;
        }

        .card-button p {
            margin: 5px 0;
            color: #666;
            font-size: 0.95rem;
        }

        .no-results {
            text-align: center;
            color: #999;
            padding: 40px 20px;
            font-size: 1.1rem;
        }
    </style>
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
        <h1>医療機関情報の引き継ぎ</h1>

        <!-- 検索入力欄 -->
        <div class="uk-margin-large-bottom">
            <input type="text"
                   id="search-input"
                   class="uk-input uk-form-large"
                   placeholder="医療機関コード/医療機関名/住所を検索"
                   style="border-radius: 20px; padding: 15px 20px; font-size: 1.1rem;">
        </div>

        <!-- カード型グリッド -->
        <div class="uk-grid-match uk-child-width-1-3@m uk-child-width-1-2@s uk-grid"
             uk-grid
             id="cards-container">
            <!-- JavaScriptで動的生成 -->
        </div>
    </main>
    <script src="code_editor.js"></script>
</body>
</html>