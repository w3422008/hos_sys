# リアルタイムバリデーション処理テンプレート - 使用マニュアル

## 目次
1. [概要](#概要)
2. [テンプレート構造](#テンプレート構造)
3. [新しいフィールドを追加する手順](#新しいフィールドを追加する手順)
4. [ルールの定義方法](#ルールの定義方法)
5. [具体的な使用例](#具体的な使用例)
6. [トラブルシューティング](#トラブルシューティング)

---

## 概要

このテンプレートは、**複数の入力フィールドに対して統一されたリアルタイムバリデーション処理を提供**します。

### 主な特徴
- ✅ **汎用的**: 新しいフィールド追加時、設定を追加するだけで自動的に機能
- ✅ **DRY原則**: 重複コードを最小化し、保守性向上
- ✅ **拡張性**: ルールの追加・変更が容易
- ✅ **一貫性**: すべてのフィールドで同じUIパターンを提供

### 動作の仕組み

```
入力フィールドがフォーカス
    ↓
フィールド設定を読み込み
    ↓
各ルールを適用してテスト実行
    ↓
オーバーレイに結果を表示（✓/✗）
    ↓
ユーザーが条件を確認しながら入力
```

---

## テンプレート構造

### 1. フィールド設定オブジェクト (`validationFieldsConfig`)

```javascript
const validationFieldsConfig = {
    フィールドキー: {
        inputId: "HTML入力要素のID",
        overlayId: "オーバーレイdivのID",
        rules: {
            ルールキー1: { label: "表示名", test: (val) => テスト関数 },
            ルールキー2: { label: "表示名", test: (val) => テスト関数 }
        },
        requirements: ["ルールキー1", "ルールキー2"]
    }
};
```

### 2. 核となる汎用関数

| 関数名 | 説明 | 引数 |
|--------|------|------|
| `validateField(fieldKey)` | 特定フィールドの検証結果を取得 | `fieldKey`: フィールドキー |
| `updateFieldDisplay(fieldKey)` | オーバーレイ表示を更新 | `fieldKey`: フィールドキー |
| `updateRequirementElement(element, isMet)` | li要素のクラスと表示を更新 | `element`: 要素, `isMet`: 検証結果 |
| `initializeValidationField(fieldKey)` | フィールドにイベントリスナーを設定 | `fieldKey`: フィールドキー |
| `positionOverlay(inputElement, overlayElement)` | オーバーレイの位置を計算して設定 | 入力要素とオーバーレイ要素 |

### 3. HTMLの構成

各フィールドに対応する以下の要素が必要です：

#### 入力フォーム
```html
<input type="text" id="フィールドキー対応のID" name="フィールド名">
```

#### オーバーレイ（バリデーション表示）
```html
<div id="フィールドキー_requirements" style="display: none;">
    <p>入力条件：</p>
    <ul>
        <li id="フィールドキー_req_ルールキー"><span>✓</span> ルール説明</li>
    </ul>
</div>
```

---

## 新しいフィールドを追加する手順

### ステップ 1: HTMLに入力要素を追加

```html
<input type="text" id="email" name="email" placeholder="メールアドレス">
```

### ステップ 2: HTMLにオーバーレイを追加

```html
<div id="email_requirements" style="display: none;">
    <p>入力条件：</p>
    <ul>
        <li id="email_req_required" data-requirement="email_required"><span>✓</span> 入力は必須です</li>
        <li id="email_req_format" data-requirement="email_format"><span>✓</span> メールアドレス形式</li>
    </ul>
</div>
```

### ステップ 3: JavaScriptに設定を追加

`validationFieldsConfig` に新しいフィールド設定を追加：

```javascript
email: {
    inputId: "email",
    overlayId: "email_requirements",
    rules: {
        required: { label: "必須項目", test: (val) => val.length > 0 },
        format: { label: "メールアドレス形式", test: (val) => /^[\w.+-]+@[\w-]+\.[\w.-]+$/.test(val) }
    },
    requirements: ["required", "format"]
}
```

### ステップ 4: 初期化処理（自動）

以下のコードが自動的にすべてのフィールドを処理：

```javascript
Object.keys(validationFieldsConfig).forEach(fieldKey => {
    initializeValidationField(fieldKey);
});
```

**これで完成！** 新しいフィールドは自動的にバリデーション機能が有効になります。

---

## ルールの定義方法

### ルール構造

```javascript
ルールキー: { 
    label: "ユーザー表示用の説明",
    test: (val) => テスト関数の戻り値 // true = OK, false = NG
}
```

### よく使うテスト関数のサンプル

#### 1. 必須チェック
```javascript
required: { 
    label: "入力は必須です", 
    test: (val) => val.length > 0 
}
```

#### 2. 文字数チェック
```javascript
minLength: { 
    label: "3文字以上", 
    test: (val) => val.length >= 3 
},
maxLength: { 
    label: "20文字以下", 
    test: (val) => val.length <= 20 
}
```

#### 3. 正規表現チェック

**メールアドレス**
```javascript
email: { 
    label: "メールアドレス形式", 
    test: (val) => /^[\w.+-]+@[\w-]+\.[\w.-]+$/.test(val) 
}
```

**電話番号（ハイフンなし）**
```javascript
phone: { 
    label: "電話番号（10-11桁）", 
    test: (val) => /^[0-9]{10,11}$/.test(val) 
}
```

**郵便番号**
```javascript
postal: { 
    label: "郵便番号（XXX-XXXX形式）", 
    test: (val) => /^[0-9]{3}-[0-9]{4}$/.test(val) 
}
```

**パスワード**
```javascript
password: { 
    label: "大文字・小文字・数字を含む8文字以上", 
    test: (val) => /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,}$/.test(val) 
}
```

#### 4. 複合条件（別フィールド参照）

**パスワード一致確認**
```javascript
match: { 
    label: "パスワード一致", 
    test: (val) => {
        const pw = document.getElementById("pw").value;
        return val === pw && val.length > 0;
    }
}
```

**年齢範囲チェック**
```javascript
ageValid: { 
    label: "18～99歳", 
    test: (val) => {
        const age = parseInt(val);
        return age >= 18 && age <= 99;
    }
}
```

---

## 具体的な使用例

### 例 1: 電話番号フィールド

**HTML**
```html
<input type="tel" id="phone" name="phone" placeholder="09012345678">

<div id="phone_requirements" style="display: none;">
    <p>入力条件：</p>
    <ul>
        <li id="phone_req_required" data-requirement="phone_required"><span>✓</span> 入力は必須です</li>
        <li id="phone_req_format" data-requirement="phone_format"><span>✓</span> 10〜11桁の数字</li>
    </ul>
</div>
```

**JavaScript設定**
```javascript
phone: {
    inputId: "phone",
    overlayId: "phone_requirements",
    rules: {
        required: { label: "必須項目", test: (val) => val.length > 0 },
        format: { label: "10〜11桁の数字", test: (val) => /^[0-9]{10,11}$/.test(val) }
    },
    requirements: ["required", "format"]
}
```

### 例 2: 住所フィールド（複数ルール）

**HTML**
```html
<input type="text" id="address" name="address" placeholder="都道府県市区町村">

<div id="address_requirements" style="display: none;">
    <p>入力条件：</p>
    <ul>
        <li id="address_req_required" data-requirement="address_required"><span>✓</span> 入力は必須です</li>
        <li id="address_req_minlength" data-requirement="address_minlength"><span>✓</span> 5文字以上</li>
        <li id="address_req_maxlength" data-requirement="address_maxlength"><span>✓</span> 50文字以下</li>
    </ul>
</div>
```

**JavaScript設定**
```javascript
address: {
    inputId: "address",
    overlayId: "address_requirements",
    rules: {
        required: { label: "必須項目", test: (val) => val.length > 0 },
        minlength: { label: "5文字以上", test: (val) => val.length >= 5 },
        maxlength: { label: "50文字以下", test: (val) => val.length <= 50 }
    },
    requirements: ["required", "minlength", "maxlength"]
}
```

### 例 3: フォーム送信時の一括検証

```javascript
// すべてのフィールドを検証
const validationResults = validateAllFields(["user_id", "user_name", "email", "phone"]);

// すべての検証が成功したか確認
if (isAllValidationsPassed(validationResults)) {
    // フォーム送信処理
    submitForm();
} else {
    alert("入力項目に未記入または形式が正しくない箇所があります");
}
```

---

## トラブルシューティング

### Q1: オーバーレイが表示されない

**原因**: HTMLのID設定が`validationFieldsConfig`と一致していない

**確認項目**:
- ✅ `overlayId` が実際のdiv要素のIDと同じか
- ✅ `li` 要素のIDが `フィールドキー_req_ルールキー` の形式か
- ✅ 特にpasswordフィールドの場合、pw_req_upper/lower/number という特殊なIDに対応しているか

**修正例**:
```javascript
// 設定
overlayId: "email_requirements"

// HTML
<div id="email_requirements">  ✅ OK
<!-- 間違い -->
<div id="emailRequirements">  ❌ NG (キャメルケース)
```

### Q2: チェック表示（✓/✗）が更新されない

**原因**: `updateFieldDisplay()` が正しく要素を取得していない

**確認項目**:
- ✅ ルールキーが `requirements` 配列に含まれているか
- ✅ HTMLの `li` 要素のIDが正しいか

**デバッグ方法**:
```javascript
// ブラウザコンソールで確認
validateField("user_id");  // 各ルールのtrue/falseが表示されます
```

### Q3: 複合条件が機能しない

**原因**: テスト関数内で参照している要素が存在しない

**確認項目**:
- ✅ `document.getElementById()` で指定するIDは存在するか
- ✅ テスト関数内で参照する他のフィールドは先に入力されているか

**修正例**:
```javascript
// パスワード一致チェックの場合
match: { 
    label: "パスワード一致", 
    test: (val) => {
        const pw = document.getElementById("pw").value;
        // pwが空の場合はfalseを返す
        return pw.length > 0 && val === pw;
    }
}
```

### Q4: 正規表現が思った通りに動作しない

**原因**: 正規表現のエスケープまたはフラグが不足している

**よくあるミス**:
```javascript
// ❌ 間違い（ドット）
/^.+@.+\.com$/  // これはいかなる文字とも一致

// ✅ 正しい
/^.+@.+\.com$/  // \. でドットを明示
// またはより厳密に
/^[\w.+-]+@[\w-]+\.[\w.-]+$/
```

### Q5: オーバーレイが画面外に出ている

**原因**: `positionOverlay()` の計算がウィンドウサイズを考慮していない

**確認項目**:
- ✅ 入力フィールドがウィンドウの右端に近くないか
- ✅ スクロール時に位置が正しく更新されているか

**自動的に調整される**:
```javascript
// ウィンドウ右端を超える場合、自動的に左側に配置されます
if (leftPosition + overlayElement.offsetWidth > window.innerWidth) {
    overlayElement.style.left = (rect.right + scrollLeft - overlayElement.offsetWidth) + "px";
}
```

---

## ベストプラクティス

### ✅ DO

- ✅ ルールは再利用可能な小さな単位に分割
- ✅ テスト関数は純粋関数（副作用なし）
- ✅ HTMLのID命名は統一的に（キャバブケース推奨）
- ✅ 複雑なバリデーションは段階的に構築

### ❌ DON'T

- ❌ テスト関数内で DOM操作をしない
- ❌ ルール定義をHTMLに散在させない
- ❌ `validationFieldsConfig` 以外でイベントリスナーを追加しない
- ❌ ルールキーをランダムに命名する

---

## まとめ

このテンプレートを使用することで：

1. **新しいバリデーションフィールドを数分で追加可能**
2. **ルール変更時は設定のみ修正**
3. **すべてのフィールドで統一された UX を提供**
4. **コードの重複を大幅削減**

定期的にこのマニュアルを確認しながら、効率的にバリデーション機能を拡張してください！
