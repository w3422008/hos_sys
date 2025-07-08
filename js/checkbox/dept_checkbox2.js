//dept_checkbox2の続き

/*医科（歯科系以外すべて） */


//「全て選択」のチェックボックス
let checkAll_d1a = document.getElementById("Dept1a");
//「全て選択」以外のチェックボックス
let el_d1a = document.getElementsByClassName("xika");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d1a = (bool) => {
    for (let i = 0; i < el_d1a.length; i++) {
        el_d1a[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d1a = () => {
    let count = 0;
    for (let i = 0; i < el_d1a.length; i++) {
        if (el_d1a[i].checked) {
            count += 1;
        }
    }

    if (el_d1a.length === count) {
        checkAll_d1a.checked = true;
    } else {
        checkAll_d1a.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_d1a.addEventListener("click",() => {
    funcCheckAll_d1a(checkAll_d1a.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d1a.length; i++) {
    el_d1a[i].addEventListener("click", funcCheck_d1a, false);
}

