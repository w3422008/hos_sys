//親族情報テーブル
/**
* 行追加
*/
function insertTable_rel () {
    var table1 = document.getElementById ("table_rel");
    var row1 = table1.insertRow (-1); // 行を追加（見出し、追加ボタンの次の行）
    var cell0 = row1.insertCell (-1); // セルを追加
    var cell1 = row1.insertCell (-1); // セルを追加
    var cell2 = row1.insertCell (-1); // セルを追加
    var cell3 = row1.insertCell (-1); // セルを追加
    var cell4 = row1.insertCell (-1); // セルを追加
    var cell5 = row1.insertCell (-1); // セルを追加
    var cell6 = row1.insertCell (-1); // セルを追加
    var cell7 = row1.insertCell (-1); // セルを追加

    //谷川　最終行の番号取得
    let i = table1.rows.length - 1;

    //セルに内容を設定
    cell0.innerHTML = '<span class="rowno">' + i + '</span>';
    cell1.innerHTML = '<input type="text" name="rel_insert['
                    + i
                    + '][name]" placeholder="例) 川崎 太郎" class="rel-row' + i + '" value="">';

    cell2.innerHTML = "<select name='rel_insert["
                    + i
                    + "][conn]' class='rel-row" + i + "'>"
                    + "<option value='' >---</option>"
                    + "<option value='親'>親</option>"
                    + "<option value='配偶者'>配偶者</option>"
                    + "<option value='弟・姉妹'>弟・姉妹</option>"
                    + "<option value='子'>子</option>"
                    + "<option value='孫'>孫</option>"
                    + "<option value='その他'>その他</option>"
                    + "</select>";
   
    cell3.innerHTML = "<select name='rel_insert["
                    + i
                    + "][sch_name]' class='rel-row" + i + "'>"
                    + "<option value='' >---</option>"
                    + "<option value='川崎医科大学'>川崎医科大学</option>"
                    + "<option value='医療福祉大学'>医療福祉大学</option>"
                    + "<option value='医療短期大学'>医療短期大学</option>"
                    + "<option value='附属高校'>附属高校</option>"
                    + "<option value='リハビリテーション学院'>リハビリテーション学院</option>"
                    + "</select>";
   
    cell4.innerHTML = "<input type='text' name = 'rel_insert["
                    + i
                    + "][ent_year]' placeholder='例) 20XX' size='5'  class='rel-row" + i + "'>";
    cell5.innerHTML = "<input type='text' name = 'rel_insert["
                    + i
                    + "][gra_year]' placeholder='例) 20XX' size='5' class='rel-row" + i + "'>";
    cell6.innerHTML = "<input type='text' name = 'rel_insert["
                    + i
                    + "][rel_note]' class='rel-row" + i + "'>";
    cell7.innerHTML = "<button type='button' onclick='deleteTable_rel2 (getSort_rel(this.parentNode.parentNode));' class='rel-row" + i + "'>削除</button>";

    i++;
   }


/**
* 入力欄削除
*/
//大井　現在より1つ後の行を削除
/* 
    function deleteTable_rel (row) {
        document.getElementById ("table_rel").deleteRow (row+1);
    } 
*/

//大井　現在の行を削除
//谷川　2022/12/3修正
function deleteTable_rel2 (row) {
    const table = document.querySelector("#table_rel");
    const row_element = table.querySelectorAll(".rel-row" + row);

    //氏名が入力されていれば情報が入力されているとみなして有効・無効（削除対象）切り替え
        // ↑ 高橋20221205修正
    //未入力であれば行削除
    if(row_element[0].value || row_element[1].value || row_element[2].value ||row_element[3].value || row_element[4].value || row_element[5].value){
        //行内のボタン以外のすべての要素を無効化、有効化切り替え
        for (let i = 0; i < row_element.length; i++) {
            if(!row_element[i].disabled){
                row_element[i].disabled = true;
            }else{
                row_element[i].disabled = false;
            }
            //ボタン要素は無効化解除
            if(row_element[i].tagName === "BUTTON"){
                if(row_element[i].textContent.trim() === "削除"){
                    row_element[i].textContent = "取消";
                    row_element[i].disabled = false;
                }else{
                    row_element[i].textContent = "削除";
                    row_element[i].disabled = false;
                }
            }
        }
    }else{
        //対象行の削除
        document.getElementById ("table_rel").deleteRow(row);

        //行削除による表内の再付番
        const rownos = table.querySelectorAll(".rowno");
        let no = 1;
        for (let i = 0; i < rownos.length; i++){
            rownos[i].innerHTML = no++;
        }

        //行削除によるクラス名の再付番
        //クラス名再付番関数呼出　引数は要素をマッチさせるための条件
        table_renumber("input[name*='[name]']");
        table_renumber("select[name*='[conn]']");
        table_renumber("select[name*='[sch_name]']");
        table_renumber("input[name*='[ent_year]']");
        table_renumber("input[name*='gra_year']");
        table_renumber("input[name*='[rel_note]']");
        table_renumber("button[type='button']");
    }
}

//クラス名再付番関数　谷川
function table_renumber(match_rule){

    const table = document.querySelector("#table_rel");
    const col_elements = table.querySelectorAll(match_rule);
    
    if (!col_elements){
        return false;
    }

    let no = 1;
    for (let i = 0; i < col_elements.length; i++){
        col_elements[i].classList.replace(col_elements[i].className, "rel-row" + no)
        no++;
    }        
}


/**
* 順番を調べる
*/
function getSort_rel (target) {
    var nodeLists = document.getElementById ("table_rel").childNodes[1].childNodes;
    var trCount = - 1;
    for (var i = 0; i < nodeLists.length; i++) {
        var node = nodeLists.item (i);
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
function setParamsName1 () {
    // 項目数を設定
    var nodeLists = document.getElementById ("table_rel").childNodes[1].childNodes;
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
    document.getElementById ("count_relid").value = cnt;
}




