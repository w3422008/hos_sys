# insert_new フォルダ - セットアップガイド

## 概要
このガイドは、最適化された `insert_new` フォルダを既存のシステムに統合するための手順を説明しています。

---

## 📋 セットアップ手順

### ステップ 1: 既存ビューファイルのコピー

`insert` フォルダから以下のファイル/フォルダをコピーします：

```
insert/
├── check_view.php          ⟹ insert_new/ にコピー
├── check_view/             ⟹ insert_new/ に配置
│   ├── check_basic_view.php
│   ├── check_contact_view.php
│   ├── check_department_view.php
│   └── ... (その他のビューファイル)
└── inserted_view.php       ⟹ insert_new/ にコピー
```

**コマンドで実行（Windows PowerShell）:**
```powershell
# check_view.php をコピー
Copy-Item "c:\xampp\htdocs\software_dev\hos_sys\insert\check_view.php" `
         "c:\xampp\htdocs\software_dev\hos_sys\insert_new\check_view.php"

# check_view フォルダをコピー
Copy-Item "c:\xampp\htdocs\software_dev\hos_sys\insert\check_view" `
         "c:\xampp\htdocs\software_dev\hos_sys\insert_new\check_view" -Recurse

# inserted_view.php をコピー
Copy-Item "c:\xampp\htdocs\software_dev\hos_sys\insert\inserted_view.php" `
         "c:\xampp\htdocs\software_dev\hos_sys\insert_new\inserted_view.php"
```

### ステップ 2: フォーム内のアクション先を変更

既存のフォームから `insert_new` へのリンクを作成します。

**index.php または insert フォルダのヘッダーファイルで:**

```html
<!-- 変更前 -->
<form action="insert/check_control.php" method="POST">

<!-- 変更後 -->
<form action="insert_new/check_control.php" method="POST">
```

### ステップ 3: 動作確認

テスト医療機関で動作を確認してください：

1. 新規追加フォーム内のデータを入力
2. 確認画面が正しく表示されるか確認
3. DB に登録されるか確認
4. 登録後ログが正しく記録されるか確認

---

## 🔄 既存の insert フォルダとの関係

| 用途 | insert フォルダ | insert_new フォルダ |
|------|-----------------|------------------|
| **当面の運用** | そのまま使用可能 | 段階的に移行 |
| **並行運用** | 並列実行可能 | 並列実行可能 |
| **デバッグ** | 問題が出たら insert を確認 | 問題が出たら insert_new を確認 |
| **本運用移行** | 数週間後に廃止可能 | 最終的な標準に |

---

## 📊 フォルダ構造

セットアップ後の構成：

```
insert_new/
├── InsertProcessor.php      ★ メインのデータ処理クラス
├── check_control.php        ★ チェック処理（簡潔）
├── inserted_control.php     ★ DB登録処理
├── check_view.php           ✓ insert/ からコピー
├── check_view/              ✓ insert/ からコピー
│   ├── check_basic_view.php
│   ├── check_contact_view.php
│   ├── check_department_view.php
│   ├── check_director_view.php
│   ├── check_introduction_view.php
│   ├── check_Medical_view.php
│   ├── check_number_view.php
│   ├── check_relation_view.php
│   └── check_support_view.php
├── inserted_view.php        ✓ insert/ からコピー
├── README.md                ⓘ 説明書（このファイル）
└── SETUP.md                 ⓘ セットアップガイド
```

---

## 🚀 テスト項目チェックリスト

### 基本情報の登録テスト
- [ ] 医療機関コード入力チェック
  - [ ] 重複チェックが機能するか
  - [ ] 未入力でエラーが出るか
- [ ] 医療機関名の入力確認
- [ ] 郵便番号の入力確認
- [ ] 都道府県・地域の入力確認

### 診療時間の登録テスト
- [ ] 診療時間が ●, ★, × で正しく保存されるか
- [ ] 手術日のみ、通常診療のみの区別が機能するか

### 医療内容の登録テスト
- [ ] チェックボックスが正しく保存されるか
- [ ] 診療科の上位カテゴリ判定が機能するか

### 理事長・病院長情報の登録テスト
- [ ] 複数の理事長・病院長が登録できるか

### 親族情報・部門連絡先の登録テスト
- [ ] テーブル操作が機能するか
- [ ] 動的に行追加ができるか
- [ ] 動的に行削除ができるか

### 医療連携情報の登録テスト
- [ ] テキスト入力が保存されるか
- [ ] チェックボックスが機能するか

### DBログ確認テスト
- [ ] insert_log テーブルに記録されるか
- [ ] 管理者ユーザーが正しく記録されるか
- [ ] タイムスタンプが正しいか

---

## ⚙️ ビューファイルへの対応

既存の `check_view.php` と `inserted_view.php` は**そのまま利用可能**です。

### ビュー内の変数参照例

```php
<!-- 基本情報 -->
<?php echo html_escape($hos_name); ?>
<?php echo html_escape($hos_cd); ?>

<!-- 診療時間 -->
<?php echo $mon_am; ?>    <!-- ●, ★, × -->
<?php echo $mon_pm; ?>

<!-- 医療内容 -->
<?php echo $int_int; ?>   <!-- 1, 0, or blank -->
<?php echo $int_dig; ?>

<!-- 理事長・病院長 -->
<?php echo html_escape($chi_name); ?>
<?php echo html_escape($pre_name); ?>
```

**変数名の変更は不要です！** すべて自動的に `extract()` で展開されます。

---

## 🔧 トラブルシューティング

### Q: ビューで変数が見つからないエラーが出る

**原因:** `check_view.php` のコピーが完了していない、または `extract()` が実行されていない

**解決:**
1. `insert` フォルダから `check_view.php` が正しくコピーされているか確認
2. `check_control.php` で `extract($processor->getExtractArray());` が実行されているか確認

### Q: セッションデータが保存されない

**原因:** `session_start()` がされていない、またはリダイレクト前に出力がある

**解決:**
1. `check_control.php` の先頭に `session_start();` がある確認
2. `<?php` の前に空白や改行がないか確認

### Q: DBに登録されない

**原因:** バリデーションエラーが起きている

**解決:**
```php
// check_control.php で以下を追加
if (!empty($_SESSION['insert']['errors'])) {
    echo '登録エラー: ';
    print_r($_SESSION['insert']['errors']);
}
```

### Q: 医療機関コードの重複チェックが機能しない

**原因:** DBへの接続が失敗している

**解決:**
```php
// 接続確認
$dbh = get_db_connect();
if ($dbh === null) {
    die('DBコネクション失敗');
}
```

---

## 📈 パフォーマンス測定

セットアップ後、以下の指標を確認してください：

```php
// check_control.php の先頭に追加
$start_time = microtime(true);

// ... 処理 ...

$end_time = microtime(true);
error_log('処理時間: ' . ($end_time - $start_time) . '秒');
```

**期待値:**
- POSTデータ処理：< 50ms
- バリデーション：< 30ms
- セッション保存：< 10ms
- **合計：< 100ms**

---

## 📝 ログファイル確認

以下のログファイルを確認して、エラーがないか確認してください：

- Apache エラーログ：`c:\xampp\apache\logs\error.log`
- PHP エラーログ：`c:\xampp\php\logs\php_error.log` (設定により異なる)
- アプリケーション INSERT_LOG テーブル：DBの `insert_log` テーブル

---

## ✅ セットアップ完了チェックリスト

- [ ] `check_view.php` をコピーした
- [ ] `check_view/` フォルダをコピーした
- [ ] `inserted_view.php` をコピーした
- [ ] フォームのアクション先を変更した
- [ ] テスト登録を試した
- [ ] DBに正しく保存されたか確認した
- [ ] ログテーブルを確認した
- [ ] エラーログを確認した

**すべてのチェックが完了したら、本運用への移行準備完了です！**

---

## 🆘 サポート

問題が発生した場合：

1. `README.md` の「トラブルシューティング」を確認
2. `var_dump($_SESSION['insert']);` でセッションデータを確認
3. `var_dump($processor->getErrors());` でバリデーションエラーを確認
4. ブラウザの開発者ツール（F12）でネットワーク状況を確認

---

## 📚 参考資料

- [InsertProcessor.php](#) - クラス仕様書
- [README.md](#) - 全般説明書
- 既存の `insert/check_control.php` - 従来の実装方法

---

**セットアップ日時:** 2026年1月8日
**対応バージョン:** insert_new v1.0
