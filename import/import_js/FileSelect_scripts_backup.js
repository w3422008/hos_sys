// グローバル変数
// data_typeの値を格納する変数
let dataTypeValue = '';
// モードを格納する変数（例: 'year'や'month'など）
let Mode = '';

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
        console.log('Raw response:', responseText);
        
        try {
            return JSON.parse(responseText);
        } catch (parseError) {
            console.error('JSON parse error:', parseError);
            console.error('Response that failed to parse:', responseText);
            
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
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers.get('Content-Type'));
        return parseResponseWithErrorHandling(response);
    })
    .then(data => {
        // data_type、modeの値をグローバル変数に格納
        dataTypeValue = data.data_type; 
        Mode = data.mode;
        console.log('Parsed data:', data);
        console.log('dataTypeValue:', dataTypeValue);
        console.log('Mode:', Mode);
        
        if (data.judge === 'success') {
            // 成功時：モーダル表示
            showImportModal(data.name, data.first_year, data.latest_year, data.file_name, data.year);
        } else {
            // エラー時：付箋表示
            showStickyNote(data.text || 'このファイルはインポートできません');
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        showStickyNote(error.message || '問題が発生しました。');
    });
}

// ===========================================
// メインモーダル関数
// ===========================================

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
            　・<span class="mtext-font-size">${file_name}</span> は、<br><span class="mtext-font-size">${year}</span> のデータです。
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

// 対象となるエリアとinputのIDを配列で管理
const fileAreas = [
    // 紹介データ
    { area: '#file_drag_drop_area_intro_month', input: '#myFile_intro_month', label: '#fileName_intro_month', button: '#customFileBtn_intro_month' },
    { area: '#file_drag_drop_area_intro_year', input: '#myFile_intro_year', label: '#fileName_intro_year', button: '#customFileBtn_intro_year' },
    // 逆紹介データ
    { area: '#file_drag_drop_area_invintro_month', input: '#myFile_invintro_month', label: '#fileName_invintro_month', button: '#customFileBtn_invintro_month' },
    { area: '#file_drag_drop_area_invintro_year', input: '#myFile_invintro_year', label: '#fileName_invintro_year', button: '#customFileBtn_invintro_year' },
    // コンタクト履歴データ
    { area: '#file_drag_drop_area_contact_month', input: '#myFile_contact_month', label: '#fileName_contact_month', button: '#customFileBtn_contact_month' },
    { area: '#file_drag_drop_area_contact_year', input: '#myFile_contact_year', label: '#fileName_contact_year', button: '#customFileBtn_contact_year' },
    // 兼業データ
    { area: '#file_drag_drop_area_training', input: '#myFile_training', label: '#fileName_training', button: '#customFileBtn_training' }
];


$(function() {

    // ドラッグ＆ドロップエリア内のボタンクリック時の動作
    // 紹介データ
    // 年
    document.getElementById('customFileBtn_intro_year').addEventListener('click', function() {
    document.getElementById('myFile_intro_year').click();
    });

    // 月
    document.getElementById('customFileBtn_intro_month').addEventListener('click', function() {
        document.getElementById('myFile_intro_month').click();
    });
    
    // 逆紹介データ
    // 年
    document.getElementById('customFileBtn_invintro_year').addEventListener('click', function() {
    document.getElementById('myFile_invintro_year').click();
    });

    // 月
    document.getElementById('customFileBtn_invintro_month').addEventListener('click', function() {
        document.getElementById('myFile_invintro_month').click();
    });


    // コンタクト履歴データ
    // 年
    document.getElementById('customFileBtn_contact_year').addEventListener('click', function() {
        document.getElementById('myFile_contact_year').click();
    });

    // 月
    document.getElementById('customFileBtn_contact_month').addEventListener('click', function() {
        document.getElementById('myFile_contact_month').click();
    });

    // 兼業データ
    document.getElementById('customFileBtn_training').addEventListener('click', function() {
        document.getElementById('myFile_training').click();
    });

    // ドラッグ＆ドロップ、ファイル選択時の動作
    fileAreas.forEach(function(item) {
        // ドラッグオーバー時
        $(document).on('dragover', item.area, function(event) {
            event.preventDefault();
            $(this).css("background-color", "#daecda");
            if (item.button) {
                $(item.button).css("background-color", "#daecda");
            }
        });
        // ドラッグリーブ時
        $(document).on('dragleave', item.area, function(event) {
            event.preventDefault();
            $(this).css("background-color", "transparent");
            if (item.button) {
                $(item.button).css("background-color", "");
            }
        });
        // ドロップ時
        $(document).on('drop', item.area, function(event) {
            let org_e = event.originalEvent || event;
            org_e.preventDefault();
            if (org_e.dataTransfer && org_e.dataTransfer.files.length > 0) {
                $(item.input)[0].files = org_e.dataTransfer.files;
                $(this).css("background-color", "#daecda");
                if (item.button) {
                    $(item.button).css("background-color", "#daecda");
                }
                // ファイル名表示
                if (item.label) {
                    const fileName = org_e.dataTransfer.files[0].name;
                    $(item.label)
                        .text('「' + fileName + '」を選択中')
                        .addClass('text_underline');
                }
            }
        });
        // ファイル選択時
        $(item.input).on('change', function() {
            if (this.files.length > 0) {
                $(item.area).css("background-color", "#daecda");
                if (item.button) {
                    $(item.button).css("background-color", "#daecda");
                }
                if (item.label) {
                    $(item.label)
                        .text('「' + this.files[0].name + '」を選択中')
                        .addClass('text_underline');
                }
            } else {
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
        // クリック時リセット（必要に応じて）
        $(item.input).on('click', function() {
            $(this).val(null);
            $(item.area).css("background-color", "transparent");
            if (item.button) {
                $(item.button).css("background-color", "");
            }
            if (item.label) {
                $(item.label)
                    .text('ファイル未選択')
                    .removeClass('text_underline');
            }
        });
        // ページロード時リセット
        $(document).ready(function() {
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
        });
    });

    // 送信ボタンとフォームの対応を自動取得
    const submitButtons = [];
    $('button').each(function() {
        if ($(this).text().trim() === '送信') {
            const form = $(this).closest('form');
            if (form.length && form.attr('id')) {
                submitButtons.push({
                    btn: this,
                    form: '#' + form.attr('id')
                });
            }
        }
    });

    // 送信ボタンのクリックイベント
    submitButtons.forEach(function(item) {
        $(item.btn).on('click', function(e) {
            e.preventDefault();
            const form = $(item.form)[0];
            const formData = new FormData(form);

            // ファイル未選択時の送信防止
            let hasFile = false;
            fileAreas.forEach(function(areaItem) {
                if ($(areaItem.input).length && $(areaItem.input)[0].files.length > 0) {
                    hasFile = true;
                }
            });

            if (!hasFile) {

                // ファイルが選択されていない場合のアラートQ
                window.alert('ファイルが選択されていません。');
                return;

            }else{

                // name属性から「_」より前の文字列をdata_typeとして追加
                const btnName = $(this).attr('name');
                
                console.log('Button name:', btnName);
                                
                if (btnName) {
                    const dataType = btnName.split('_')[0];
                    formData.append('data_type', dataType);
                    console.log('Data type set to:', dataType);
                }

                // FormDataの内容をデバッグ出力
                console.log('FormData contents:');
                for (let [key, value] of formData.entries()) {
                    console.log(key, value);
                }

                // ファイルチェック
                performFileCheck(formData);
            
            }
        });
    });

    // バックアップボタンと対応するデータ
    const backupBtnMap = [
        {
            btn: '#introBackupForm',
            key: 'BK_intro',
            title: '紹介バックアップ一覧'
        },
        {
            btn: '#invIntroBackupForm',
            key: 'BK_invers_intro',
            title: '逆紹介バックアップ一覧'
        },
        {
            btn: '#contactBackupForm',
            key: 'BK_contact',
            title: 'コンタクト履歴バックアップ一覧'
        },
        {
            btn: '#trainingBackupForm',
            key: 'BK_training',
            title: '兼業バックアップ一覧'
        }
    ];

    backupBtnMap.forEach(function(item) {
        $(item.btn).on('click', function(e) {
            e.preventDefault();
            // モーダルタイトル
            $('#backup-modal-title').text(item.title);

            // バックアップファイル一覧を取得
            const backupFiles = window.folderFiles[item.key] || [];
            const backupList = document.getElementById('backup-list');
            backupList.innerHTML = '';
            backupFiles.forEach(function(csv) {
                const li = document.createElement('li');
                li.textContent = csv + ' ';
                // プレビューボタン
                const previewBtn = document.createElement('button');
                previewBtn.className = 'uk-button uk-button-default view-csv-btn';
                previewBtn.textContent = 'プレビュー';
                previewBtn.setAttribute('data-view', item.key + '/' + csv);
                li.appendChild(previewBtn);
                // ダウンロードボタン
                const dlBtn = document.createElement('a');
                dlBtn.className = 'uk-button uk-button-primary';
                dlBtn.href = './' + item.key + '/' + encodeURIComponent(csv);
                dlBtn.download = '';
                dlBtn.textContent = 'ダウンロード';
                li.appendChild(dlBtn);
                backupList.appendChild(li);
            });
            UIkit.modal('#backup-modal').show();

            // プレビューボタンのイベント
            $('#backup-list .view-csv-btn').off('click').on('click', function() {
                showLoading();
                const viewFile = $(this).attr('data-view');
                fetch('file_select.php?ajax_view=' + encodeURIComponent(viewFile))
                    .then(res => res.text())
                    .then(html => {
                        $('#csv-modal-content').html('<div class="csv-table-container">' + html + '</div>');
                        hideLoading();
                        UIkit.modal('#csv-modal').show();
                    })
                    .catch(() => {
                        hideLoading();
                        showStickyNote('CSVプレビューの読み込みに失敗しました。');
                    });
            });
        });
    });
    
    $('#close-backup-modal').on('click', function() {
    UIkit.modal('#backup-modal').hide();
    });

});

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
            console.log('Import cancelled');
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
    console.log('=== showMismatchModal called ===');
    console.log('result:', result);
    
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
        console.error('mismatch-modal-message element not found');
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
            console.log('Mismatch Import cancelled');
            UIkit.modal('#mismatch-modal').hide();
            resetGlobalVariables();
        };
    }
}
