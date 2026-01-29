<!DOCTYPE html>
<html lang="ja">

<head>
    <link rel="shortcut icon" href="../favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー管理 | 医療機関情報システム</title>

    <!-- CSS/JS 略 -->
    <link rel="stylesheet" href="../css/uikit.min.css" />
    <script src="../js/uikit.min.js"></script>
    <script src="../js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/form_parts.css" />
    <link rel="stylesheet" href="../css/tables.css" />
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/user.css" />

</head>

<body>
    <?php include_once("../header.php"); ?>

    <header uk-sticky>
        <ul class="uk-breadcrumb breadcrumb">
            <li><a href="../menu/MENU_control.php">MENU</a></li>
            <li><span>ユーザー管理</span></li>
        </ul>
    </header>

    <footer uk-sticky="position: bottom">
        <?php include_once("../footer.php"); ?>
    </footer>

    <main>
        <div class="uk-container uk-width-expand">
            <!-- ヘッダー -->
            <div class="uk-flex uk-flex-middle uk-flex-between uk-margin-top uk-margin-bottom">
                <h2>ユーザー管理</h2>
                <div>
                    <a href="registration.php" class="bubble_none">
                        <p><i class="fas fa-user-plus fa-lg"></i><b class="uk-visible@s">ユーザ新規追加</b></p>
                    </a>
                </div>
            </div>

            <!-- 検索・フィルター -->
            <div class="filter_items uk-flex uk-flex-between">
                <!-- リアルタイム検索入力 -->
                <div>
                    <span>ユーザー検索</span>
                    <input type="text" id="search-keyword" class="uk-input search-input" placeholder="ユーザーID/名前を入力"
                        value="<?php echo html_escape($search_keyword); ?>">
                </div>

                <!-- ステータスフィルター -->
                <div>
                    <select id="status-filter" class="filter_select">
                        <option value="ALL" <?php if ($filter_status === 'ALL')
                            echo 'selected'; ?>>すべてのユーザー</option>
                        <option value="Active" <?php if ($filter_status === 'Active')
                            echo 'selected'; ?>>利用中</option>
                        <option value="InActive" <?php if ($filter_status === 'InActive')
                            echo 'selected'; ?>>停止中</option>
                    </select>
                </div>
            </div>

            <!-- 結果統計 -->
            <div class="filter_items uk-text-right">
                <span id="result-count">
                    <?php echo "検索結果: {$total}件"; ?>
                </span>
                <span style="margin-left: 20px;">
                    利用中: <?php echo $active_user; ?>件 /
                    停止中: <?php echo $hide_user; ?>件 /
                    全体: <?php echo $total_user; ?>件
                </span>
            </div>

            <?php if ($total > 0): ?>
                <!-- 表示件数選択 -->
                <div class="per-page-controls">
                    <label for="per-page-select">1ページあたりの表示件数：</label>
                    <select id="per-page-select" class="filter_select" style="width: auto;">
                        <option value="5">5件</option>
                        <option value="10">10件</option>
                        <option value="15">15件</option>
                        <option value="20">20件</option>
                        <option value="50">50件</option>
                        <option value="all">全件</option>
                    </select>
                </div>

                <!-- ページネーション（上） -->
                <div id="pagination-top"></div>

                <!-- テーブル -->
                <table class="uk-table uk-table-hover uk-table-responsive tbl-line">
                    <thead>
                        <tr>
                            <th class="uk-table-shrink"></th>
                            <th class="uk-table-shrink"></th>
                            <th class="uk-table-shrink"></th>
                            <th class="uk-table-expand">ID／氏名</th>
                            <th class="uk-width-medium">施設／所属</th>
                            <th class="uk-width-medium">履歴</th>
                            <th class="uk-table-shrink"></th>
                        </tr>
                    </thead>
                    <tbody id="user-table-body">
                        <!-- JavaScriptで動的生成 -->
                    </tbody>
                </table>

                <!-- ページネーション（下） -->
                <div id="pagination-bottom"></div>

            <?php else: ?>
                <div class="uk-margin-top uk-container uk-container-center">
                    <p class="uk-text-danger">
                        <span uk-icon="warning"></span>
                        <b>検索結果なし</b>：条件に合致するユーザーがありません
                    </p>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <script src="../js/pagination/pagination.js"></script>
    <script>
        // ★ PHP 変数をJavaScriptへ渡す
        // 初期検索キーワードとステータスフィルター
        const initialSearchKeyword = '<?php echo html_escape($search_keyword); ?>';
        const initialStatusFilter = '<?php echo $filter_status; ?>';
        // 部署データ
        const departments = <?php echo json_encode($bel, JSON_UNESCAPED_UNICODE); ?>;
    </script>
    <script src="./user_MT.js"></script>

</body>

</html>