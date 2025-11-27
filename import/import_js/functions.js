// ===========================================
// 共通ユーティリティ関数
// ===========================================

/**
 * ローディング表示制御
 */
function showLoading() {
    UIkit.modal('#loading-modal').show();
}

function hideLoading() {
    UIkit.modal('#loading-modal').hide();
}

/**
 * 変数リセット
 */
function resetGlobalVariables() {
    dataTypeValue = '';
    Mode = '';
}

/**
 * ファイルエリアのリセット
 */
function resetFileAreas() {
    fileAreas.forEach(function(item) {
        if ($(item.input).length) {
            $(item.input).val(null);
            $(item.area).css("background-color", "transparent");
            if (item.button) {
                $(item.button).css("background-color", "");
            }
            if (item.label) {
                $(item.label)
                    .text('ファイル未選択')
                    .removeClass('text_underline');
            }
        }
    });
}

/**
 * インポート処理の共通ハンドラ
 */
function handleImportResponse(result) {
    hideLoading();
    
    if (result.judge === 'success') {
        showImportCompleteModal();
        resetFileAreas();
        resetGlobalVariables();
        return;
    } else if (result.confirmation_required) {
        showConfirmationModal(result);
        return;
    } else {
        showStickyNote(result.text || 'インポートに失敗しました。');
        resetGlobalVariables();
    }
}

/**
 * インポート処理のエラーハンドラ
 */
function handleImportError() {
    hideLoading();
    showStickyNote('インポート処理で問題が発生しました。');
    resetGlobalVariables();
}

/**
 * インポート実行（共通処理）
 */
function executeImport(forceImport = false) {
    showLoading();
    
    const formData = new FormData();
    formData.append('data_type', dataTypeValue);
    formData.append('month', Mode === 'month' ? '1' : '');
    
    if (forceImport) {
        formData.append('force_import', '1');
    }
    
    return fetch('./import.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(handleImportResponse)
    .catch(handleImportError);
}

/**
 * レスポンス解析とエラーハンドリング
 */
function parseResponseWithErrorHandling(response) {
    return response.text().then(responseText => {
        try {
            return JSON.parse(responseText);
        } catch (parseError) {
            // サーバーからのエラーメッセージがHTMLまたはテキストの場合
            if (responseText.includes('<!DOCTYPE') || responseText.includes('<html')) {
                throw new Error('サーバーからHTMLエラーページが返されました。管理者にお問い合わせください。');
            } else if (responseText.includes('Fatal error') || responseText.includes('Parse error')) {
                throw new Error('サーバー側でPHPエラーが発生しました。管理者にお問い合わせください。');
            } else {
                throw new Error(`サーバーから不正な応答がありました: ${responseText.substring(0, 100)}...`);
            }
        }
    });
}

/**
 * ファイルチェック処理
 */
function performFileCheck(formData) {
    fetch('file_check.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        return parseResponseWithErrorHandling(response);
    })
    .then(data => {
        // data_type、modeの値をグローバル変数に格納
        dataTypeValue = data.data_type; 
        Mode = data.mode;
        console.log(data.min);
        console.log(data.max);
        
        if (data.judge === 'success') {
            // 成功時：モーダル表示
            showImportModal(data.name, data.first_year, data.latest_year, data.file_name, data.year);
        } else {
            // エラー時：付箋表示
            showStickyNote(data.text || 'このファイルはインポートできません');
        }
    })
    .catch(error => {
        showStickyNote(error.message || '問題が発生しました。');
    });
}

/**
 * ファイル名から日時とユーザーIDを抽出してログ形式に変換
 */
function parseBackupFileName(fileName) {
    const parts = fileName.split('_');
    
    // 新形式: 20251021133015_w3333333_import.csv の場合
    if (parts.length >= 3 && parts[0].length === 14 && /^\d{14}$/.test(parts[0])) {
        const dateTimeStr = parts[0];
        const userId = parts[1];
        
        // 日時を分割
        const year = dateTimeStr.substring(0, 4);
        const month = dateTimeStr.substring(4, 6);
        const day = dateTimeStr.substring(6, 8);
        const hour = dateTimeStr.substring(8, 10);
        const minute = dateTimeStr.substring(10, 12);
        const second = dateTimeStr.substring(12, 14);
        
        const date = `${year}/${month}/${day}`;
        const time = `${hour}:${minute}:${second}`;
        const displayText = `${date} ${time} (${userId})`;
        
        return {
            date: date,
            time: time,
            userId: userId,
            displayText: displayText,
            originalName: fileName
        };
    }
    
    // 旧形式や無効な形式の場合はそのまま返す
    return {
        date: '-',
        time: '-',
        userId: '-',
        displayText: fileName,
        originalName: fileName
    };
}

/**
 * バックアップファイル一覧を表示用に変換
 */
function formatBackupFileList(fileList) {
    return fileList.map(function(fileName) {
        return parseBackupFileName(fileName);
    });
}

/**
 * ファイルチェック後処理関数
 * エラーなし　→ モーダル表示
 */
function showImportModal(name, f_year, l_year, file_name, year) {
    document.getElementById('import-modal-message').innerHTML = `
        <h3 class="error-message text-center" style='font-weight: bold;'>＜　以下の内容を確認してください。　＞</h3>
        <p class="modal-message">
            　・ファイル名を変更する場合は、ファイルを再選択してください。<br>
            　・ファイルの形式が「csv」ではない場合は、ファイルを再選択してください。<br>
            　・ファイルの内容が、<span class="mtext-font-size">「${name}」</span>であるか確認してください。<br>
            　・既存データの最新${f_year}は、<span class="mtext-font-size">${l_year}</span>です。<br>
            　・ファイル名：<span class="mtext-font-size">${file_name}</span><br>
            　・<span class="mtext-font-size">${year}</span> のデータです。
        </p>
        <p class="modal-caution">上記の内容に問題がない場合は、「インポート」を押してください</p>
    `;

    // モーダル表示
    UIkit.modal('#import-modal').show();

    // インポートボタン
    document.getElementById('import-modal-submit').onclick = function() {
        UIkit.modal('#import-modal').hide();
        executeImport();
    };

    // 戻るボタン
    document.getElementById('import-modal-cancel').onclick = function() {
        UIkit.modal('#import-modal').hide();
    };
}

// エラー時 付箋表示
function showStickyNote(message) {
    // 既存の付箋を削除
    const area = document.getElementById('sticky-note-area');
    area.innerHTML = '';

    // 付箋要素を作成
    const note = document.createElement('div');
    note.className = 'sticky-note sticky-note-center';
    note.innerHTML = '<span class="close-btn" onclick="this.parentNode.remove();">&times;</span>' +
        '<h2 class="text-center error_import"><strong>エラー</strong></h2><p>★以下の点でインポートされませんでした★</p>' +
        '<span style="vertical-align:middle;">' + message + '</span>';

    area.appendChild(note);

    // 15秒後自動で消す
    setTimeout(function() {
        if (note.parentNode) note.parentNode.removeChild(note);
    }, 30000);
}

// インポート完了モーダルを表示する
function showImportCompleteModal() {
    // モーダルHTML
    const completeModalHtml = `
        <div id="import-complete-modal" class="uk-flex-top" uk-modal>
            <div class="uk-modal-dialog uk-modal-body"
                style="
                    margin-top: 40px;
                    border-radius: 22px;
                    min-width: 280px;
                    max-width: 380px;
                    width: fit-content;
                    box-shadow: 0 8px 32px rgba(0,0,0,0.22);
                    padding: 32px 36px 24px 36px;
                    border: 2px solid #4CAF50;
                    text-align: center;
                    position: relative;
                    overflow: hidden;
                ">
                <div style="display:flex; flex-direction:column; align-items:center;">
                    <div style="
                        background: linear-gradient(135deg, #4CAF50 60%, #4CAF50 100%);
                        border-radius: 50%;
                        width: 64px;
                        height: 64px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        margin-bottom: 18px;
                        box-shadow: 0 2px 8px rgba(91,192,190,0.18);
                    ">
                        <span class="uk-icon" uk-icon="icon: check; ratio: 2" style="color: #fff;"></span>
                    </div>
                    <h2 class="uk-modal-title" style="margin-bottom: 12px; color: #333; font-weight:700;">インポート完了</h2>
                    <p style="margin-bottom: 28px; color: #222; font-size: 1.1em;">データのインポートが正常に完了しました。</p>
                </div>
                <div class="uk-modal-footer uk-text-center" style="border:none; padding:0;">
                    <button class="uk-button uk-button-primary import-modal-btn" id="go-home-btn" type="button" style="
                        margin-right:12px;
                        border-radius: 6px;
                        font-weight:600;
                        background: linear-gradient(90deg, #4CAF50 100%);
                        border: none;
                        box-shadow: 0 2px 8px rgba(91,192,190,0.12);
                        transition: background 0.2s;
                    ">ホームへ戻る</button>
                    <button class="uk-button uk-button-default import-modal-btn" type="button" id="close-complete-modal" style="
                        border-radius: 6px;
                        font-weight:600;
                        border: 1.5px solid #5bc0be;
                        color: #4CAF50;
                        background: #fff;
                        transition: background 0.2s, color 0.2s;
                    ">閉じる</button>
                </div>
            </div>
        </div>
        <style>
        #import-complete-modal .import-modal-btn:hover {
            background: linear-gradient(90deg,rgb(89, 192, 93) 100%) !important;
            color: #fff !important;
        }
        #import-complete-modal #close-complete-modal.import-modal-btn:hover {
            background: #4CAF50 !important;
            color: #fff !important;
        }
        </style>
    `;
    // 既存のモーダルがあれば削除
    $('#import-complete-modal').remove();
    // bodyに追加
    $('body').append(completeModalHtml);
    // モーダル表示
    UIkit.modal('#import-complete-modal').show();

    // 「ホームへ戻る」ボタン
    $('#go-home-btn').off('click').on('click', function() {
        window.location.href = "../menu/MENU_control.php"; // ホームのパスに合わせて修正
    });
    // 「閉じる」ボタン
    $('#close-complete-modal').off('click').on('click', function() {
        UIkit.modal('#import-complete-modal').hide();
    });
}

/**
 * 医療機関情報確認モーダルを表示する関数
 */
function showConfirmationModal(result) {
    // 確認が必要な場合は不一致モーダルを表示
    if (result.confirmation_required && result.errors && result.errors.length > 0) {
        showMismatchModal(result);
        return;
    }
    
    // 通常の確認メッセージを表示
    const message = result.text || 'インポートを実行しますか？';
    document.getElementById('import-modal-message').innerHTML = '<p>' + message + '</p>';
    
    // モーダルを表示
    UIkit.modal('#import-modal').show();
    
    // 実行ボタンのイベント
    const submitBtn = document.getElementById('import-modal-submit');
    if (submitBtn) {
        submitBtn.onclick = function() {
            UIkit.modal('#import-modal').hide();
            executeImport(true); // force_import = true
        };
    }
    
    // キャンセルボタンのイベント
    const cancelBtn = document.getElementById('import-modal-cancel');
    if (cancelBtn) {
        cancelBtn.onclick = function() {
            UIkit.modal('#import-modal').hide();
            resetGlobalVariables();
        };
    }
}

/**
 * エラーデータを解析して表形式用のデータを作成
 */
function parseErrorData(errors) {
    const parsedData = [];
    
    errors.forEach(function(error) {
        // 行番号を抽出
        const rowMatch = error.match(/・行(\d+):/);
        const rowNumber = rowMatch ? rowMatch[1] : '-';
        
        // 医療機関コードを抽出
        const codeMatch = error.match(/医療機関CD「([^」]+)」/);
        const hosCode = codeMatch ? codeMatch[1] : '-';
        
        // マスタ病院名を抽出
        const masterMatch = error.match(/マスタ病院名:\s*「([^」]+)」/);
        const masterName = masterMatch ? masterMatch[1] : '-';
        
        // CSVデータを抽出
        const csvMatch = error.match(/CSVデータ:\s*「([^」]+)」/);
        const csvData = csvMatch ? csvMatch[1] : '-';
        
        parsedData.push({
            rowNumber: rowNumber,
            hosCode: hosCode,
            masterName: masterName,
            csvData: csvData
        });
    });
    
    return parsedData;
}

/**
 * エラーテーブルHTMLを生成
 */
function generateErrorTable(parsedErrors) {
    let tableHtml = '<table style="width: 100%; border-collapse: collapse; font-size: 13px; background: white; border: 1px solid #dee2e6;">';
    tableHtml += '<thead>';
    tableHtml += '<tr style="background-color: #f8f9fa; border-bottom: 2px solid #dee2e6;">';
    tableHtml += '<th style="padding: 8px 6px; text-align: center; border: 1px solid #dee2e6; font-weight: bold; color: #495057; min-width: 50px;">行番号</th>';
    tableHtml += '<th style="padding: 8px 6px; text-align: center; border: 1px solid #dee2e6; font-weight: bold; color: #495057; min-width: 80px;">医療機関コード</th>';
    tableHtml += '<th style="padding: 8px 6px; text-align: center; border: 1px solid #dee2e6; font-weight: bold; color: #495057; min-width: 180px;">マスタ登録名</th>';
    tableHtml += '<th style="padding: 8px 6px; text-align: center; border: 1px solid #dee2e6; font-weight: bold; color: #495057; min-width: 180px;">CSVデータ</th>';
    tableHtml += '</tr>';
    tableHtml += '</thead>';
    tableHtml += '<tbody>';
    
    parsedErrors.forEach(function(error, index) {
        const rowClass = index % 2 === 0 ? 'background-color: #f8f9fa;' : 'background-color: white;';
        tableHtml += '<tr style="' + rowClass + '">';
        tableHtml += '<td style="padding: 8px 6px; border: 1px solid #dee2e6; text-align: center; font-family: monospace;">' + error.rowNumber + '</td>';
        tableHtml += '<td style="padding: 8px 6px; border: 1px solid #dee2e6; text-align: center; font-family: monospace;">' + error.hosCode + '</td>';
        tableHtml += '<td style="padding: 8px 6px; border: 1px solid #dee2e6; max-width: 180px; word-wrap: break-word; line-height: 1.3;">' + error.masterName + '</td>';
        tableHtml += '<td style="padding: 8px 6px; border: 1px solid #dee2e6; max-width: 180px; word-wrap: break-word; line-height: 1.3;">' + error.csvData + '</td>';
        tableHtml += '</tr>';
    });
    
    tableHtml += '</tbody>';
    tableHtml += '</table>';
    
    return tableHtml;
}

/**
 * 不一致情報表示モーダルを表示する関数
 */
function showMismatchModal(result) {
    
    // 基本的なエラーメッセージを作成
    let errorMessage = '<h3 style="color: #e74c3c; margin-bottom: 15px;">医療機関情報に不整合があります</h3>';
    errorMessage += '<div style="background-color: #f8f9fa; padding: 15px; border-left: 4px solid #e74c3c; margin: 10px 0; border-radius: 4px;">';
    errorMessage += '<p style="margin-bottom: 10px; font-weight: bold;">' + (result.text || '医療機関情報に不整合があります。') + '</p>';
    
    if (result.errors && result.errors.length > 0) {
        const parsedErrors = parseErrorData(result.errors);
        
        errorMessage += '<div style="max-height: 400px; overflow-y: auto; margin: 15px 0;">';
        errorMessage += '<h4 style="color: #333; margin: 10px 0 15px 0; font-size: 16px;">不整合項目一覧 (' + result.errors.length + '件):</h4>';
        
        // 表形式でエラーを表示
        errorMessage += generateErrorTable(parsedErrors);
        errorMessage += '</div>';
    }
    
    errorMessage += '</div>';
    errorMessage += '<div style="margin-top: 20px; padding: 15px; background-color: #fff3cd; border: 1px solid #ffeaa7; border-radius: 4px;">';
    errorMessage += '<p style="margin: 5px 0 0 0; font-size: 14px; color: #856404;">「了承し、インポートを行う」を選択すると、上記の不整合があってもインポートを実行します。</p>';
    errorMessage += '</div>';

    // 不一致モーダルのメッセージを設定
    const messageElement = document.getElementById('mismatch-modal-message');
    if (messageElement) {
        messageElement.innerHTML = errorMessage;
    } else {
        return;
    }

    // 不一致モーダルを表示
    UIkit.modal('#mismatch-modal').show();

    // 実行ボタンのイベント
    const submitBtn = document.getElementById('mismatch-modal-submit');
    if (submitBtn) {
        submitBtn.onclick = function() {
            UIkit.modal('#mismatch-modal').hide();
            executeImport(true); // force_import = true
        };
    }
    
    // キャンセルボタンのイベント
    const mismatchCancelBtn = document.getElementById('mismatch-modal-cancel');
    if (mismatchCancelBtn) {
        mismatchCancelBtn.onclick = function() {
            UIkit.modal('#mismatch-modal').hide();
            resetGlobalVariables();
        };
    }
}