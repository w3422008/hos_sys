// ★ グローバル変数
let currentPage = 1;
let searchKeyword = initialSearchKeyword || "";
let statusFilter = initialStatusFilter || "ALL";
let perPage = 5;

// ★ 初期化（ページロード時）
document.addEventListener("DOMContentLoaded", () => {
  // 表示件数セレクトボックスのイベントリスナーを設定
  const perPageSelect = document.getElementById("per-page-select");
  if (perPageSelect) {
    perPageSelect.addEventListener("change", (e) => {
      const value = e.target.value;
      perPage = value === "all" ? 99999 : parseInt(value);
      currentPage = 1;
      renderTable();
    });
  }

  renderTable();
  attachEventListeners();
});

/**
 * テーブルをレンダリング（共通関数を使用）
 */
function renderTable() {
  const perPageNum = isNaN(perPage) ? 5 : parseInt(perPage);

  fetchAndRenderTable(
    "user_MT_control.php",
    {
      ajax: 1,
      keyword: searchKeyword,
      status: statusFilter,
      page: currentPage,
      per_page: perPageNum,
    },
    "user-table-body",
    createUserRow,
    (result) => {
      // 成功時のコールバック
      renderPagination(result.total_pages, result.current_page);
      document.getElementById("result-count").textContent =
        `検索結果: ${result.total}件`;
    },
  );
}

/**
 * ユーザー行を作成
 */
function createUserRow(user) {
  const row = document.createElement("tr");

  // ステータスに応じたクラス
  if (user.onf === "1") {
    row.className = "hide-tbl-bgd";
    row.setAttribute("uk-tooltip", "title:停止中ユーザ; pos: top-left");
  } else {
    row.setAttribute("uk-tooltip", "title:利用中ユーザ; pos: top-left");
  }

  // ステータスアイコン
  let statusIcon = "";
  if (user.onf === "1") {
    statusIcon = '<i class="fas fa-lock"></i>';
  }

  // 権限ラベル（ここは既存の関数を使用）
  const admLabel = getAdmLabelHtml(user.adm_user);

  // 施設・所属情報
  const facilityInfo = getFacilityInfo(user.ins, user.bel, departments);

  // 履歴情報
  let historyHtml = "";
  if (user.onf === "0") {
    historyHtml = `
                    <div>開始日：${user.start}</div>
                    <div>変更日：${user.up_date}</div>
                `;
  } else {
    historyHtml = `<div>利用停止日：${user.end}</div>`;
  }

  // アクションボタン
  let actionHtml = "";
  if (user.onf === "0") {
    actionHtml = `
                    <a class="uk-button"><i class="fas fa-ellipsis-h fa-lg"></i></a>
                    <div class="uk-width-small" uk-dropdown="mode: click">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="update.php?id=${user.user_id}"><i class="fas fa-user-edit fa-lg"></i> 変更</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="hide.php?id=${user.user_id}"><i class="fas fa-user-slash fa-lg"></i> 利用停止</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="clear.php?id=${user.user_id}"><i class="fas fa-key fa-lg"></i> パスワード初期化</a></li>
                        </ul>
                    </div>
                `;
  } else {
    actionHtml = `
                    <a class="uk-button"><i class="fas fa-ellipsis-h fa-lg"></i></a>
                    <div class="uk-width-small" uk-dropdown="mode: click">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="undoing.php?id=${user.user_id}"><i class="fas fa-lock-open fa-lg"></i> 停止解除</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="deleate.php?id=${user.user_id}"><i class="far fa-trash-alt fa-lg"></i> 削除</a></li>
                        </ul>
                    </div>
                `;
  }

  row.innerHTML = `
                <td>${statusIcon}</td>
                <td><i class="fas fa-user-circle fa-2x" style="color:#aaa;"></i></td>
                <td>${admLabel}</td>
                <td>
                    <div><label>ID：</label><u>${htmlEscape(user.user_id)}</u></div>
                    <div style="font-size:1.2em;">${htmlEscape(user.user_name)}</div>
                </td>
                <td class="uk-text-truncate">
                    <div>${facilityInfo.facility}</div>
                    <div>（${facilityInfo.department}）</div>
                </td>
                <td>${historyHtml}</td>
                <td>${actionHtml}</td>
            `;

  return row;
}

/**
 * ページネーション表示
 */
function renderPagination(totalPages, currentPage) {
  // ★ 共通関数を呼び出し
  renderPaginationCommon(
    currentPage,
    totalPages,
    "pagination-top",
    "pagination-bottom",
    "goToPage",
  );
}

/**
 * ページ移動
 */
function goToPage(page) {
  currentPage = page;
  goToPageCommon(page, () => {
    renderTable();
  });
  return false;
}

/**
 * イベントリスナー設定（共通関数を使用）
 */
function attachEventListeners() {
  setupSearchFilterListeners({
    searchInputId: "search-keyword",
    filterSelectIds: ["status-filter"],
    onFilterChange: () => {
      // 検索キーワードとステータスフィルターを更新
      searchKeyword = document.getElementById("search-keyword").value;
      statusFilter = document.getElementById("status-filter").value;
      renderTable();
    },
    resetPageCallback: () => {
      currentPage = 1;
    },
  });
}

/**
 * 権限ラベル取得（PHP側の関数と同等）
 */
function getAdmLabelHtml(admUser) {
  let label = "";
  if (admUser === "3") {
    label = '<span class="uk-label SysAdmin">システム管理者</span>';
  } else if (admUser === "1") {
    label = '<span class="uk-label uk-label-danger">管理者</span>';
  } else if (admUser === "2") {
    label = '<span class="uk-label uk-label-warning">一般（事務）</span>';
  } else {
    label = '<span class="uk-label">一般</span>';
  }
  return label;
}

/**
 * 施設・所属情報取得
 */
function getFacilityInfo(ins, bel, departments) {
  const facilities = {
    0: "附属病院",
    1: "総合医療センター",
    2: "高齢者医療センター",
  };
  return {
    facility: facilities[ins] || "不明",
    department: (departments[ins] && departments[ins][bel]) || "不明",
  };
}
