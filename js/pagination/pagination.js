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
function renderPaginationCommon(
  currentPage,
  totalPages,
  containerTopId,
  containerBottomId,
  callbackFunctionName,
) {
  const containerTop = document.getElementById(containerTopId);
  const containerBottom = document.getElementById(containerBottomId);

  // ★ ページが1つしかない場合は表示しない
  if (totalPages <= 1) {
    if (containerTop) containerTop.innerHTML = "";
    if (containerBottom) containerBottom.innerHTML = "";
    return;
  }

  let html = '<ul class="uk-pagination uk-flex-center">';

  // ★ 前へボタン
  if (currentPage > 1) {
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
  if (startPage > 1) {
    html +=
      '<li><a href="javascript:' + callbackFunctionName + '(1);">1</a></li>';
    if (startPage > 2) {
      html += '<li class="uk-disabled"><span>...</span></li>';
    }
  }

  // 中央のページ番号
  for (let i = startPage; i <= endPage; i++) {
    if (i === currentPage) {
      html += `<li class="uk-active"><span>${i}</span></li>`;
    } else {
      html += `<li><a href="javascript:${callbackFunctionName}(${i});">${i}</a></li>`;
    }
  }

  // 最後のページ
  if (endPage < totalPages) {
    if (endPage < totalPages - 1) {
      html += '<li class="uk-disabled"><span>...</span></li>';
    }
    html += `<li><a href="javascript:${callbackFunctionName}(${totalPages});">${totalPages}</a></li>`;
  }

  // ★ 次へボタン
  if (currentPage < totalPages) {
    html += `<li><a href="javascript:${callbackFunctionName}(${currentPage + 1});">›</a></li>`;
    html += `<li><a href="javascript:${callbackFunctionName}(${totalPages});">»</a></li>`;
  } else {
    html += '<li class="uk-disabled"><span>›</span></li>';
    html += '<li class="uk-disabled"><span>»</span></li>';
  }

  html += "</ul>";

  // ★ 両方のコンテナに設定
  if (containerTop) containerTop.innerHTML = html;
  if (containerBottom) containerBottom.innerHTML = html;
}

/**
 * HTML特殊文字をエスケープ（XSS対策）
 * @param {string} text - エスケープする文字列
 * @returns {string} エスケープ済みテキスト
 */
function htmlEscape(text) {
  const div = document.createElement("div");
  div.textContent = text;
  return div.innerHTML;
}

/**
 * ページ移動時の共通処理（スクロール + テーブル更新）
 * @param {number} page - 移動先のページ番号
 * @param {Function} renderFunction - テーブル更新関数
 * @param {Object} options - オプション設定
 *   - smooth: スクロールを滑らかにするか（デフォルト: true）
 *   - scrollTarget: スクロール対象要素のセレクタ（デフォルト: 'main'）
 */
function goToPageCommon(page, renderFunction, options = {}) {
  const { smooth = true, scrollTarget = "main" } = options;

  // ページをスクロール
  const element = document.querySelector(scrollTarget) || window;
  window.scrollTo({
    top: 0,
    behavior: smooth ? "smooth" : "auto",
  });

  // テーブルをレンダリング
  if (typeof renderFunction === "function") {
    renderFunction(page);
  }

  return false;
}

/**
 * 検索・フィルター入力イベントの自動設定
 * @param {Object} config - 設定オブジェクト
 *   - searchInputId: 検索入力要素のID
 *   - filterSelectIds: フィルターセレクト要素のID配列
 *   - onFilterChange: フィルター変更時のコールバック関数
 *   - resetPageCallback: ページ番号をリセットする関数
 */
function setupSearchFilterListeners(config) {
  const { searchInputId, filterSelectIds, onFilterChange, resetPageCallback } =
    config;

  // 検索入力のイベントリスナー
  if (searchInputId) {
    const searchInput = document.getElementById(searchInputId);
    if (searchInput) {
      searchInput.addEventListener("input", (e) => {
        if (resetPageCallback) resetPageCallback();
        if (onFilterChange) onFilterChange();
      });
    }
  }

  // フィルターセレクトのイベントリスナー
  if (filterSelectIds && Array.isArray(filterSelectIds)) {
    filterSelectIds.forEach((selectId) => {
      const select = document.getElementById(selectId);
      if (select) {
        select.addEventListener("change", (e) => {
          if (resetPageCallback) resetPageCallback();
          if (onFilterChange) onFilterChange();
        });
      }
    });
  }
}

/**
 * AJAX でテーブルデータを取得し、レンダリング
 * @param {string} url - APIのURL（URLパラメータを含まない）
 * @param {Object} params - URLパラメータオブジェクト { keyword: '...', status: '...', page: 1, per_page: 10 }
 * @param {string} tbodyId - テーブルボディのID
 * @param {Function} rowCreator - 行を作成する関数（ユーザーが定義）
 * @param {Function} onSuccess - 成功時のコールバック（result を引数に受け取る）
 */
function fetchAndRenderTable(url, params, tbodyId, rowCreator, onSuccess) {
  // URLパラメータを構築
  const queryString = new URLSearchParams(params).toString();
  const fullUrl = url.includes("?")
    ? `${url}&${queryString}`
    : `${url}?${queryString}`;

  fetch(fullUrl)
    .then((response) => response.json())
    .then((result) => {
      if (!result.success) {
        console.error("API returned false:", result.error);
        return;
      }

      const tbody = document.getElementById(tbodyId);
      if (!tbody) {
        console.error(`Table body element with id '${tbodyId}' not found`);
        return;
      }

      tbody.innerHTML = "";

      // データが配列であることを確認
      if (!Array.isArray(result.data)) {
        console.error("result.data is not an array:", result.data);
        tbody.innerHTML =
          '<tr><td colspan="100%" class="uk-text-center">データ形式エラー</td></tr>';
        return;
      }

      // データが空の場合
      if (result.data.length === 0) {
        tbody.innerHTML =
          '<tr><td colspan="100%" class="uk-text-center">データがありません</td></tr>';
        return;
      }

      // 行を生成
      result.data.forEach((item, index) => {
        try {
          const row = rowCreator(item);
          tbody.appendChild(row);
        } catch (e) {
          console.error(`Error creating row ${index}:`, e);
        }
      });

      // 成功時のコールバック
      if (typeof onSuccess === "function") {
        onSuccess(result);
      }
    })
    .catch((error) => {
      console.error("Fetch Error:", error);
      const tbody = document.getElementById(tbodyId);
      if (tbody) {
        tbody.innerHTML = `<tr><td colspan="100%" class="uk-text-center uk-text-danger">エラー: ${error.message}</td></tr>`;
      }
    });
}
