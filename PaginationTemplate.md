# ページネーション実装テンプレート

このテンプレートを使用することで、検索結果のページネーション機能を簡単に実装できます。

---

## 📋 全体構成

```
View（HTML）      → Control（PHP） → AJAX → JS → HTML
  検索入力           データ取得      JSON  表示更新  ページネーション
```

---

## 1️⃣ PHP（Control ファイル）

functions.php の汎用 `paginate()` 関数を使用して、シンプルに実装

### ✅ 最小限のコード例

```php
<?php
if(isset($_SESSION)==null){
    session_start();
}
require_once('../config.php');
require_once('../functions.php');

if(empty($_SESSION['member'])){
    header('Location:'.SITE_URL.'index.php');
    exit();
}

$dbh = get_db_connect();

/**
 * =====================================================
 * AJAX検索処理
 * =====================================================
 * functions.php の paginate() 関数を使用
 */
if(isset($_GET['ajax']) && $_GET['ajax'] === '1') {
    header('Content-Type: application/json; charset=UTF-8');
    
    try {
        // ★ パラメータ取得
        $keyword = $_GET['keyword'] ?? '';
        $keyword = trim($keyword);
        $page = (int)($_GET['page'] ?? 1);
        $per_page = 12;  // 1ページあたりの件数
        
        // ★ DB から全データ取得
        if(empty($keyword)) {
            $sql = "SELECT col1, col2, col3 FROM your_table ORDER BY id ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
        } else {
            $like_keyword = "%{$keyword}%";
            $sql = "SELECT col1, col2, col3 FROM your_table 
                    WHERE col1 LIKE :keyword 
                       OR col2 LIKE :keyword
                    ORDER BY id ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':keyword', $like_keyword, PDO::PARAM_STR);
            $stmt->execute();
        }
        
        $all_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // ★ paginate() 関数でページネーション処理（重要！これ1行で完結）
        $pagination_result = paginate($all_results, $page, $per_page);
        
        // ★ 数値型キャスト（必要に応じて）
        foreach($pagination_result['data'] as &$row) {
            $row['id'] = (int)$row['id'];
        }
        unset($row);
        
        // ★ JSON レスポンス
        echo json_encode([
            'success' => true,
            'data' => $pagination_result['data'],
            'current_page' => $pagination_result['current_page'],
            'total_pages' => $pagination_result['total_pages'],
            'total' => $pagination_result['total']
        ], JSON_UNESCAPED_UNICODE);
        exit;
        
    } catch(Exception $e) {
        header('Content-Type: application/json; charset=UTF-8');
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}

// ★ 初期表示
include_once('page_name_view.php');
?>
```

### 📝 修正箇所

| 項目 | 修正内容 |
|-----|--------|
| `your_table` | 実際のテーブル名に置換 |
| `col1, col2, col3` | 実際のカラム名に置換 |
| `per_page` | 1ページの件数を修正（デフォルト12） |
| `ORDER BY id ASC` | ソート順を必要に応じて修正 |

---

## 2️⃣ HTML（View ファイル）

```html
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>検索ページ</title>
</head>
<body>
    
    <!-- ★ 検索入力フォーム -->
    <div style="margin-bottom: 30px;">
        <input type="text" id="search-input" placeholder="キーワードで検索..." 
               style="width: 300px; padding: 10px;">
    </div>

    <!-- ★ ページネーション（上） -->
    <div id="pagination-top" style="text-align: center; margin-bottom: 20px;"></div>

    <!-- ★ 検索結果表示エリア -->
    <div id="content-container">
        <!-- JavaScript で動的に挿入される -->
    </div>

    <!-- ★ ページネーション（下） -->
    <div id="pagination-bottom" style="text-align: center; margin-top: 40px;"></div>

    <!-- ★ 共通ページネーション JS（functions.js 読み込みの後） -->
    <script src="../js/pagination.js"></script>
    
    <!-- ★ このページ専用 JS -->
    <script src="page_name.js"></script>

</body>
</html>
```

---

## 3️⃣ JavaScript（ページネーション共通処理）

**ファイル**: `js/pagination.js`（汎用、再利用可能）

```javascript
/**
 * =====================================================
 * ページネーション共通処理（汎用ライブラリ）
 * =====================================================
 * 
 * 複数のページで再利用可能な、ページネーション表示機能
 * renderPaginationCommon() を呼び出すだけで使用可
 */

/**
 * ページネーション UI を両コンテナに表示
 * 
 * @param {number} currentPage - 現在のページ番号
 * @param {number} totalPages - 総ページ数
 * @param {string} topContainerId - 上部ページネーション表示 div の ID
 * @param {string} bottomContainerId - 下部ページネーション表示 div の ID
 * @param {string} onPageClickFunction - ページクリック時の関数名（文字列）
 */
function renderPaginationCommon(currentPage, totalPages, topContainerId, bottomContainerId, onPageClickFunction) {
    
    const html = generatePaginationHTML(currentPage, totalPages, onPageClickFunction);
    
    const topContainer = document.getElementById(topContainerId);
    const bottomContainer = document.getElementById(bottomContainerId);
    
    if(topContainer) topContainer.innerHTML = html;
    if(bottomContainer) bottomContainer.innerHTML = html;
}

/**
 * ページネーション HTML を生成
 * 
 * @param {number} currentPage - 現在のページ
 * @param {number} totalPages - 総ページ数
 * @param {string} functionName - ページクリック時の関数名
 * @returns {string} HTML
 */
function generatePaginationHTML(currentPage, totalPages, functionName) {
    if(totalPages <= 1) return '';
    
    let html = '<div style="padding: 10px 0;">';
    
    // ★ 「前へ」ボタン
    if(currentPage > 1) {
        html += `<button onclick="${functionName}(${currentPage - 1})" style="margin: 0 5px; padding: 8px 12px;">← 前へ</button>`;
    } else {
        html += `<button disabled style="margin: 0 5px; padding: 8px 12px; color: #ccc;">← 前へ</button>`;
    }
    
    // ★ ページ番号（最大10個表示）
    const maxPages = Math.min(totalPages, 10);
    const startPage = Math.max(1, currentPage - 4);
    const endPage = Math.min(totalPages, startPage + 9);
    
    for(let i = startPage; i <= endPage; i++) {
        if(i === currentPage) {
            html += `<button style="margin: 0 2px; padding: 8px 12px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">${i}</button>`;
        } else {
            html += `<button onclick="${functionName}(${i})" style="margin: 0 2px; padding: 8px 12px; background: #f0f0f0; border: 1px solid #ddd; border-radius: 4px; cursor: pointer;">${i}</button>`;
        }
    }
    
    // ★ 「次へ」ボタン
    if(currentPage < totalPages) {
        html += `<button onclick="${functionName}(${currentPage + 1})" style="margin: 0 5px; padding: 8px 12px;">次へ →</button>`;
    } else {
        html += `<button disabled style="margin: 0 5px; padding: 8px 12px; color: #ccc;">次へ →</button>`;
    }
    
    html += `<div style="font-size: 12px; color: #666; margin-top: 10px;">ページ ${currentPage} / ${totalPages}</div>`;
    html += '</div>';
    
    return html;
}
```

---

## 4️⃣ JavaScript（ページ専用処理）

**ファイル**: `page_name.js`（このページ専用）

```javascript
/**
 * =====================================================
 * ページ専用の処理
 * =====================================================
 * 
 * 検索実行、データ表示、ページ移動などの個別処理
 */

let currentPage = 1;
let currentKeyword = '';

// ★ ページロード時の初期処理
document.addEventListener('DOMContentLoaded', () => {
    loadData('', 1);
    attachSearchListener();
});

/**
 * データを取得してコンテンツを表示
 * 
 * @param {string} keyword - 検索キーワード
 * @param {number} page - ページ番号
 */
function loadData(keyword, page = 1) {
    currentKeyword = keyword;
    currentPage = page;
    
    // ★ AJAX で PHP に問い合わせ
    const url = `page_name_control.php?ajax=1&keyword=${encodeURIComponent(keyword)}&page=${page}`;
    
    fetch(url)
        .then(response => response.json())
        .then(result => {
            if(!result.success) {
                console.error('エラー:', result.error);
                return;
            }
            
            // ★ コンテンツを表示
            renderContent(result.data);
            
            // ★ ページネーション UI を表示（共通関数を使用）
            renderPaginationCommon(
                result.current_page,
                result.total_pages,
                'pagination-top',
                'pagination-bottom',
                'goToPage'
            );
        })
        .catch(error => console.error('Error:', error));
}

/**
 * 検索結果をコンテンツエリアに表示
 * ★ ここをカスタマイズして実装
 * 
 * @param {array} data - 表示するデータ配列
 */
function renderContent(data) {
    const container = document.getElementById('content-container');
    container.innerHTML = '';
    
    if(!data || data.length === 0) {
        container.innerHTML = '<div style="text-align: center; color: #999; padding: 40px;">検索結果がありません</div>';
        document.getElementById('pagination-top').innerHTML = '';
        document.getElementById('pagination-bottom').innerHTML = '';
        return;
    }
    
    // ★ ここから data の形式に合わせてカスタマイズ
    data.forEach(item => {
        const div = document.createElement('div');
        div.style.cssText = 'border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 4px;';
        div.innerHTML = `
            <h3>${item.col1}</h3>
            <p>説明: ${item.col2}</p>
            <small>ID: ${item.col3}</small>
        `;
        container.appendChild(div);
    });
}

/**
 * ページ移動
 * 
 * @param {number} page - 移動先のページ番号
 */
function goToPage(page) {
    loadData(currentKeyword, page);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

/**
 * 検索入力フィールドのイベントリスナー設定
 */
function attachSearchListener() {
    const searchInput = document.getElementById('search-input');
    if(searchInput) {
        searchInput.addEventListener('input', (e) => {
            loadData(e.target.value, 1);
        });
    }
}
```

---

## 🎯 導入手順（3ステップ）

### Step 1: PHP ファイルを修正

1. `your_table` をテーブル名に置換
2. `col1, col2, col3` を実際のカラム名に置換
3. SQL の WHERE 句を検索対象に合わせて修正

### Step 2: HTML を設置

1. 検索入力フィールドの ID を `search-input` に
2. コンテンツ表示エリアの ID を `content-container` に
3. ページネーション表示エリアの ID を `pagination-top`, `pagination-bottom` に

### Step 3: JavaScript をカスタマイズ

1. `renderContent()` 関数で表示形式をカスタマイズ
2. AJAX の URL が正しいか確認
3. ページネーション関数名が正しいか確認

---

## 📊 ファイル一覧

| ファイル | 説明 | 再利用 |
|--------|------|------|
| `page_name_control.php` | DB 問い合わせ | ページごと |
| `page_name_view.php` | HTML 構造 | ページごと |
| `page_name.js` | ページ個別処理 | ページごと |
| `js/pagination.js` | ページネーション共通処理 | ✅ 再利用 |
| `functions.php` - `paginate()` | ページネーション計算 | ✅ 再利用 |

---

## 🔄 functions.php の `paginate()` 関数

**ファイル**: `functions.php`

```php
/**
 * ページネーション処理の汎用関数
 * 配列データをページごとに分割し、ページネーション情報を返す
 * 
 * @param array $all_results 全データの配列
 * @param int $current_page 現在のページ番号（デフォルト：1）
 * @param int $per_page 1ページあたりの件数（デフォルト：12）
 * @return array ページネーション結果
 */
function paginate(array $all_results, int $current_page = 1, int $per_page = 12) {
    if ($current_page < 1) {
        $current_page = 1;
    }
    
    $total = count($all_results);
    $total_pages = ceil($total / $per_page);
    
    if ($current_page > $total_pages && $total_pages > 0) {
        $current_page = $total_pages;
    }
    
    $offset = ($current_page - 1) * $per_page;
    $paged_data = array_slice($all_results, $offset, $per_page);
    
    return [
        'data' => $paged_data,
        'count' => count($paged_data),
        'total' => $total,
        'current_page' => $current_page,
        'total_pages' => $total_pages
    ];
}
```

---

## 💡 実装例

### 実装例 1: 医療機関検索（code_editor.php ）

```php
// DB から全医療機関を取得
$all_results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// paginate() で処理
$result = paginate($all_results, $page, 12);

// JSON で返却
echo json_encode($result, JSON_UNESCAPED_UNICODE);
```

### 実装例 2: ユーザー検索

```php
// カスタマイズ例
$result = paginate($all_results, $page, 20);  // 1ページ20件

// ページ情報を表示
echo "ページ {$result['current_page']} / {$result['total_pages']}";
```

---

## ✨ このテンプレートの特徴

✅ **DRY 原則**: ページネーション処理は `functions.php` で一元管理  
✅ **再利用性**: JS とページネーション関数は複数ページで使用可  
✅ **シンプル**: 1 行の `paginate()` 呼び出しで完結  
✅ **保守性**: 各ファイルの責務が明確  
✅ **柔軟性**: カスタマイズ箇所が明示的

---

## 🐛 トラブルシューティング

| 問題 | 原因 | 解決策 |
|-----|------|------|
| ページネーション表示されない | HTML の ID が違う | `pagination-top`, `pagination-bottom` を確認 |
| データが表示されない | `renderContent()` の形式が違う | コンソールで `data` の構造を確認 |
| 検索が反応しない | `search-input` の ID がない | HTML に検索入力フィールドを追加 |
| AJAX エラー | URL や PHP ファイル名が違う | ネットワークタブで URL を確認 |

