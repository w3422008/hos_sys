// ★ グローバル変数
let allData = [];
let selectedHospital = null;
let currentPage = 1;
let currentKeyword = '';
let totalPages = 1;

// ★ 医療機関コードの桁数（現在は7桁設定、桁数変更する場合はここを変更）
const hosCdlength = 7;



/**
 * ページロード時に初期データを表示
 */
document.addEventListener('DOMContentLoaded', () => {
    loadData('', 1);
    attachSearchListener();
    setupModalHandlers();
});

/**
 * データを取得してカードを表示
 */
function loadData(keyword, page = 1) {
    currentKeyword = keyword;
    currentPage = page;
    
    const url = `code_editor.php?ajax=1&keyword=${encodeURIComponent(keyword)}&page=${page}`;
    
    fetch(url)
        .then(response => response.text())
        .then(text => {
            try {
                const result = JSON.parse(text);
                
                if(!result.success) {
                    console.error('API Error:', result.error);
                    return;
                }

                allData = result.data;
                totalPages = result.total_pages;
                
                renderCards(allData);
                renderPagination(result.current_page, result.total_pages);
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
        // ★ グリッドクラスを一時的に削除
        container.classList.remove('uk-grid-match', 'uk-grid');
        container.classList.add('uk-flex', 'uk-flex-center', 'uk-flex-middle');
        container.style.minHeight = '300px';
        
        const emptyDiv = document.createElement('div');
        emptyDiv.className = 'no-results';
        emptyDiv.innerHTML = '<span>検索結果がありません</span>';
        
        container.appendChild(emptyDiv);
        // ★ 両方をクリア
        document.getElementById('pagination-container-top').innerHTML = '';
        document.getElementById('pagination-container-bottom').innerHTML = '';
        return;
    }

    // ★ グリッドクラスを復元
    container.classList.add('uk-grid-match', 'uk-grid');
    container.classList.remove('uk-flex', 'uk-flex-center', 'uk-flex-middle');
    container.style.minHeight = '';

    // ★ カードを生成
    data.forEach(hospital => {
        const card = createCard(hospital);
        container.appendChild(card);
    });
}
/**
 * ページネーションをレンダリング
 */
function renderPagination(currentPage, totalPages) {
    // ★ 共通関数を呼び出し
    renderPaginationCommon(
        currentPage, 
        totalPages, 
        'pagination-container-top', 
        'pagination-container-bottom', 
        'goToPage'
    );
}

/**
 * ページ移動
 */
function goToPage(page) {
    loadData(currentKeyword, page);
    window.scrollTo({ top: 0, behavior: 'smooth' });
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
 * 検索入力のイベントリスナー設定
 */
function attachSearchListener() {
    const searchInput = document.getElementById('search-input');

    searchInput.addEventListener('input', (e) => {
        const keyword = e.target.value;
        loadData(keyword, 1); // ★ 検索時は1ページ目に戻す
    });
}

/**
 * モーダルイベントハンドラーの設定
 */
function setupModalHandlers() {
    const confirmBtn = document.getElementById('modal-confirm-btn');
    const cancelBtn = document.getElementById('modal-cancel-btn');

    if(confirmBtn) {
        confirmBtn.addEventListener('click', () => {
            // 旧医療機関コードと新医療機関コードを取得
            const oldHosCd = selectedHospital ? selectedHospital.hos_cd : null;
            const hosCd = document.getElementById('modal-hos-cd-input').value.trim();
                        
            // 医療機関コードが入力されていない場合
            if(!hosCd) {
                alert('医療機関コードを入力してください');
                return;
            }

            // 医療機関コードの桁数チェック
            if(hosCd.length !== hosCdlength) {
                alert(`医療機関コードは${hosCdlength}桁以内にしてください。`);
                return;
            }
            
            // ここで医療機関コードに紐づいたデータを取得・セッション保存を行う処理を追加
            fetch(`data_to_session.php?old_hospital_code=${encodeURIComponent(oldHosCd)}&hospital_code=${encodeURIComponent(hosCd)}`)
                .then(response => response.json())
                .then(result => {
                    if(!result.success) {
                        alert(result.error);
                        return;
                    }
                    
                    // ★ 登録フォームへ遷移（パスは環境に合わせて調整）
                    window.location.href = `../insert/insert_control.php?code_editor=1`;

                })
                .catch(error => {
                    console.error('Error saving hospital code:', error);
                    alert('通信エラーが発生しました');
                    return;
                });
        });
    }

    if(cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            UIkit.modal('#hospital-modal').hide();
        });
    }
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