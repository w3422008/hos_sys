// ★ グローバル変数
let allData = [];
let selectedHospital = null;

/**
 * ページロード時に初期データを表示
 */
document.addEventListener('DOMContentLoaded', () => {
    loadData('');
    attachSearchListener();
    setupModalHandlers();
});

/**
 * モーダルイベントハンドラーの設定
 */
function setupModalHandlers() {
    const confirmBtn = document.getElementById('modal-confirm-btn');
    const cancelBtn = document.getElementById('modal-cancel-btn');

    if(confirmBtn) {
        confirmBtn.addEventListener('click', () => {
            const oldHosCd = selectedHospital ? selectedHospital.hos_cd : null;
            const hosCd = document.getElementById('modal-hos-cd-input').value.trim();
            
            if(!hosCd) {
                alert('医療機関コードを入力してください');
                return;
            }
            
            // ここで医療機関コードに紐づいたデータを取得・セッション保存を行う処理を追加
            fetch(`data_to_session.php?old_hospital_code=${encodeURIComponent(oldHosCd)}&hospital_code=${encodeURIComponent(hosCd)}`)
                .then(response => response.json())
                .then(result => {
                    if(!result.success) {
                        alert('医療機関コードの保存に失敗しました: ' + result.error);
                        return;
                    }
                })
                .catch(error => {
                    console.error('Error saving hospital code:', error);
                    alert('通信エラーが発生しました');
                    return;
                });

            // ★ 登録フォームへ遷移（パスは環境に合わせて調整）
            window.location.href = `../insert/insert_control.php?code_editor=1`;
            
            // モーダルを閉じてページをリロード（サーバー処理を少し待つ）
            // UIkit.modal('#hospital-modal').hide();
            // setTimeout(() => {
            //     window.location.reload();
            // }, 300);
        });
    }

    if(cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            UIkit.modal('#hospital-modal').hide();
        });
    }
}

/**
 * データを取得してカードを表示
 */
function loadData(keyword) {
    const url = `code_editor.php?ajax=1&keyword=${encodeURIComponent(keyword)}`;
    
    fetch(url)
        .then(response => {

            // ★ テキストで取得してからログに出力
            return response.text();

        })
        .then(text => {

            // ★ JSONとしてパース
            try {
                const result = JSON.parse(text);
                
                if(!result.success) {
                    console.error('API Error:', result.error);
                    return;
                }

                allData = result.data;
                renderCards(allData);
            } catch(e) {
                console.error('JSON Parse Error:', e);
                console.error('Failed text:', text);
            }
        })
        .catch(error => {
            console.error('Fetch Error:', error);
        });
}

/**
 * カードをレンダリング
 */
function renderCards(data) {
    const container = document.getElementById('cards-container');
    container.innerHTML = '';

    // ★ データが空の場合
    if(!data || data.length === 0) {
        container.innerHTML = '<div class="no-results" style="grid-column: 1 / -1;">検索結果がありません</div>';
        return;
    }

    // ★ カードを生成
    data.forEach(hospital => {
        const card = createCard(hospital);
        container.appendChild(card);
    });
}

/**
 * カード要素を作成
 */
function createCard(hospital) {
    const card = document.createElement('div');

    // ★ 住所を組み立て
    const address = `${hospital.pre || ''}${hospital.area || ''}${hospital.town || ''}${hospital.str_num || ''}`;

    card.innerHTML = `
        <button class="card-button uk-button uk-button-default uk-width-1-1"
                onclick="openHospitalModal(event)">
            <p>${escapeHtml(hospital.hos_cd)}</p>
            <h4>${escapeHtml(hospital.hos_name)}</h4>
            <p>${escapeHtml(hospital.hos_div || '不明')}　病床数：${hospital.bed ? hospital.bed + '床' : '不明'}</p>
            <p>${escapeHtml(address || '不明')}</p>
        </button>
    `;

    // ★ データ属性にJSON形式で医療機関情報を設定
    card.querySelector('.card-button').dataset.hospital = JSON.stringify(hospital);

    return card;
}

/**
 * ★ 医療機関情報モーダルを開く
 */
function openHospitalModal(event) {
    const button = event.target.closest('.card-button');
    const hospitalData = JSON.parse(button.dataset.hospital);
    
    selectedHospital = hospitalData;
    
    // ★ モーダルに情報を設定
    document.getElementById('modal-hos-cd').textContent = escapeHtml(hospitalData.hos_cd);
    document.getElementById('modal-hos-name').textContent = escapeHtml(hospitalData.hos_name);
    document.getElementById('modal-hos-div').textContent = escapeHtml(hospitalData.hos_div || '不明');
    document.getElementById('modal-hos-bed').textContent = hospitalData.bed ? hospitalData.bed + '床' : '不明';
    
    const address = `${hospitalData.pre || ''}${hospitalData.area || ''}${hospitalData.town || ''}${hospitalData.str_num || ''}`;
    document.getElementById('modal-hos-address').textContent = escapeHtml(address || '不明');
    
    // ★ モーダルを表示
    UIkit.modal('#hospital-modal').show();
}

/**
 * 医療機関を選択
 */
function selectHospital(hosCd) {
    console.log('Selected:', hosCd);
    // ★ ここに選択後の処理を記述
    // 例：
    // window.location.href = `edit.php?hos_cd=${hosCd}`;
}

/**
 * 検索入力のイベントリスナー設定
 */
function attachSearchListener() {
    const searchInput = document.getElementById('search-input');

    searchInput.addEventListener('input', (e) => {
        const keyword = e.target.value;
        loadData(keyword);
    });
}

/**
 * HTML特殊文字をエスケープ
 */
function escapeHtml(text) {
    if(!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}