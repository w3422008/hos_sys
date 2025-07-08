/*県南東部*/
//「全て選択」のチェックボックス
let checkAll_as1 = document.getElementById("Ass1");
//「全て選択」以外のチェックボックス
let el_as1 = document.getElementsByClassName("nantou1");

//全てのチェックボックスをON/OFFする
const funcCheckAll_as1 = (bool) => {
    for (let i = 0; i < el_as1.length; i++) {
        el_as1[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_as1 = () => {
    let count = 0;
    for (let i = 0; i < el_as1.length; i++) {
        if (el_as1[i].checked) {
            count += 1;
        }
    }

    if (el_as1.length === count) {
        checkAll_as1.checked = true;
    } else {
        checkAll_as1.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_as1.addEventListener("click",() => {
    funcCheckAll_as1(checkAll_as1.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_as1.length; i++) {
    el_as1[i].addEventListener("click", funcCheck_as1, false);
}








/*県南西部*/
//「全て選択」のチェックボックス
let checkAll_as2 = document.getElementById("Ass2");
//「全て選択」以外のチェックボックス
let el_as2 = document.getElementsByClassName("nansei1");

//全てのチェックボックスをON/OFFする
const funcCheckAll_as2 = (bool) => {
    for (let i = 0; i < el_as2.length; i++) {
        el_as2[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_as2 = () => {
    let count = 0;
    for (let i = 0; i < el_as2.length; i++) {
        if (el_as2[i].checked) {
            count += 1;
        }
    }

    if (el_as2.length === count) {
        checkAll_as2.checked = true;
    } else {
        checkAll_as2.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_as2.addEventListener("click",() => {
    funcCheckAll_as2(checkAll_as2.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_as2.length; i++) {
    el_as2[i].addEventListener("click", funcCheck_as2, false);
}



/*高梁・新見 */
//「全て選択」のチェックボックス
let checkAll_as3 = document.getElementById("Ass3");
//「全て選択」以外のチェックボックス
let el_as3 = document.getElementsByClassName("takahashi1");

//全てのチェックボックスをON/OFFする
const funcCheckAll_as3 = (bool) => {
    for (let i = 0; i < el_as3.length; i++) {
        el_as3[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_as3 = () => {
    let count = 0;
    for (let i = 0; i < el_as3.length; i++) {
        if (el_as3[i].checked) {
            count += 1;
        }
    }

    if (el_as3.length === count) {
        checkAll_as3.checked = true;
    } else {
        checkAll_as3.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_as3.addEventListener("click",() => {
    funcCheckAll_as3(checkAll_as3.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_as3.length; i++) {
    el_as3[i].addEventListener("click", funcCheck_as3, false);
}




/*真庭 */
//「全て選択」のチェックボックス
let checkAll_as4 = document.getElementById("Ass4");
//「全て選択」以外のチェックボックス
let el_as4 = document.getElementsByClassName("maniwa1");

//全てのチェックボックスをON/OFFする
const funcCheckAll_as4 = (bool) => {
    for (let i = 0; i < el_as4.length; i++) {
        el_as4[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_as4 = () => {
    let count = 0;
    for (let i = 0; i < el_as4.length; i++) {
        if (el_as4[i].checked) {
            count += 1;
        }
    }

    if (el_as4.length === count) {
        checkAll_as4.checked = true;
    } else {
        checkAll_as4.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_as4.addEventListener("click",() => {
    funcCheckAll_as4(checkAll_as4.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_as4.length; i++) {
    el_as4[i].addEventListener("click", funcCheck_as4, false);
}






/*津山・英田 */
//「全て選択」のチェックボックス
let checkAll_as5 = document.getElementById("Ass5");
//「全て選択」以外のチェックボックス
let el_as5 = document.getElementsByClassName("tuyama1");

//全てのチェックボックスをON/OFFする
const funcCheckAll_as5 = (bool) => {
    for (let i = 0; i < el_as5.length; i++) {
        el_as5[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_as5 = () => {
    let count = 0;
    for (let i = 0; i < el_as5.length; i++) {
        if (el_as5[i].checked) {
            count += 1;
        }
    }

    if (el_as5.length === count) {
        checkAll_as5.checked = true;
    } else {
        checkAll_as5.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_as5.addEventListener("click",() => {
    funcCheckAll_as5(checkAll_as5.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_as5.length; i++) {
    el_as5[i].addEventListener("click", funcCheck_as5, false);
}



