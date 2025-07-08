//部門連絡先テーブル
/**
* 行追加
*/
function insertTable_fie () {
    var table2 = document.getElementById ("table_fie");
    var row = table2.insertRow (-1); // 行を追加（見出し、追加ボタンの次の行）
    var cell0 = row.insertCell (-1); // セルを追加
    var cell1 = row.insertCell (-1); // セルを追加
    var cell2 = row.insertCell (-1); // セルを追加
    var cell3 = row.insertCell (-1); // セルを追加
    var cell4 = row.insertCell (-1); // セルを追加
    var cell5 = row.insertCell (-1); // セルを追加
    var cell6 = row.insertCell (-1); // セルを追加

    //セルに内容を設定
    let j = table2.rows.length - 1;
    cell0.innerHTML = '<span class="rowno">' + j + '</span>';

    cell1.innerHTML = "<select name='fie_insert["
                    + j
                    + "][fie_div]' class='fie-row" + j + "'>"
                    + "<option value=''>---</option>"
                    + "<option value='外来'>外来</option>"
                    + "<option value='連携'>連携</option>"
                    + "<option value='その他'>その他</option>"
                    + "</select>";

    cell2.innerHTML = "<input type='text' value='' name = 'fie_insert["
                    + j
                    + "][fie_name]' placeholder='例) 地域医療連携室' class='fie-row" + j + "'> ";
    cell3.innerHTML = "<input type='text' value='' name = 'fie_insert["
                    + j
                    + "][fie_tel]' placeholder='例) 123-4567' class='fie-row" + j + "'> ";
    cell4.innerHTML = "<input type='text' value='' name = 'fie_insert["
                    + j
                    + "][fie_fax]' placeholder='例) 123-4567' class='fie-row" + j + "'> ";
    cell5.innerHTML = "<input type='text' value='' name = 'fie_insert["
                    + j
                    + "][fie_note]' class='fie-row" + j + "'> ";

    cell6.innerHTML = "<button type='button' onclick='deleteTable_fie2 (getSort_fie(this.parentNode.parentNode));' class='fie-row" + j + "'>削除</button>";

    j++;
}

/**
* 入力欄削除
*/
/* 
    function deleteTable_fie (row) {
        document.getElementById ("table_fie").deleteRow (row);
    } 
*/

//谷川
function deleteTable_fie2 (row) {
    const table = document.querySelector("#table_fie");
    const row_element = table.querySelectorAll(".fie-row" + row);

    //氏名が入力されていれば情報が入力されているとみなして有効・無効（削除対象）切り替え
        // ↑ 高橋20221205修正
    //未入力であれば行削除
    if(row_element[0].value || row_element[1].value || row_element[2].value ||row_element[3].value || row_element[4].value){
        //行内のボタン以外のすべての要素を無効化、有効化切り替え
        for (let j = 0; j < row_element.length; j++) {
            if(!row_element[j].disabled){
                row_element[j].disabled = true;
            }else{
                row_element[j].disabled = false;
            }
            //ボタン要素は無効化解除
            if(row_element[j].tagName === "BUTTON"){
                if(row_element[j].textContent.trim() === "削除"){
                    row_element[j].textContent = "取消";
                    row_element[j].disabled = false;
                }else{
                    row_element[j].textContent = "削除";
                    row_element[j].disabled = false;
                }
            }
        }
    }else{
        //対象行の削除
        document.getElementById ("table_fie").deleteRow(row);

        //行削除による表内の再付番
        const rownos = table.querySelectorAll(".rowno");
        let no = 1;
        for (let j = 0; j < rownos.length; j++){
            rownos[j].innerHTML = no++;
        }

        //行削除によるクラス名の再付番
        //クラス名再付番関数呼出　引数は要素をマッチさせるための条件
        table_renumber2("select[name*='[fie_div]']");
        table_renumber2("input[name*='[fie_name]']");
        table_renumber2("input[name*='[fie_tel]']");
        table_renumber2("input[name*='[fie_fax]']");
        table_renumber2("input[name*='[fie_note]']");
        table_renumber2("button[type='button']");
    }
}

//クラス名再付番関数　谷川
function table_renumber2(match_rule){

    const table = document.querySelector("#table_fie");
    const col_elements = table.querySelectorAll(match_rule);
    
    if (!col_elements){
        return false;
    }

    let no = 1;
    for (let j = 0; j < col_elements.length; j++){
        col_elements[j].classList.replace(col_elements[j].className, "fie-row" + no)
        no++;
    }        
}



/**
* 順番を調べる
*/
function getSort_fie (target) {
    var nodeLists = document.getElementById ("table_fie").childNodes[1].childNodes;
    var trCount = - 1;
    for (var j = 0; j < nodeLists.length; j++) {
        var node = nodeLists.item (j);
        if (node.tagName == "TR") {
            trCount++;
        }
        if (node == target) {
            return trCount;
        }
    }
    return 0;
}

/**
* パラメータ名を設定
*/
function setParamsName2 () {
    // 項目数を設定
    var nodeLists = document.getElementById ("table_fie").childNodes[1].childNodes;
    // 名前を設定
    var cnt = 0 - 2; //見出し、追加ボタン分減算
    for (var r = 0; r < nodeLists.length; r++) {
        if (nodeLists.item (r).nodeName != "TR") {
            continue;
        }
        var tdLists = nodeLists.item (r).childNodes;
        for (var d = 0; d < tdLists.length; d++) {
            if (tdLists.item (d).nodeName != "TD") {
                continue;
            }
            // 内容を修正
            var params = tdLists.item (d).childNodes;
            for (var p = 0; p < params.length; p++) {
                var node = params.item (p);
                if (node.nodeName != "INPUT"
                &&  node.nodeName != "TEXTAREA"
                &&  node.nodeName != "SELECT") {
                    continue;
                }
                if (node.name.lastIndexOf ("_") == node.name.length - 1) {
                    node.name = node.name + cnt;
                }
            }
        }
        cnt++;
    }
    document.getElementById ("count_fieid").value = cnt;
}


