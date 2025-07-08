function showCsvModal(csvId, title) {
    showLoadingCursor(); // ここでwaitカーソル

    // テーブルHTMLをhiddenから取得してモーダルへ
    var html = document.getElementById(csvId).innerHTML;
    document.getElementById('csv-modal-subtitle').textContent = title;
    document.getElementById('csv-modal-content').innerHTML = html;
    UIkit.modal('#csv-modal').show();
    
    hideLoadingCursor(); // モーダル表示後に戻す
}

function showLoadingCursor() {
    document.body.style.cursor = 'wait';
}
function hideLoadingCursor() {
    document.body.style.cursor = '';
}

