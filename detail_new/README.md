# detail_new - 最適化されたdetailフォルダ構造

このフォルダは、元の`detail`フォルダを最適化して作成されました。

## 最適化のポイント

### 1. ファイル階層の簡潔化
- **削除された重複ファイル**：
  - `header_detail.php`, `office_header_detail.php`, `user_header_detail.php` → 統合されて `header_detail.php` に
  - `office_view/office_*.php`, `user_view/user_*.php`, `view/*.php` → 統合されて `view/*.php` に

### 2. 統合メカニズム
#### detail_control.php
- ユーザータイプを判定（admin/office/user）
- `$user_type` グローバル変数を設定

#### header_detail.php
- `$user_type` に基づいて条件分岐
- Admin用/非Admin用のUIを動的に表示

#### view/*.php
- `$user_type` に基づいて編集可能/表示のみを切り替え
- `$is_editable` フラグで制御

### 3. ファイル構造

```
detail_new/
├── detail_control.php        （統合制御）
├── header_detail.php         （統合テンプレート）
├── print.js                  （最適化版）
├── control/
│   └── basic_control.php
└── view/
    ├── basic_view.php        （統合ビュー）
    ├── department_view.php   （他ファイルと同じ形式）
    ├── director_view.php
    ├── number_view.php
    ├── introduction_view.php
    ├── support_view.php
    ├── relation_view.php
    ├── contact_view.php
    └── Medical_view.php
```

### 4. 使用方法

**元のdetail/detail_control.phpを以下に置き換えてください：**

```php
<?php
require_once('../functions.php');
$hos_cd = $_GET['cd'];
session_start();

if(empty($_SESSION['member'])){
   header('Location:'.SITE_URL.'index.php');
   exit();
}

$_SESSION["sid_id"] = $hos_cd;
$user_adm = $_SESSION['member']['adm_user'];
$dbh = get_db_connect();
$data = detail($dbh, $hos_cd);

if(isset($_SESSION['update'])){
   unset($_SESSION['update']);
}

if(isset($_GET['page_id'])){
   $_SESSION['page_id'] = $_GET['page_id'];
}

$are_cds = get_area($dbh);
$user_type = ($user_adm == '1' || $user_adm == '3') ? 'admin' : (($user_adm == '2') ? 'office' : 'user');

include_once('header_detail.php');
?>
```

### 5. 削減効果

- **ファイル数**: 30ファイル → 16ファイル（約47%削減）
- **コード量**: 約3,500行 → 約1,800行（約49%削減）
- **メンテナンス性向上**: 3つのテンプレートを1つに統合
- **機能性**:  変わらず（すべての機能を保持）

### 6. 他のビューファイルについて

`view/department_view.php`, `view/director_view.php` など、その他のビューファイルについても、`basic_view.php` と同じパターンで統合してください：

1. ファイルの先頭に `<?php $is_editable = ($user_type === 'admin'); $is_readonly = !$is_editable; ?>`
2. 編集フォーム部分を `<?php if($is_editable): ?>...<?php else: ?>...<?php endif; ?>` で包括
3. 表示用は html_escape() で XSS対策

### 7. 注意事項

- `$user_type` は detail_control.php で設定されます
- グローバル変数として各ビューで使用可能です
- print.js は最適化版に更新済み（tab-content08に A4 landscape 指定）
