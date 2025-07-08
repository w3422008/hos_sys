// 緊急、可否、対応状況情報を初期化・配列化
let emerg_class=[];
let adv = [];
let supp = [];
// 依頼者情報を初期化・配列化
let alldata = [];
// フィルタリング用データを初期化・配列化
let fil_data = [];

// 依頼データ取得・表示
window.onload = function () {
    $.ajax({
        url: 'ajax/get_que_datails.php',
        type: 'POST',
        data: {
            adm_id: adm_id,
            user_id: user_id
        },
        success: function (data) {
            // 画面表示
            alldata = JSON.parse(data);

            // 生成するテーブルの要素を取得
            const tableHead = document.getElementById("history_thead");
            const tableBody = document.getElementById("history_tbody");

            if (alldata.length > 0) {
                
                // データがある場合
                // ↓ thead表示 ↓ ------------------------------------------------
                
                // tr要素を作成
                const h_row = document.createElement("tr");

                // 共通　：（緊急）、依頼日、対応可否、対応状況、詳細ボタン
                // 依頼者：依頼内容
                // 管理者：施設名、名前

                h_row.innerHTML = `
                    <th class="th_width"></th><!-- 緊急 -->
                    <th class="odate">依頼日</th> 
                    ${adm_id == 3 ? `
                    <th class="th_facility">施設名</th>
                    <th class="th_name">名前</th>
                    ` : `
                    <th class="content_th">依頼内容</th>
                    `}
                    <th class="text-center advisab_status">可否</th>
                    <th class="text-center advisab_status">対応状況</th>
                    <th class="th_filter">
                        <!-- フィルター機能トグルボタン -->
                        <div class="text-center" style="position: relative; text-align: right;">
                            <button class="uk-button filter-toggle-button" id="toggleFilterButton">
                                <i class="fa-solid fa-filter"></i>
                            </button>
                            <!-- ハンバーガーメニュー形式のフィルター -->
                            <div class="filter-modal" id="filterContainer" style="display: none;">

                                <p>緊急度</p>
                                <div class="filter-options"> 
                                    <input class="uk-checkbox" type="checkbox" id="filterUrgent" checked>
                                    <label for="filterUrgent" class="Urgentlabel">緊急</label>
                                    <button class="allClear" id="clearFilterButton">選択を<br>クリア</button>
                                </div>
                                <hr>
                                <p>対応可否</p>
                                <div class="filter-options">
                                    <input class="uk-checkbox" type="checkbox" id="filterNotLook" checked>
                                    <label for="filterNotLook" class="NotLooklabel">未確認</label>
                                    <input class="uk-checkbox" type="checkbox" id="filterPoss" checked>
                                    <label for="filterPoss" class="Posslabel">対応可</label>
                                    <input class="uk-checkbox" type="checkbox" id="filterImPoss" checked>
                                    <label for="filterImPoss" class="ImPosslabel">不可</label>
                                </div>
                                <hr>
                                <p>対応状況</p>
                                <div class="filter-options">
                                    <input class="uk-checkbox" type="checkbox" id="filterBacklog" checked>
                                    <label for="filterBacklog" class="backloglabel">未対応</label>
                                    <input class="uk-checkbox" type="checkbox" id="filterWIP" checked>
                                    <label for="filterWIP" class="WIPlabel">対応中</label>
                                    <input class="uk-checkbox" type="checkbox" id="filterClosed">
                                    <label for="filterClosed" class="Closedlabel">対応済</label>
                                </div>
                            </div>
                        </div>
                    </th>
                `;

                // view画面へHTMLを挿入
                tableHead.appendChild(h_row);

                // ↑ thead表示 ↑ ------------------------------------------------

                // filtering（alldataより「対応済」を非表示）
                fil_data = alldata.filter(a => a.supp_status != 2);

                fil_data.forEach((item, i) => {

                    // ↓ テーブル内表示 ↓ ------------------------------------------------

                    // 新たな行を作成
                    const b_row = document.createElement("tr");                    

                    // 緊急/通常(アイコン表示)
                    emerg_class[i] = ""; 
                    if (item.emerg == 1) {
                        // 緊急アイコン class付与
                        emerg_class[i] = add_class();
                    }

                    // 可否(データにより表示切替)
                    adv[i] = "";
                    adv[i] = adv_judge(item.advisability);
                    // 状況(データにより表示切替)
                    supp[i] = "";
                    supp[i] = supp_judge(item.advisability, item.supp_status); 

                    // ↓ tbody表示 ↓ ------------------------------------------------

                    b_row.innerHTML = `
                        <!-- 緊急度 -->
                        <td class="text-center">
                            <i id="td_emerg" class="${emerg_class[i]}"></i>
                        </td>

                        <!-- 依頼日 -->
                        <td>${item.order_date}</td>

                        ${adm_id == 3 ? `
                            <td class="td_facility">${change_hos(item.hospital)}) ${change_bel(item.division,item.hospital)}</td>
                            <!-- 名前 -->
                            <td class="name_num">${html_escape(item.name)}</td>
                        ` : `
                            <!-- 依頼内容 -->
                            <td id="td_content" class="odate_td">${content_cut(item.content)}</td>
                        `}

                        <!-- 対応可否 -->
                        <!-- 未確認：黄、対応可：青、対応不可：赤 -->
                        <td class="text-center"><label id="td_advis" class="${adv[i][0]}">${adv[i][2]}</label></td>

                        <!-- 状況 -->
                        <!-- 対応可：対応状況表示(未対応：黄、対応中：緑、対応済：青)、対応不可： - (状況表示×) -->
                        <td class="text-center"><label id="td_status" class="${supp[i][0]}">${supp[i][2]}</label></td>

                        <td class="text-center">
                            <button id="showModal" class="uk-button uk-button-details" data-index="${i}">詳細</button>
                        </td>
                    `;

                    // view画面へHTMLを挿入
                    tableBody.appendChild(b_row);

                    // ↑ tbody表示 ↑ ------------------------------------------------

                });

            } else {

                // データがない場合
                $('#history_table').hide();
                UIkit.modal('#noDataModal').show();
                // モーダルの内容を設定
                // 管理者なら「」、依頼者なら「」
            }

        },
        error: function (xhr, status, error) {
            console.error('Error: ' + error);
        }
    });
};

// フィルタリング機能
document.addEventListener("DOMContentLoaded", function (event) {

    const toggleButton = document.getElementById("toggleFilterButton");
    const filterContainer = document.getElementById("filterContainer");

    // トグルボタンのクリックイベント
    document.addEventListener("click", function (event) {
        if (event.target && event.target.id === "toggleFilterButton") {
            const filterContainer = document.getElementById("filterContainer");
            if (filterContainer.style.display === "none" || filterContainer.style.display === "") {
                filterContainer.style.display = "block"; // モーダルを表示
            } else {
                filterContainer.style.display = "none"; // モーダルを非表示
            }
        }
    });

    // クリアボタンのクリックイベント
    document.addEventListener("click", function (event) {
    
        if (event.target && event.target.id === "clearFilterButton") {
            // クリアボタンのクリックイベント
            const checkboxes = document.querySelectorAll(".filter-modal input[type='checkbox']");
            checkboxes.forEach(checkbox => {
                checkbox.checked = false; // すべてのチェックを解除
            });
    
            // フィルタリングを再適用
            applyFilter();
        }
    });

// ---------------------------------------------------------------------
// フィルタリング機能（要修正）

    document.addEventListener("click", function (event) {
        if (event.target && event.target.matches(".filter-modal input[type='checkbox']")) {
            applyFilter();
        }
    });

    // フィルターを適用する関数
    function applyFilter() {
        // テーブル書き込み用
        const tableBody = document.getElementById("history_tbody");

        // テーブルの全行をクリア
        tableBody.innerHTML = "";
        
        // 緊急、対応可否、対応状況 class初期化
        emerg_class = [];
        adv = [];
        supp = [];

        // フィルタリング条件を取得
        const isUrgentChecked = document.getElementById("filterUrgent").checked;
        const isBacklogChecked = document.getElementById("filterBacklog").checked;
        const isWIPChecked = document.getElementById("filterWIP").checked;
        const isClosedChecked = document.getElementById("filterClosed").checked;
        const isNotHandledChecked = document.getElementById("filterNotLook").checked;
        const isHandledChecked = document.getElementById("filterPoss").checked;
        const isImpossibleChecked = document.getElementById("filterImPoss").checked;

        // フィルタリング処理
        const filteredData = alldata.filter(item => {
            const matchesUrgency =
                (isUrgentChecked && item.emerg == 1);
            const matchesStatus =
                (isBacklogChecked && item.supp_status == 0 && item.advisability == 0) ||
                (isWIPChecked && item.supp_status == 1) ||
                (isClosedChecked && item.supp_status == 2);
            const matchesNewStatus =
                (isNotHandledChecked && item.advisability == null) ||
                (isHandledChecked && item.advisability == 0) ||
                (isImpossibleChecked && item.advisability == 1);

            return matchesUrgency || matchesStatus || matchesNewStatus;
        });

        if(filteredData.length == 0 && (isUrgentChecked || isBacklogChecked || isWIPChecked || isClosedChecked || isNotHandledChecked || isHandledChecked || isImpossibleChecked)) {
            // 該当するデータがない場合
            tableBody.innerHTML = `
            <td class="error_filter" colspan="7">
                <div class="box-005">
                    <div>
                        該当データなし
                    </div>
                    <p><span>現在、その条件に当てはまる依頼はありません。</span></p>
                </div>
            </td>
            `;
        }else{

            if(!isUrgentChecked && !isBacklogChecked && !isWIPChecked && !isClosedChecked && !isNotHandledChecked && !isHandledChecked && !isImpossibleChecked){
                filteredData.push(...alldata);
            }

            // フィルタリング結果をテーブルに表示
            filteredData.forEach((item, i) => {
                const b_row = document.createElement("tr");

                // 緊急/通常(アイコン表示)
                emerg_class[i] = item.emerg == 1 ? "fa-solid fa-triangle-exclamation emerg-icon" : "";
                
                // 可否(データにより表示切替)
                adv[i] = adv_judge(item.advisability);

                // 状況(データにより表示切替)
                supp[i] = supp_judge(item.advisability, item.supp_status);

                b_row.innerHTML = `
                    <td class="text-center">
                        <i id="td_emerg" class="${emerg_class[i]}"></i>
                    </td>
                    <td id="td_order_date">${item.order_date}</td>
                    ${adm_id == 3 ? `
                        <td  class="td_facility">${change_hos(item.hospital)} )${change_bel(item.division,item.hospital)}</td>
                        <td class="name_num">${html_escape(item.name)}</td>
                    ` : `
                        <td id="td_content" class="odate_td">${content_cut(item.content)}</td>
                    `}
                    <td class="text-center"><label id="td_advis" class="${adv[i][0]}">${adv[i][2]}</label></td>
                    <td class="text-center"><label id="td_status" class="${supp[i][0]}">${supp[i][2]}</label></td>
                    <td class="text-center">
                        <button id="showModal" class="uk-button uk-button-details" data-index="${i}">詳細</button>
                    </td>
                `;

                tableBody.appendChild(b_row);

            });
            // フィルタリングしたデータを配列へ代入
            fil_data = filteredData;
        }
    }

});

// ------------------------------------------------------------

// 詳細モーダル表示
const modal = document.getElementById("detailModal");
const modalContent = document.getElementById("modalContent");

// 動的に生成されるボタンにイベントリスナーを追加
$(document).on('click', '#showModal', function () {
    const index = $(this).data('index'); // data-index 属性から index を取得
    showModal(index); // showModal 関数を実行
});
// モーダル内容を表示する関数
function showModal(index) {

    // モーダルへ表示する内容を生成
    let user = [];
    // フィルタリング用データがある場合、フィルタリングデータを使用
    //           〃          ない場合、全データを使用
    user = fil_data[index];
console.log(user.advisability);
    // モーダルの内容を画面上へ生成
    modalContent.innerHTML = `
        <!-- 緊急、可否、対応状況 -->
        <div class="uk-grid-small uk-child-width-auto uk-grid">
            <p class="width_adjustment">
                <i id="mod_emerg" class="${emerg_class[index]}"></i>
                <label id="mod_advis" class="${adv[index][1]}">${adv[index][2]}</label>
                <label id="mod_status" class="${supp[index][1]}">${supp[index][2]}</label>
            </p>
        </div>
        
        <div class="width_adjustment">

            <!-- 依頼日 -->
            <span id="mod_order_date">依頼日：${html_escape(user.order_date)}</span><br>

            ${adm_id == 3 ? `
            
            <!-- 所属 -->
            <span>${change_hos(user.hospital)})${change_bel(user.division,user.hospital)}</span><br>
            
            ` : ``}

            <!-- (依頼者)職員番号 -->
            <span>${user.r_staff_num}</span>

            <!-- 名前 -->
            <span>${user.name}</span>

        </div>
        
        <div class="width_adjust-margin">
            <!-- 依頼内容 -->
            <p class="content-label">問い合わせ内容</p>
            <span id="mod_content">${html_escape_decode(user.content)}</span>

        </div>

        <!-- 依頼者：画像 -->
        ${user.req_image ? `
        <div class="text-center img_bottom" id="mod_image_div">
            <span class="color-posision">※画像をクリックすると、新しいタブで画像が開きます。</spna><br>
            <a id="mod_image_link" target="_blank" data-caption="画像プレビュー" href="${html_escape(user.req_image)}">
                <img id="mod_image" alt="" class="img_csize" src="${html_escape(user.req_image)}">
            </a>
        </div>
        ` : ''}
                
        <!-- 内容修正用 回答入力欄 -->
        <ul uk-accordion>
            <li>
                <a class="uk-accordion-title" href="#">${adm_id == 3 ? user.advisability == null ? `返信する` : '内容を修正する' : '内容を修正する'}</a>
                <div class="uk-accordion-content text-center">
                    <form id="${adm_id == 3 ? `answerForm` : `order_changeForms`}">
                        ${adm_id == 3 ? `
                            ${user.advisability == null ? `
                            <div class="toggle-button toggle-bottom">
                                <input type="radio" id="possible" name="advisability" value="対応可">
                                <label for="possible">対応可</label>
                                <input type="radio" id="impossible" name="advisability" value="対応不可">
                                <label for="impossible">対応不可</label>
                            </div>
                            ` : `
                                ${user.advisability == 1 ? `` : `
                                    <div class="toggle-button toggle-bottom">
                                        <input type="radio" id="middle" name="status_middle" value="対応中">
                                        <label for="middle">対応中</label>
                                        <input type="radio" id="finished" name="status_middle" value="対応済">
                                        <label for="finished">対応済</label>
                                    </div>
                                `}
                            `}
                            ` : ``}
                        <textarea class="uk-textarea" rows="4" name="${adm_id == 3 ? `answer` : `order_change`}" id="${adm_id == 3 ? `answer` : `order_change`}" placeholder="ここに回答を入力してください">${adm_id == 3 ? user.answer ? html_escape(user.answer) : `` : html_escape(user.content)}</textarea>
                        <input type="hidden" id="que_id" value="${html_escape(user.que_id)}"
                        ${user.advisability ? `data-adv="${html_escape(user.advisability)}"` : ''}
                        ${user.advisability == 0 ? `data-supp="${html_escape(user.supp_status)}"` : ''}>
                        <button class="uk-button uk-button-primary uk-margin-top ${adm_id == 3 ? `submitAnswer` : `submitchangeorder` }" id="${adm_id == 3 ? `submitAnswer` : `submitchangeorder` }">送信</button>
                    </form>
                </div>
            </li>
        </ul>

        <!-- モーダル：返信が入力されている場合 -->
        ${user.ans_date ? `
        <hr id="hr_modalupper">
        <!-- 返信の表示（返信があるときのみ表示） -->
        <div id="modal_backgroundc" class="modal_background">

            <div class="width_adjustment">
                    
                <!-- 回答日・対応日
                対応日がある場合
                かつ、対応状況が「対応済み」の場合は表示 -->
                <span>
                    回答日：<span id="ans_date_Display">${html_escape(user.ans_date)}</span>${user.supp_date && user.supp_status == 2 ? ` / 対応日：<span id="supp_date_Display">${html_escape(user.supp_date)}</span>` : ''}
                </span><br>


                <!-- (依頼者)職員番号 -->
                <span id="a_staff_num_Display">${html_escape(user.a_staff_num)}</span>

                <!-- 名前 -->
                <span id="answerer_Display">${html_escape(user.answerer)}</span>

            </div>

            <div class="width_adjust-margin">
                <!-- 返信内容 -->
                <p class="content-label">回答</p>
                ${user.answer != '' ? `
                <span id="answerDisplay">${html_escape_decode(user.answer)}</span>
                ` : `
                <span id="answerDisplay">( 回答は入力されていません。)</span>
                `}
            </div>

            <!-- 画像表示 -->
            ${user.ans_image ? `

            <div class="text-center img_bottom" id="mod_a_image_div">
                <span class="color-posision">※画像をクリックすると、新しいタブで画像が開きます。</spna><br>
                <a id="mod_a_image_link" target="_blank" data-caption="画像プレビュー" href="${html_escape(user.ans_image)}">
                    <img id="mod_a_image" alt="" class="img_csize" src="${html_escape(user.ans_image)}">
                </a>
            </div>

            ` : ''}

        </div>

        ` : ''} <!-- 返信が入力されている場合 閉じ -->
    `;

    modal.style.display = "block";

    // UIkitモーダルを表示
    UIkit.modal(modal).show();


}

// モーダルを閉じる処理
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

// 部署情報を使用可能にする
// 附属病院(u_bel)
var k_u_bel = [];
for (var key in u_bel) {
    if (u_bel.hasOwnProperty(key)) {
        k_u_bel.push({ key: key, value: u_bel[key] });
    }
}
// 総合医療センター(c_bel)
var k_c_bel = [];
for (var key in c_bel) {
    if (c_bel.hasOwnProperty(key)) {
        k_c_bel.push({ key: key, value: c_bel[key] });
    }
}
// 高齢者医療センター(k_bel)
var k_k_bel = [];
for (var key in k_bel) {
    if (k_bel.hasOwnProperty(key)) {
        k_k_bel.push({ key: key, value: k_bel[key] });
    }
}

// 部署名判定
function change_bel(bel, hos) {
    // 配列を一行ずつ探索し、キーとbelが一致していればその要素を表示
    if (hos == '0') {
        k_u_bel.forEach(function (element) {
            if (element.key === bel) {
                bel_name = element.value;
            }
        });
    } else if (hos == '1') {
        k_c_bel.forEach(function (element) {
            if (element.key === bel) {
                bel_name = element.value;
            }
        });
    } else if (hos == '2') {
        k_k_bel.forEach(function (element) {
            if (element.key === bel) {
                bel_name = element.value;
            }
        });
    }
    return bel_name;
}

// 病院名判定
function change_hos(name) {

    if (name == 0) {
        return '附';
    } else if (name == 1) {
        return '総';
    } else if (name == 2) {
        return '高';
    } else {
        return 'その他';
    }
}

// 詳細モーダルの表示
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

// 緊急アイコン 付与
function add_class() {
    return 'fa-solid fa-triangle-exclamation emerg-icon';
}

// 対応可否の判定
function adv_judge(adv) {

    // 変数の初期化
    var td_class = "";
    var mod_class = "";
    var text = "";

    if (adv == null) {

        // 未確認の場合
        td_class = "uk-label uk-label-warning";
        mod_class = "uk-label uk-label-warning ad-stfont-size";
        text = "未確認";

    } else if (adv == 0) {

        // 対応可の場合
        td_class = "uk-label uk-label-primary";
        mod_class = "uk-label uk-label-primary ad-stfont-size";
        text = "可";

    } else if (adv == 1) {

        // 対応不可の場合
        td_class = "uk-label uk-label-danger";
        mod_class = "uk-label uk-label-danger ad-stfont-size";
        text = "不可";

    }

    // 配列へ、「表へ付与するclass、モーダルへ付与するclass、表示するテキスト」の形式で返す
    const adv_result = [td_class, mod_class, text];
    return adv_result;

}

// 対応状況の判定、モーダルへ表示するか否かを判定
function supp_judge(adv, supp) {

    var supp_d = [];

    if (adv == 0) {
        if (supp == 0) {

            supp_d = ["uk-label uk-label-danger", "uk-label uk-label-danger ad-stfont-size", '未対応',0];

        } else if (supp == 1) {
                
            supp_d = ["uk-label uk-label-success","uk-label uk-label-success ad-stfont-size",'対応中',0];

        } else if (supp == 2) {

            supp_d = ["uk-label uk-label-primary","uk-label uk-label-primary ad-stfont-size",'対応済',0];

        }
    } else {

        // 対応不可の場合、モーダルへ対応状況を表示しない
        supp_d = ["","","ー",1];

    }

    return supp_d;
}

// 依頼内容の文字数制限
function content_cut(content) {
    content = content.replace(/\r?\n/g, ' ');
    if ([...content].length > 27) {
        return content.substr(0, 27) + '...';
    } else {
        return content;
    }
}

// 文字列の無害化
function html_escape(text = '') {
    return text.replace(/["&'<>]/g, function (match) {
        return {
            '&': '&amp;',
            '\'': '&#39;',
            '"': '&quot;',
            '<': '&lt;',
            '>': '&gt;'
        }[match]
    })
}

// 文字列の無害化(改行有)
function html_escape_decode(text = '') {
    // 改行を一時的に特定の文字列に置き換える
    text = text.replace(/\n/g, '__NEWLINE__');

    // HTMLエンティティをデコード
    text = text.replace(
        /(&amp;|&#39;|&quot;|&lt;|&gt;)/g,
        function (match) {
            return {
                '&amp;': '&',
                '&#39;': '\'',
                '&quot;': '"',
                '&lt;': '<',
                '&gt;': '>'
            }[match];
        }
    );

    // 特定の文字列を改行に戻し、<br>タグに変換
    text = text.replace(/__NEWLINE__/g, '<br>');

    return text;
}
