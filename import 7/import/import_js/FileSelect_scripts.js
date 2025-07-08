// グローバル変数
// data_typeの値を格納する変数
let dataTypeValue = '';
// モードを格納する変数（例: 'year'や'month'など）
let Mode = '';

// ファイルチェック後処理関数
// エラーなし　→ モーダル表示
function showImportModal(name,f_year,l_year,file_name,year) {

    document.getElementById('import-modal-message').innerHTML = `
        <style>
            /* 確認事項 */
            .modal-message {
                border: solid 2px #68e66c;
                background-color: #f8fff8;
                padding: 0.5em 1em 0.5em 1.2em;
                position: relative;
            }

            .modal-message li {
                line-height: 1.5;
                padding: 0.5em 0;
                list-style-type: none!important;/*ポチ消す*/
            }

            .fa-check{
                color: #2a682c;
                margin-right: 0.2em;
            }
        </style>
        <h3 class="error-message text-center" style='font-weight: bold;'>＜　以下の内容を確認してください。　＞</h3>
        <ul class="modal-message">
            <li><i class="fa-solid fa-check"></i>ファイル名を変更する場合は、ファイルを再選択してください。</li>
            <li><i class="fa-solid fa-check"></i>ファイルの形式が「csv」ではない場合は、ファイルを再選択してください。</li>
            <li><i class="fa-solid fa-check"></i>ファイルの内容が、<span class="mtext-font-size">「` + name + `」</span>であるか確認してください。</li>
            <li><i class="fa-solid fa-check"></i>既存データの最新` + f_year + `は、<span class="mtext-font-size">` + l_year + `</span>です。</li>
            <li><i class="fa-solid fa-check"></i><span class="mtext-font-size">` + file_name + `</span> は、<span class="mtext-font-size">` + year + `</span> のデータです。</li>
        </ul>
        <p class="modal-caution">上記の内容に問題がない場合は、「インポート」を押してください</p>
    `;

    // モーダル表示
    UIkit.modal('#import-modal').show();

    // // インポートボタン
    document.getElementById('import-modal-submit').onclick = function() {

        // モードが'month'ならtrue、'year'ならfalse
        let mode = (Mode ==='month') ? true : false; 
        let formData = new FormData();

        // dataTypeValueはdata_typeの値（例: 'intro'など）
        formData.append('data_type', dataTypeValue);
        // 月単位インポート : true 、年単位 : false）
        formData.append('month', mode);

        fetch('import.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            UIkit.modal('#import-modal').hide();
            if (result.judge === 'success') {
                // インポート成功時のメッセージ表示
                showImportCompleteModal();
                
                // 選択されているファイルをinputからクリア
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
            } else {
                showStickyNote(result.text || 'インポートに失敗しました。');
            }
            // インポート後にdataTypeValue、Mode、modeをリセット
            dataTypeValue = ''; 
            Mode = '';
            mode = '';
        })
        .catch(error => {
            console.error('Error:', error);
            UIkit.modal('#import-modal').hide();
            showStickyNote('インポート処理で問題が発生しました。');
            dataTypeValue = ''; 
            Mode = '';
            mode = '';
        });
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
                                
                if (btnName) {
                    const dataType = btnName.split('_')[0];
                    formData.append('data_type', dataType);
                }

                // ファイルチェック
                fetch('file_check.php', {
                    method: 'POST',
                    body: formData
                })
                .then(async response => {
                    // responseの確認
                    let data;
                    try {
                        data = await response.json();
                        // data_type、modeの値をグローバル変数に格納
                        dataTypeValue = data.data_type; 
                        Mode = data.mode;
                        console.log(data);
                    } catch {
                        data = { judge: 'false', text: 'サーバーから不正な応答がありました。' };
                    }
                    if (data.judge === 'success') {
                        // 成功時：モーダル表示
                        showImportModal(data.name,data.first_year,data.latest_year,data.file_name,data.year);
                    } else {
                        // エラー時：付箋表示
                        showStickyNote(data.text || 'このファイルはインポートできません');
                    }

                })
                .catch(() => {
                    window.alert('問題が発生しました。');
                });
            
            }
        });
    });

        // バックアップボタンの確認
    $('#introBackupForm,#invIntroBackupForm,#contactBackupForm,#trainingBackupForm').on('click', function(e) {
        e.preventDefault();
        if (confirm('バックアップ時点に戻していいですか？')) {
            $(this).closest('form').submit();
        }
    });
});