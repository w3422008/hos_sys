/**
 * ページネーション機能（共通）
 * 
 * 使用方法：
 * renderPaginationCommon(currentPage, totalPages, 'pagination-top', 'pagination-bottom', 'goToPage');
 */

/**
 * ページネーションをレンダリング（共通版）
 * @param {number} currentPage - 現在のページ番号
 * @param {number} totalPages - 総ページ数
 * @param {string} containerTopId - 上部のコンテナID
 * @param {string} containerBottomId - 下部のコンテナID
 * @param {string} callbackFunctionName - ページ移動時のコールバック関数名
 */
function renderPaginationCommon(currentPage, totalPages, containerTopId, containerBottomId, callbackFunctionName) {
    const containerTop = document.getElementById(containerTopId);
    const containerBottom = document.getElementById(containerBottomId);
    
    // ★ ページが1つしかない場合は表示しない
    if(totalPages <= 1) {
        if(containerTop) containerTop.innerHTML = '';
        if(containerBottom) containerBottom.innerHTML = '';
        return;
    }

    let html = '<ul class="uk-pagination uk-flex-center">';

    // ★ 前へボタン
    if(currentPage > 1) {
        html += `<li><a href="javascript:${callbackFunctionName}(1);">«</a></li>`;
        html += `<li><a href="javascript:${callbackFunctionName}(${currentPage - 1});">‹</a></li>`;
    } else {
        html += '<li class="uk-disabled"><span>«</span></li>';
        html += '<li class="uk-disabled"><span>‹</span></li>';
    }

    // ★ ページ番号（省略表示）
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, currentPage + 2);

    // 最初のページ
    if(startPage > 1) {
        html += '<li><a href="javascript:' + callbackFunctionName + '(1);">1</a></li>';
        if(startPage > 2) {
            html += '<li class="uk-disabled"><span>...</span></li>';
        }
    }

    // 中央のページ番号
    for(let i = startPage; i <= endPage; i++) {
        if(i === currentPage) {
            html += `<li class="uk-active"><span>${i}</span></li>`;
        } else {
            html += `<li><a href="javascript:${callbackFunctionName}(${i});">${i}</a></li>`;
        }
    }

    // 最後のページ
    if(endPage < totalPages) {
        if(endPage < totalPages - 1) {
            html += '<li class="uk-disabled"><span>...</span></li>';
        }
        html += `<li><a href="javascript:${callbackFunctionName}(${totalPages});">${totalPages}</a></li>`;
    }

    // ★ 次へボタン
    if(currentPage < totalPages) {
        html += `<li><a href="javascript:${callbackFunctionName}(${currentPage + 1});">›</a></li>`;
        html += `<li><a href="javascript:${callbackFunctionName}(${totalPages});">»</a></li>`;
    } else {
        html += '<li class="uk-disabled"><span>›</span></li>';
        html += '<li class="uk-disabled"><span>»</span></li>';
    }

    html += '</ul>';
    
    // ★ 両方のコンテナに設定
    if(containerTop) containerTop.innerHTML = html;
    if(containerBottom) containerBottom.innerHTML = html;
}