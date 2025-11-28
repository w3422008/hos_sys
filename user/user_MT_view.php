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
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/form_parts.css" />
    <link rel="stylesheet" href="../css/tables.css" />
    <link rel="stylesheet" href="../css/all.min.css" />

    <style>
        .hide-tbl-bgd {
            background: #f8f8f8;
        }
        .search-loading {
            opacity: 0.6;
        }
        .per-page-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        main{
            margin: 0 7em;
        }
        @media (max-width: 1500px) {
            main {
                margin: 0 ;
            }
        }
    </style>
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
            <div class="uk-card-header uk-flex uk-flex-middle uk-flex-between">
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
                    <input type="text" 
                           id="search-keyword" 
                           class="uk-input search-input" 
                           placeholder="ユーザーID/名前を入力"
                           value="<?php echo html_escape($search_keyword); ?>">
                </div>

                <!-- ステータスフィルター -->
                <div>
                    <select id="status-filter" class="filter_select">
                        <option value="ALL" <?php if($filter_status === 'ALL') echo 'selected'; ?>>すべてのユーザー</option>
                        <option value="Active" <?php if($filter_status === 'Active') echo 'selected'; ?>>利用中</option>
                        <option value="InActive" <?php if($filter_status === 'InActive') echo 'selected'; ?>>停止中</option>
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

            <?php if($total > 0): ?>
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

    <script>
        // ★ グローバル変数
        let currentPage = 1;
        let searchKeyword = '<?php echo html_escape($search_keyword); ?>';
        let statusFilter = '<?php echo $filter_status; ?>';
        let perPage = 5; // ★ デフォルトを5に変更

        // ★ 初期化（ページロード時）
        document.addEventListener('DOMContentLoaded', () => {
            // 表示件数セレクトボックスのイベントリスナーを設定
            const perPageSelect = document.getElementById('per-page-select');
            if(perPageSelect) {
                perPageSelect.addEventListener('change', (e) => {
                    const value = e.target.value;
                    perPage = value === 'all' ? 99999 : parseInt(value); // 全件は大きな数値
                    currentPage = 1; // ページをリセット
                    renderTable();
                });
            }

            renderTable();
            attachEventListeners();
        });

        /**
         * テーブルをレンダリング
         */
        function renderTable() {
            // ★ per_page を文字列から数値に確認
            const perPageNum = isNaN(perPage) ? 5 : parseInt(perPage);

            // ★ URLパラメータを確認
            const url = `user_MT_control.php?ajax=1&keyword=${encodeURIComponent(searchKeyword)}&status=${encodeURIComponent(statusFilter)}&page=${currentPage}&per_page=${perPageNum}`;
            
            fetch(url)
                .then(response => response.json())
                .then(result => {
                    
                    if(!result.success) {
                        console.error('API returned false');
                        return;
                    }

                    const tbody = document.getElementById('user-table-body');
                    tbody.innerHTML = '';

                    // ★ データが配列であることを確認
                    if(!Array.isArray(result.data)) {
                        console.error('result.data is not an array:', result.data);
                        tbody.innerHTML = '<tr><td colspan="7" class="uk-text-center">データ形式エラー</td></tr>';
                        return;
                    }


                    if(result.data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="7" class="uk-text-center">データがありません</td></tr>';
                        document.getElementById('pagination-top').innerHTML = '';
                        document.getElementById('pagination-bottom').innerHTML = '';
                        return;
                    }

                    // 行を生成
                    result.data.forEach((user, index) => {
                        try {
                            const row = createUserRow(user);
                            tbody.appendChild(row);
                        } catch(e) {
                            console.error(`Error creating row ${index}:`, e);
                        }
                    });

                    // ページネーションを表示
                    renderPagination(result.total_pages, result.current_page);

                    // 結果件数を更新
                    document.getElementById('result-count').textContent = `検索結果: ${result.total}件`;
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    const tbody = document.getElementById('user-table-body');
                    tbody.innerHTML = `<tr><td colspan="7" class="uk-text-center uk-text-danger">エラー: ${error.message}</td></tr>`;
                });
        }

        /**
         * ユーザー行を作成
         */
        function createUserRow(user) {
            const row = document.createElement('tr');
            
            // ステータスに応じたクラス
            if(user.onf === '1') {
                row.className = 'hide-tbl-bgd';
                row.setAttribute('uk-tooltip', 'title:停止中ユーザ; pos: top-left');
            } else {
                row.setAttribute('uk-tooltip', 'title:利用中ユーザ; pos: top-left');
            }

            // ステータスアイコン
            let statusIcon = '';
            if(user.onf === '1') {
                statusIcon = '<i class="fas fa-lock"></i>';
            }

            // 権限ラベル（ここは既存の関数を使用）
            const admLabel = getAdmLabelHtml(user.adm_user);

            // 施設・所属情報
            const facilityInfo = getFacilityInfo(user.ins, user.bel,departments);

            // 履歴情報
            let historyHtml = '';
            if(user.onf === '0') {
                historyHtml = `
                    <div>開始日：${user.start}</div>
                    <div>変更日：${user.up_date}</div>
                `;
            } else {
                historyHtml = `<div>利用停止日：${user.end}</div>`;
            }

            // アクションボタン
            let actionHtml = '';
            if(user.onf === '0') {
                actionHtml = `
                    <a class="uk-button"><i class="fas fa-ellipsis-h fa-lg"></i></a>
                    <div class="uk-width-small" uk-dropdown="mode: click">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="update.php?id=${user.user_id}"><i class="fas fa-user-edit fa-lg"></i> 変更</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="hide.php?id=${user.user_id}"><i class="fas fa-user-slash fa-lg"></i> 利用停止</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="clear.php?id=${user.user_id}"><i class="fas fa-key fa-lg"></i> パスワード初期化</a></li>
                        </ul>
                    </div>
                `;
            } else {
                actionHtml = `
                    <a class="uk-button"><i class="fas fa-ellipsis-h fa-lg"></i></a>
                    <div class="uk-width-small" uk-dropdown="mode: click">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="undoing.php?id=${user.user_id}"><i class="fas fa-lock-open fa-lg"></i> 停止解除</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="deleate.php?id=${user.user_id}"><i class="far fa-trash-alt fa-lg"></i> 削除</a></li>
                        </ul>
                    </div>
                `;
            }

            row.innerHTML = `
                <td>${statusIcon}</td>
                <td><i class="fas fa-user-circle fa-2x" style="color:#aaa;"></i></td>
                <td>${admLabel}</td>
                <td>
                    <div><label>ID：</label><u>${htmlEscape(user.user_id)}</u></div>
                    <div style="font-size:1.2em;">${htmlEscape(user.user_name)}</div>
                </td>
                <td class="uk-text-truncate">
                    <div>${facilityInfo.facility}</div>
                    <div>（${facilityInfo.department}）</div>
                </td>
                <td>${historyHtml}</td>
                <td>${actionHtml}</td>
            `;

            return row;
        }

        /**
         * ページネーション表示
         */
        function renderPagination(totalPages, currentPage) {

            if(totalPages <= 1) {
                document.getElementById('pagination-top').innerHTML = '';
                document.getElementById('pagination-bottom').innerHTML = '';
                return;
            }

            let paginationHtml = '<ul class="uk-pagination uk-flex-center">';

            // 前へ
            if(currentPage > 1) {
                paginationHtml += `<li><a onclick="goToPage(${currentPage - 1}); return false;">前へ</a></li>`;
            } else {
                paginationHtml += '<li class="uk-disabled"><span>前へ</span></li>';
            }

            // ページ番号（シンプル版：全ページ表示）
            for(let i = 1; i <= totalPages; i++) {
                if(i === currentPage) {
                    paginationHtml += `<li class="uk-active"><span>${i}</span></li>`;
                } else {
                    paginationHtml += `<li><a onclick="goToPage(${i}); return false;">${i}</a></li>`;
                }
            }

            // 次へ
            if(currentPage < totalPages) {
                paginationHtml += `<li><a onclick="goToPage(${currentPage + 1}); return false;">次へ</a></li>`;
            } else {
                paginationHtml += '<li class="uk-disabled"><span>次へ</span></li>';
            }

            paginationHtml += '</ul>';

            // ★ 両方の場所に表示
            const paginationTop = document.getElementById('pagination-top');
            const paginationBottom = document.getElementById('pagination-bottom');
            
            if(paginationTop) {
                paginationTop.innerHTML = paginationHtml;
            }
            if(paginationBottom) {
                paginationBottom.innerHTML = paginationHtml;
            }
        }

        /**
         * ページ移動
         */
        function goToPage(page) {
            currentPage = page;
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
            renderTable();
            
            return false;
        }

        /**
         * イベントリスナー設定
         */
        function attachEventListeners() {
            const searchInput = document.getElementById('search-keyword');
            const statusSelect = document.getElementById('status-filter');

            // リアルタイム検索（入力中）
            searchInput.addEventListener('input', (e) => {
                searchKeyword = e.target.value;
                currentPage = 1; // 検索時は1ページ目に戻す
                renderTable();
            });

            // ステータスフィルター変更時
            statusSelect.addEventListener('change', (e) => {
                statusFilter = e.target.value;
                currentPage = 1;
                renderTable();
            });
        }

        /**
         * HTML特殊文字をエスケープ
         */
        function htmlEscape(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        /**
         * 権限ラベル取得（PHP側の関数と同等）
         */
        function getAdmLabelHtml(admUser) {
            let label = '';
            if(admUser === '3') {
                label = '<span class="uk-label SysAdmin">システム管理者</span>';
            } else if(admUser === '1') {
                label = '<span class="uk-label uk-label-danger">管理者</span>';
            } else if(admUser === '2') {
                label = '<span class="uk-label uk-label-warning">一般（事務）</span>';
            } else {
                label = '<span class="uk-label">一般</span>';
            }
            return label;
        }

        /**
         * 施設・所属情報取得
         */
        function getFacilityInfo(ins, bel, departments) {

            const facilities = {
                '0': '附属病院',
                '1': '総合医療センター',
                '2': '高齢者医療センター'
            };
            return {
                facility: facilities[ins] || '不明',
                department: (departments[ins] && departments[ins][bel]) || '不明'
            };

        }

    </script>

    <script>
        const departments = <?php echo json_encode($bel, JSON_UNESCAPED_UNICODE); ?>;
    </script>

</body>
</html>