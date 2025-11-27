// グローバル変数
// data_typeの値を格納する変数
let dataTypeValue = '';
// モードを格納する変数（例: 'year'や'month'など）
let Mode = '';

// 対象となるエリアとinputのIDを配列で管理
const fileAreas = [
    // 紹介データ
    { area: '#file_drag_drop_area_intro_month', input: '#myFile_intro_month', label: '#fileName_intro_month', button: '#customFileBtn_intro_month' },
    // 逆紹介データ
    { area: '#file_drag_drop_area_invintro_month', input: '#myFile_invintro_month', label: '#fileName_invintro_month', button: '#customFileBtn_invintro_month' },
    // コンタクト履歴データ
    { area: '#file_drag_drop_area_contact_month', input: '#myFile_contact_month', label: '#fileName_contact_month', button: '#customFileBtn_contact_month' },
    // 兼業データ
    { area: '#file_drag_drop_area_training', input: '#myFile_training', label: '#fileName_training', button: '#customFileBtn_training' }
];

$(function() {

    // ドラッグ＆ドロップエリア内のボタンクリック時の動作
    // 紹介データ
    document.getElementById('customFileBtn_intro_month').addEventListener('click', function() {
        document.getElementById('myFile_intro_month').click();
    });
    
    // 逆紹介データ
    document.getElementById('customFileBtn_invintro_month').addEventListener('click', function() {
        document.getElementById('myFile_invintro_month').click();
    });


    // コンタクト履歴データ
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
                performFileCheck(formData);
            
            }
        });
    });

    // バックアップボタンと対応するデータ
    const backupBtnMap = [
        {
            btn: '#introBackupForm',
            date: 'IntroLatestBackup',
            key: 'BK_intro',
            title: '紹介'
        },
        {
            btn: '#invIntroBackupForm',
            date: 'InvIntroLatestBackup',
            key: 'BK_invers_intro',
            title: '逆紹介'
        },
        {
            btn: '#contactBackupForm',
            date: 'ContactLatestBackup',
            key: 'BK_contact',
            title: 'コンタクト履歴'
        },
        {
            btn: '#trainingBackupForm',
            date: 'TrainingLatestBackup',
            key: 'BK_training',
            title: '兼業'
        }
    ];

    backupBtnMap.forEach(function(item) {

        // バックアップファイル一覧を取得
        const backupFiles = window.folderFiles[item.key] || [];

        // ★ ファイル一覧をログ形式に変換
        const formattedFiles = formatBackupFileList(backupFiles);

        const latestBackupYear = document.getElementById(item.date);
        if (latestBackupYear && formattedFiles.length > 0) {
            // 最新のバックアップ日時を表示
            latestBackupYear.textContent = formattedFiles[0].date + ' ' + formattedFiles[0].time;
        }else{
            latestBackupYear.textContent = 'なし';
        }

        $(item.btn).on('click', function(e) {
            e.preventDefault();
            // モーダルタイトル
            $('#backup-modal-title').text("バックアップ一覧（" + item.title + "）");
            
            const backupList = document.getElementById('backup-list');
            backupList.innerHTML = '';
            if (formattedFiles.length === 0) {
                // ボタン形式のエントリを作成
                const entryDiv = document.createElement('div');
                entryDiv.className = 'backup-empty-text';
                entryDiv.innerHTML = '<p class="backup-empty-text">バックアップファイルはありません。</p>';
                backupList.appendChild(entryDiv);

            } else {

                // ★ ボタン形式のリスト作成
                formattedFiles.forEach(function(fileInfo, index) {
                    // ボタン形式のエントリを作成
                    const entryDiv = document.createElement('div');
                    entryDiv.className = 'backup-entry';
                    
                    // ボタン内容
                    entryDiv.innerHTML = `
                        <div class="backup-content">
                            <div class="backup-info">
                                <div class="backup-icon">
                                    <span uk-icon="icon: database; ratio: 1.2"></span>
                                </div>
                                <div class="backup-details">
                                    <div class="backup-datetime">${fileInfo.date} ${fileInfo.time}</div>
                                    <div class="backup-user">ユーザーID: ${fileInfo.userId}</div>
                                </div>
                            </div>
                            <div class="backup-arrow">
                                <span uk-icon="icon: chevron-down"></span>
                            </div>
                        </div>
                        <div class="backup-dropdown">
                            <div class="backup-buttons">

                                <a class="backup-download-btn uk-button uk-button-primary uk-button-small" 
                                href="./${item.key}/${encodeURIComponent(fileInfo.originalName)}" 
                                download="${fileInfo.originalName}">
                                    <span uk-icon="icon: download; ratio: 0.8"></span> ダウンロード
                                </a>
                            </div>
                        </div>
                    `;
                    
                    backupList.appendChild(entryDiv);
                });
                
            }
            UIkit.modal('#backup-modal').show();

            // エントリクリック時のドロップダウン表示
            $('#backup-list .backup-entry').off('click').on('click', function(e) {
                e.preventDefault();
                const dropdown = $(this).find('.backup-dropdown');
                const arrow = $(this).find('.backup-arrow span');
                
                // 他のドロップダウンを閉じる
                $('#backup-list .backup-dropdown').not(dropdown).hide();
                $('#backup-list .backup-arrow span').not(arrow).css('transform', 'rotate(0deg)');
                
                // 現在のドロップダウンをトグル
                dropdown.toggle();
                const isOpen = dropdown.is(':visible');
                arrow.css('transform', isOpen ? 'rotate(180deg)' : 'rotate(0deg)');
            });

            // ダウンロードボタンのイベント（クリック伝播を停止）
            $('#backup-list .backup-download-btn').off('click').on('click', function(e) {
                e.stopPropagation(); // 親要素のクリックイベントを停止
            });
        });
    });
    
    // バックアップモーダル閉じるボタン
    $('#close-backup-modal').on('click', function() {
    UIkit.modal('#backup-modal').hide();
    });

});