/**
 * =====================================================
 * リアルタイムバリデーション処理テンプレート（汎用ライブラリ）
 * =====================================================
 * 
 * 使用方法：
 * 1. このファイルを HTMLで読み込む
 * 2. validationFieldsConfig オブジェクトを定義する
 * 3. initializeAllValidationFields() を実行する
 * 
 * 詳細はマニュアル参照：ValidationTemplate_Manual.md
 */

/**
 * 条件要素のクラスと表示を更新する（汎用）
 * ※trueなら緑のチェック、falseなら赤のバツを表示
 * 
 * @param {HTMLElement} element - 更新する li 要素
 * @param {boolean} isMet - 検証結果（true=成功, false=失敗）
 */
function updateRequirementElement(element, isMet) {
    if (isMet) {
        element.classList.remove("unchecked");
        element.classList.add("checked");
        element.querySelector("span").textContent = "✓";
    } else {
        element.classList.remove("checked");
        element.classList.add("unchecked");
        element.querySelector("span").textContent = "✗";
    }
}

/**
 * フィールドの検証結果を取得（汎用）
 * 
 * @param {string} fieldKey - validationFieldsConfig のキー
 * @returns {object} 各ルールの検証結果 {ruleName: boolean, ...}
 */
function validateField(fieldKey) {
    const config = validationFieldsConfig[fieldKey];
    
    if (!config) {
        console.error(`フィールド設定が見つかりません: ${fieldKey}`);
        return {};
    }
    
    const inputElement = document.getElementById(config.inputId);
    if (!inputElement) {
        console.error(`入力要素が見つかりません: ${config.inputId}`);
        return {};
    }
    
    const value = inputElement.value;
    const requirements = {};
    
    config.requirements.forEach(reqKey => {
        if (config.rules[reqKey]) {
            requirements[reqKey] = config.rules[reqKey].test(value);
        }
    });
    
    return requirements;
}

/**
 * フィールドのオーバーレイ表示を更新（汎用）
 * 
 * @param {string} fieldKey - validationFieldsConfig のキー
 */
function updateFieldDisplay(fieldKey) {
    const config = validationFieldsConfig[fieldKey];
    
    if (!config) {
        console.error(`フィールド設定が見つかりません: ${fieldKey}`);
        return;
    }
    
    const requirements = validateField(fieldKey);
    const overlayElement = document.getElementById(config.overlayId);
    
    if (!overlayElement) {
        console.error(`オーバーレイ要素が見つかりません: ${config.overlayId}`);
        return;
    }
    
    // 各要件要素の更新
    config.requirements.forEach(reqKey => {
        // HTMLのID命名パターンに従って要素を取得
        // user_id: user_id_req_required, user_id_req_length
        // password: pw_req_length, pw_req_upper など
        let elementId;
        
        if (fieldKey === "password") {
            // passwordフィールドは"pw_req_*"というIDになっている
            if (reqKey === "uppercase") {
                elementId = "pw_req_upper";
            } else if (reqKey === "lowercase") {
                elementId = "pw_req_lower";
            } else if (reqKey === "number") {
                elementId = "pw_req_number";
            } else {
                elementId = `pw_req_${reqKey}`;
            }
        } else if (fieldKey === "repass") {
            // repassフィールドは"repass_req_match"
            elementId = `repass_req_${reqKey}`;
        } else {
            // user_id, user_name など
            elementId = `${fieldKey}_req_${reqKey}`;
        }
        
        const element = document.getElementById(elementId);
        if (element) {
            updateRequirementElement(element, requirements[reqKey]);
        }
    });
}

/**
 * オーバーレイボックスの位置を計算して設定（汎用）
 * 入力フィールドの下に配置し、ウィンドウ右端に対応
 * 
 * @param {HTMLElement} inputElement - 入力要素
 * @param {HTMLElement} overlayElement - オーバーレイ要素
 */
function positionOverlay(inputElement, overlayElement) {
    const rect = inputElement.getBoundingClientRect();
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    
    // ※入力フィールドの下に配置（10pxの隙間）
    const topPosition = rect.bottom + scrollTop + 10;
    const leftPosition = rect.left + scrollLeft;
    
    overlayElement.style.top = topPosition + "px";
    overlayElement.style.left = leftPosition + "px";
    
    // ※ウィンドウ右端の判定：左側に配置を調整
    if (leftPosition + overlayElement.offsetWidth > window.innerWidth) {
        overlayElement.style.left = (rect.right + scrollLeft - overlayElement.offsetWidth) + "px";
    }
}

/**
 * フィールドにイベントリスナーを設定（汎用テンプレート）
 * フォーカス、入力、フォーカス外のイベントを自動設定
 * 
 * @param {string} fieldKey - validationFieldsConfig のキー
 */
function initializeValidationField(fieldKey) {
    const config = validationFieldsConfig[fieldKey];
    
    if (!config) {
        console.error(`フィールド設定が見つかりません: ${fieldKey}`);
        return;
    }
    
    const inputElement = document.getElementById(config.inputId);
    const overlayElement = document.getElementById(config.overlayId);
    
    if (!inputElement || !overlayElement) {
        console.error(`要素が見つかりません。inputId: ${config.inputId}, overlayId: ${config.overlayId}`);
        return;
    }
    
    // ※フォーカス時
    inputElement.addEventListener("focus", function() {
        overlayElement.style.display = "block";
        updateFieldDisplay(fieldKey);
        positionOverlay(this, overlayElement);
    });
    
    // ※入力時
    inputElement.addEventListener("input", function() {
        updateFieldDisplay(fieldKey);
    });
    
    // ※フォーカス外時
    inputElement.addEventListener("blur", function() {
        overlayElement.style.display = "none";
    });
}

/**
 * すべてのバリデーションフィールドを一括初期化
 * validationFieldsConfig に定義されたすべてのフィールドを初期化
 * 
 * ※DOMが読み込まれた後に呼び出してください
 */
function initializeAllValidationFields() {
    if (typeof validationFieldsConfig === 'undefined') {
        console.error('validationFieldsConfig が定義されていません');
        return;
    }
    
    Object.keys(validationFieldsConfig).forEach(fieldKey => {
        initializeValidationField(fieldKey);
    });
}

/**
 * フィールド値をまとめて検証する（汎用テンプレート対応）
 * 複数フィールドを一括検証してすべての結果を返す
 * 
 * @param {array} fieldKeysToCheck - 検証するフィールドキーの配列
 * @returns {object} 各フィールドの検証結果
 */
function validateAllFields(fieldKeysToCheck) {
    const results = {};
    fieldKeysToCheck.forEach(fieldKey => {
        results[fieldKey] = validateField(fieldKey);
    });
    return results;
}

/**
 * すべての検証結果が成功しているかチェック（汎用）
 * 複数フィールドの検証結果がすべて成功しているか確認
 * 
 * @param {object} validationResults - validateAllFields() の戻り値
 * @returns {boolean} すべてのルールが成功している場合 true
 */
function isAllValidationsPassed(validationResults) {
    return Object.values(validationResults).every(requirements => 
        Object.values(requirements).every(result => result === true)
    );
}

/**
 * 互換性のための従来の個別関数
 * ※新規実装時はテンプレート経由で処理することを推奨
 */
function checkUserIdRequirements(userId) {
    return validateField("user_id");
}

function checkUserNameRequirements(userName) {
    return validateField("user_name");
}

function checkPasswordRequirements(password) {
    return validateField("password");
}

function checkPasswordMatch() {
    const requirements = validateField("repass");
    return requirements.match;
}
