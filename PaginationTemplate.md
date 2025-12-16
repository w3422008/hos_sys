# ページネーション導入テンプレート

## 1. HTML（View ファイル）

```html
<!-- ★ ページネーション（上） -->
<div id="pagination-container-top" style="text-align: center; margin-bottom: 30px;"></div>

<!-- コンテンツ表示エリア -->
<div id="content-container"></div>

<!-- ★ ページネーション（下） -->
<div id="pagination-container-bottom" style="text-align: center; margin-top: 40px;"></div>

<!-- ★ 共通ページネーション JS を読み込み -->
<script src="../js/pagination.js"></script>

```

---

## 2. PHP（Control ファイル - オブジェクト指向形式）

```php
<?php
require_once('../config.php');
require_once('../functions.php');

class PageNameController {
    private $dbh;
    private $per_page = 12;

    public function __construct() {
        $this->dbh = get_db_connect();
    }

    /**
     * AJAX検索処理
     */
    public function handleAjax() {
        if(!isset($_GET['ajax']) || $_GET['ajax'] !== '1') {
            return;
        }

        header('Content-Type: application/json; charset=UTF-8');
        
        try {
            $keyword = $_GET['keyword'] ?? '';
            $page = (int)($_GET['page'] ?? 1);

            if($page < 1) {
                $page = 1;
            }

            // ★ データ取得
            $allResults = $this->fetchData($keyword);
            $total = count($allResults);

            // ★ ページネーション処理
            $offset = ($page - 1) * $this->per_page;
            $results = array_slice($allResults, $offset, $this->per_page);
            $totalPages = ceil($total / $this->per_page);

            echo json_encode([
                'success' => true,
                'data' => $results,
                'total' => $total,
                'current_page' => $page,
                'total_pages' => $totalPages
            ], JSON_UNESCAPED_UNICODE);
            exit;

        } catch(Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    /**
     * DBからデータを取得
     * 
     * @param string $keyword 検索キーワード
     * @return array データ配列
     */
    private function fetchData($keyword = '') {
        $keyword = trim($keyword);
        $likeKeyword = "%{$keyword}%";

        // ★ ここをカスタマイズ
        $sql = "SELECT * FROM table_name 
                WHERE column1 LIKE :keyword 
                   OR column2 LIKE :keyword
                ORDER BY id ASC";

        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':keyword', $likeKeyword, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * ビューを表示
     */
    public function render() {
        include_once('page_name_view.php');
    }
}

// ★ コントローラーを実行
$controller = new PageNameController();
$controller->handleAjax();
$controller->render();
?>
```

---

## 3. JavaScript

```javascript
// ★ グローバル変数
let currentPage = 1;
let currentKeyword = '';
let totalPages = 1;

// ★ ページロード時に初期データを表示
document.addEventListener('DOMContentLoaded', () => {
    loadData('', 1);
    attachSearchListener();
});

// ★ データを取得
function loadData(keyword, page = 1) {
    currentKeyword = keyword;
    currentPage = page;
    
    const url = `page_name_control.php?ajax=1&keyword=${encodeURIComponent(keyword)}&page=${page}`;
    
    fetch(url)
        .then(response => response.json())
        .then(result => {
            if(!result.success) return;
            
            renderContent(result.data);
            renderPaginationCommon(
                result.current_page,
                result.total_pages,
                'pagination-container-top',
                'pagination-container-bottom',
                'goToPage'
            );
        })
        .catch(error => console.error('Error:', error));
}

// ★ コンテンツをレンダリング（カスタマイズ対象）
function renderContent(data) {
    const container = document.getElementById('content-container');
    container.innerHTML = '';

    if(!data || data.length === 0) {
        container.innerHTML = '<div style="text-align: center; color: #999; padding: 40px;">検索結果がありません</div>';
        document.getElementById('pagination-container-top').innerHTML = '';
        document.getElementById('pagination-container-bottom').innerHTML = '';
        return;
    }

    data.forEach(item => {
        const div = document.createElement('div');
        div.innerHTML = `<p>${item.column1}</p>`; // ★ ここをカスタマイズ
        container.appendChild(div);
    });
}

// ★ ページ移動
function goToPage(page) {
    loadData(currentKeyword, page);
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// ★ 検索入力のイベントリスナー
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

## カスタマイズ箇所

| 項目 | ファイル | 修正内容 |
|-----|--------|--------|
| テーブル名 | PHP | `table_name` を修正 |
| 検索カラム | PHP | `column1`, `column2` を修正 |
| 1ページの件数 | PHP | `$this->per_page = 12` を修正 |
| 表示形式 | JS | `renderContent()` をカスタマイズ |
| ファイル名 | JS+PHP | `page_name` を修正 |
| クラス名 | PHP | `PageNameController` を修正 |

---

## 導入手順

1. PHP: クラス名、テーブル名、カラム名を修正
2. JS: `renderContent()` 関数をカスタマイズ
3. HTML: `<div id="pagination-container-top/bottom"></div>` を配置
4. HTML: 検索入力欄（ID: `search-input`）を配置（不要な場合は削除）
5. HTML: `<script src="../js/pagination.js"></script>` と `<script src="page_name.js"></script>` を読み込み

---

## PHP のクラス構造

```
PageNameController
├── __construct()           初期化
├── handleAjax()           AJAX処理のエントリーポイント
├── fetchData($keyword)    データ取得（プライベートメソッド）
└── render()               ビュー表示
```
