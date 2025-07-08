// マニュアルモーダルを開く
document.addEventListener('DOMContentLoaded', function() {
    const manualBtn = document.getElementById('manual-btn');
    if (manualBtn) {
        manualBtn.addEventListener('click', function() {
            UIkit.modal('#manual-modal').show();
        });
    }
});

// キーボードショートカットでマニュアルモーダルを開く
document.addEventListener('keydown', function(e) {
    // F1キーでマニュアルモーダルを開く
    if (e.key === 'F1') {
        e.preventDefault(); // ブラウザのデフォルト動作を無効化
        var manualBtn = document.getElementById('manual-btn');
        if (manualBtn) manualBtn.click();
    }
});