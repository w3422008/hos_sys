// ★ グローバル変数
let allData = [];

/**
 * ページロード時に初期データを表示
 */
document.addEventListener('DOMContentLoaded', () => {
    loadData('');
    attachSearchListener();
});

/**
 * データを取得してカードを表示
 */
function loadData(keyword) {
    const url = `code_editor.php?ajax=1&keyword=${encodeURIComponent(keyword)}`;
    
    console.log('Fetching:', url);

    fetch(url)
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);
            
            // ★ テキストで取得してからログに出力
            return response.text();
        })
        .then(text => {
            console.log('Raw response:', text);
            
            // ★ JSONとしてパース
            try {
                const result = JSON.parse(text);
                console.log('Parsed JSON:', result);
                
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
                onclick="selectHospital('${escapeHtml(hospital.hos_cd)}')">
            <h4>${escapeHtml(hospital.hos_name)}</h4>
            <p>${escapeHtml(hospital.hos_cd)}</p>
            <p>${escapeHtml(hospital.hos_div || '不明')}</p>
            <p>${hospital.bed ? hospital.bed + '床' : '不明'}</p>
            <p>${escapeHtml(address || '不明')}</p>
        </button>
    `;

    return card;
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
