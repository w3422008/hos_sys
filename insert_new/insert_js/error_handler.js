/**
 * エラーメッセージの生成と表示管理
 */

/**
 * エラーメッセージを表示する span 要素を生成して親要素に追加する関数
 * @param {HTMLElement} elem - エラーを表示する対象要素
 * @param {string} errorMessage - 表示するエラーメッセージ
 */
const createError = (elem, errorMessage) => {
  // 既存のエラーを削除
  const existingError = elem.parentNode.querySelector(".error");
  if (existingError) {
    existingError.remove();
  }

  // 新しいエラー要素を作成
  const errorSpan = document.createElement("span");
  errorSpan.classList.add("error");
  errorSpan.setAttribute("aria-live", "polite");
  errorSpan.setAttribute("role", "alert");
  errorSpan.textContent = errorMessage;

  elem.parentNode.appendChild(errorSpan);
};

/**
 * エラーメッセージをクリアする関数
 * @param {HTMLElement} elem - 対象要素
 */
const clearError = (elem) => {
  const errorSpan = elem.parentNode.querySelector(".error");
  if (errorSpan) {
    errorSpan.remove();
  }
};

/**
 * すべてのエラーメッセージをクリアする関数
 * @param {string} formSelector - フォームセレクタ
 */
const clearAllErrors = (formSelector) => {
  const form = document.querySelector(formSelector);
  if (form) {
    const errorElems = form.querySelectorAll(".error");
    errorElems.forEach((elem) => {
      elem.remove();
    });
  }
};
