/**
 * フォームの正規表現パターン検証
 */

document.addEventListener('DOMContentLoaded', function() {
    const validationForm = document.querySelector('.validationForm');
    
    if (!validationForm) return;

    const patternElems = document.querySelectorAll('.pattern');

    validationForm.addEventListener('submit', (e) => {
        // エラーの初期化
        const errorElems = e.currentTarget.querySelectorAll('.error');
        errorElems.forEach( (elem) => {
            elem.remove(); 
        });

        // .pattern を指定した要素のパターンを検証
        patternElems.forEach( (elem) => {
            //data-pattern 属性の値を取得
            let dataPattern = elem.getAttribute('data-pattern');
            //正規表現パターンを格納する変数
            let pattern;
            //デフォルトのエラーメッセージ
            let errorMessage = '入力形式が正しくありません';

            // パターン別の正規表現設定
            switch(dataPattern) {
                case 'tel':
                    pattern = /^[0-9\-]{10,}$/;
                    errorMessage = '電話番号の形式が正しくありません（例：090-1234-5678）';
                    break;
                case 'zip':
                    pattern = /^[0-9]{3}-?[0-9]{4}$/;
                    errorMessage = '郵便番号の形式が正しくありません（例：123-4567）';
                    break;
                case 'email':
                    pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    errorMessage = 'メールアドレスの形式が正しくありません';
                    break;
                default:
                    return;
            }

            // パターンチェック
            if(elem.value !== '' && !pattern.test(elem.value)) {
                createError(elem, errorMessage);
            }
        });
    });
});

// エラーメッセージを表示する関数
const createError = (elem, errorMessage) => {
    const errorSpan = document.createElement('span');
    errorSpan.classList.add('error');
    errorSpan.setAttribute('aria-live', 'polite');
    errorSpan.textContent = errorMessage;
    elem.parentNode.appendChild(errorSpan);
}