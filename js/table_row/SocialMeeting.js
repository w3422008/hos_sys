//医療連携懇話会テーブル

//-----------------附属病院
/**
* 行追加
*/
function insertTable_sm1 () {
    var table2 = document.getElementById ("table_sm1");
    var row = table2.insertRow (-1); // 行を追加（見出し、追加ボタンの次の行）
    var cell0 = row.insertCell (-1); // セルを追加
    var cell1 = row.insertCell (-1); // セルを追加
    var cell2 = row.insertCell (-1); // セルを追加

    //セルに内容を設定
    let k = table2.rows.length - 1;
        //過去100年＜js＞
        let dateY = new Date().getFullYear();
        let html = '';
        for(let y = 0; y < 100; y++){
            html += "<option value='"+ (dateY - y) +"'>"+ (dateY - y) +"</option>"
        }

    cell0.innerHTML = "<select name='sm1_update["
                    + k
                    + "][year]' class='sm1-row" + k +"'>"
                    + "<option value=''>【選択してください】</option>"
                    + html
                    + "</select>";

    cell1.innerHTML = "<button type='button' onclick='deleteTable_sm1 (getSort_sm1(this.parentNode.parentNode));' class='sm1-row" + k + "'>削除</button>";
    cell2.innerHTML = "<button type='button' onclick='insertTable_sm1 ()' class='rowInsert-btn'>追加</button>";
    /* cell2.innerHTML = "<button type='button' onclick='deleteTable_sm1 (getSort_sm1(this.parentNode.parentNode));' class='sm1-row" + k + "'>追加</button>"; */

    k++;
}


//谷川
function deleteTable_sm1 (row) {
    const table = document.querySelector("#table_sm1");
    const row_element = table.querySelectorAll(".sm1-row" + row);

    //氏名が入力されていれば情報が入力されているとみなして有効・無効（削除対象）切り替え
        // ↑ 高橋20221205修正
    //未入力であれば行削除
    if(row_element[0].value !== ''){
        //行内のボタン以外のすべての要素を無効化、有効化切り替え
        for (let k = 0; k < row_element.length; k++) {
            if(!row_element[k].disabled){
                row_element[k].disabled = true;
            }else{
                row_element[k].disabled = false;
            }
            //ボタン要素は無効化解除
            if(row_element[k].tagName === "BUTTON"){
                if(row_element[k].textContent === "削除"){
                    row_element[k].textContent = "取消";
                    row_element[k].disabled = false;
                }else{
                    row_element[k].textContent = "削除";
                    row_element[k].disabled = false;
                }
            }
        }
    }else{
        //対象行の削除
        document.getElementById ("table_sm1").deleteRow(row);

        //行削除による表内の再付番
        const rownos = table.querySelectorAll(".rowno");
        let no = 1;
        for (let k = 0; k < rownos.length; k++){
            rownos[k].innerHTML = no++;
        }

        //行削除によるクラス名の再付番
        //クラス名再付番関数呼出　引数は要素をマッチさせるための条件
        table_renumber3("select[name*='[year]']");
        table_renumber3("button[type='button']");
        table_renumber3("button[type='button']");
    }
}

//クラス名再付番関数　谷川
function table_renumber3(match_rule){

    const table = document.querySelector("#table_sm1");
    const col_elements = table.querySelectorAll(match_rule);
    
    if (!col_elements){
        return false;
    }

    let no = 1;
    for (let k = 0; k < col_elements.length; k++){
        col_elements[k].classList.replace(col_elements[k].className, "sm1-row" + no)
        no++;
    }        
}



/**
* 順番を調べる
*/
function getSort_sm1 (target) {
    var nodeLists = document.getElementById ("table_sm1").childNodes[1].childNodes;
    var trCount = - 1;
    for (var k = 0; k < nodeLists.length; k++) {
        var node = nodeLists.item (k);
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
function setParamsName3 () {
    // 項目数を設定
    var nodeLists = document.getElementById ("table_sm1").childNodes[1].childNodes;
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
    document.getElementById ("count_sm1id").value = cnt;
}






//-----------------総合医療センター
/**
* 行追加
*/
function insertTable_sm2 () {
    var table2 = document.getElementById ("table_sm2");
    var row = table2.insertRow (-1); // 行を追加（見出し、追加ボタンの次の行）
    var cell0 = row.insertCell (-1); // セルを追加
    var cell1 = row.insertCell (-1); // セルを追加
    var cell2 = row.insertCell (-1); // セルを追加

    //セルに内容を設定
    let k = table2.rows.length - 1;
        //過去100年＜js＞
        let dateY = new Date().getFullYear();
        let html = '';
        for(let y = 0; y < 100; y++){
            html += "<option value='"+ (dateY - y) +"'>"+ (dateY - y) +"</option>"
        }

    cell0.innerHTML = "<select name='sm2_update["
                    + k
                    + "][year]' class='sm2-row" + k +"'>"
                    + "<option value=''>【選択してください】</option>"
                    + html
                    + "</select>";

    cell1.innerHTML = "<button type='button' onclick='deleteTable_sm2 (getSort_sm2(this.parentNode.parentNode));' class='sm2-row" + k + "'>削除</button>";
    cell2.innerHTML = "<button type='button' onclick='insertTable_sm2 ()' class='rowInsert-btn'>追加</button>";
    /* cell2.innerHTML = "<button type='button' onclick='deleteTable_sm2 (getSort_sm2(this.parentNode.parentNode));' class='sm2-row" + k + "'>追加</button>"; */

    k++;
}


//谷川
function deleteTable_sm2 (row) {
    const table = document.querySelector("#table_sm2");
    const row_element = table.querySelectorAll(".sm2-row" + row);

    //氏名が入力されていれば情報が入力されているとみなして有効・無効（削除対象）切り替え
        // ↑ 高橋20221205修正
    //未入力であれば行削除
    if(row_element[0].value !== ''){
        //行内のボタン以外のすべての要素を無効化、有効化切り替え
        for (let k = 0; k < row_element.length; k++) {
            if(!row_element[k].disabled){
                row_element[k].disabled = true;
            }else{
                row_element[k].disabled = false;
            }
            //ボタン要素は無効化解除
            if(row_element[k].tagName === "BUTTON"){
                if(row_element[k].textContent === "削除"){
                    row_element[k].textContent = "取消";
                    row_element[k].disabled = false;
                }else{
                    row_element[k].textContent = "削除";
                    row_element[k].disabled = false;
                }
            }
        }
    }else{
        //対象行の削除
        document.getElementById ("table_sm2").deleteRow(row);

        //行削除による表内の再付番
        const rownos = table.querySelectorAll(".rowno");
        let no = 1;
        for (let k = 0; k < rownos.length; k++){
            rownos[k].innerHTML = no++;
        }

        //行削除によるクラス名の再付番
        //クラス名再付番関数呼出　引数は要素をマッチさせるための条件
        table_renumber4("select[name*='[year]']");
        table_renumber4("button[type='button']");
        table_renumber4("button[type='button']");
    }
}

//クラス名再付番関数　谷川
function table_renumber4(match_rule){

    const table = document.querySelector("#table_sm2");
    const col_elements = table.querySelectorAll(match_rule);
    
    if (!col_elements){
        return false;
    }

    let no = 1;
    for (let k = 0; k < col_elements.length; k++){
        col_elements[k].classList.replace(col_elements[k].className, "sm2-row" + no)
        no++;
    }        
}



/**
* 順番を調べる
*/
function getSort_sm2 (target) {
    var nodeLists = document.getElementById ("table_sm2").childNodes[1].childNodes;
    var trCount = - 1;
    for (var k = 0; k < nodeLists.length; k++) {
        var node = nodeLists.item (k);
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
function setParamsName4 () {
    // 項目数を設定
    var nodeLists = document.getElementById ("table_sm2").childNodes[1].childNodes;
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
    document.getElementById ("count_sm2id").value = cnt;
}


