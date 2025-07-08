//内科系
//「全て選択」のチェックボックス
let checkAll_d1 = document.getElementById("Dept1");
//「全て選択」以外のチェックボックス
let el_d1 = document.getElementsByClassName("naika");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d1 = (bool) => {
    for (let i = 0; i < el_d1.length; i++) {
        el_d1[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d1 = () => {
    let count = 0;
    for (let i = 0; i < el_d1.length; i++) {
        if (el_d1[i].checked) {
            count += 1;
        }
    }

    if (el_d1.length === count) {
        checkAll_d1.checked = true;
    } else {
        checkAll_d1.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAll_d1.addEventListener("click",() => {
    funcCheckAll_d1(checkAll_d1.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d1.length; i++) {
    el_d1[i].addEventListener("click", funcCheck_d1, false);
}








/*小児科系*/
//「全て選択」のチェックボックス
let checkAll_d2 = document.getElementById("Dept2");
//「全て選択」以外のチェックボックス
let el_d2 = document.getElementsByClassName("syounika");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d2 = (bool) => {
    for (let i = 0; i < el_d2.length; i++) {
        el_d2[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d2 = () => {
    let count = 0;
    for (let i = 0; i < el_d2.length; i++) {
        if (el_d2[i].checked) {
            count += 1;
        }
    }

    if (el_d2.length === count) {
        checkAll_d2.checked = true;
    } else {
        checkAll_d2.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAll_d2.addEventListener("click",() => {
    funcCheckAll_d2(checkAll_d2.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d2.length; i++) {
    el_d2[i].addEventListener("click", funcCheck_d2, false);
}




/*外科系 */
//「全て選択」のチェックボックス
let checkAll_d3 = document.getElementById("Dept3");
//「全て選択」以外のチェックボックス
let el_d3 = document.getElementsByClassName("geka");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d3 = (bool) => {
    for (let i = 0; i < el_d3.length; i++) {
        el_d3[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d3 = () => {
    let count = 0;
    for (let i = 0; i < el_d3.length; i++) {
        if (el_d3[i].checked) {
            count += 1;
        }
    }

    if (el_d3.length === count) {
        checkAll_d3.checked = true;
    } else {
        checkAll_d3.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_d3.addEventListener("click",() => {
    funcCheckAll_d3(checkAll_d3.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d3.length; i++) {
    el_d3[i].addEventListener("click", funcCheck_d3, false);
}




/*整形外科系 */
//「全て選択」のチェックボックス
let checkAll_d4 = document.getElementById("Dept4");
//「全て選択」以外のチェックボックス
let el_d4 = document.getElementsByClassName("seikei");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d4 = (bool) => {
    for (let i = 0; i < el_d4.length; i++) {
        el_d4[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d4 = () => {
    let count = 0;
    for (let i = 0; i < el_d4.length; i++) {
        if (el_d4[i].checked) {
            count += 1;
        }
    }

    if (el_d4.length === count) {
        checkAll_d4.checked = true;
    } else {
        checkAll_d4.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_d4.addEventListener("click",() => {
    funcCheckAll_d4(checkAll_d4.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d4.length; i++) {
    el_d4[i].addEventListener("click", funcCheck_d4, false);
}






/*眼科系 */
//「全て選択」のチェックボックス
let checkAll_d5 = document.getElementById("Dept5");
//「全て選択」以外のチェックボックス
let el_d5 = document.getElementsByClassName("ganka");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d5 = (bool) => {
    for (let i = 0; i < el_d5.length; i++) {
        el_d5[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d5 = () => {
    let count = 0;
    for (let i = 0; i < el_d5.length; i++) {
        if (el_d5[i].checked) {
            count += 1;
        }
    }

    if (el_d5.length === count) {
        checkAll_d5.checked = true;
    } else {
        checkAll_d5.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_d5.addEventListener("click",() => {
    funcCheckAll_d5(checkAll_d5.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d5.length; i++) {
    el_d5[i].addEventListener("click", funcCheck_d5, false);
}





/*耳鼻咽喉科系 */
//「全て選択」のチェックボックス
let checkAll_d6 = document.getElementById("Dept6");
//「全て選択」以外のチェックボックス
let el_d6 = document.getElementsByClassName("zibi");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d6 = (bool) => {
    for (let i = 0; i < el_d6.length; i++) {
        el_d6[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d6 = () => {
    let count = 0;
    for (let i = 0; i < el_d6.length; i++) {
        if (el_d6[i].checked) {
            count += 1;
        }
    }

    if (el_d6.length === count) {
        checkAll_d6.checked = true;
    } else {
        checkAll_d6.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_d6.addEventListener("click",() => {
    funcCheckAll_d6(checkAll_d6.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d6.length; i++) {
    el_d6[i].addEventListener("click", funcCheck_d6, false);
}






/*皮膚科・泌尿器科系 */

//「全て選択」のチェックボックス
let checkAll_d7 = document.getElementById("Dept7");
//「全て選択」以外のチェックボックス
let el_d7 = document.getElementsByClassName("hifu");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d7 = (bool) => {
    for (let i = 0; i < el_d7.length; i++) {
        el_d7[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d7 = () => {
    let count = 0;
    for (let i = 0; i < el_d7.length; i++) {
        if (el_d7[i].checked) {
            count += 1;
        }
    }

    if (el_d7.length === count) {
        checkAll_d7.checked = true;
    } else {
        checkAll_d7.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_d7.addEventListener("click",() => {
    funcCheckAll_d7(checkAll_d7.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d7.length; i++) {
    el_d7[i].addEventListener("click", funcCheck_d7, false);
}




/*産婦人科系 */

//「全て選択」のチェックボックス
let checkAll_d8 = document.getElementById("Dept8");
//「全て選択」以外のチェックボックス
let el_d8 = document.getElementsByClassName("sanfuzin");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d8 = (bool) => {
    for (let i = 0; i < el_d8.length; i++) {
        el_d8[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d8 = () => {
    let count = 0;
    for (let i = 0; i < el_d8.length; i++) {
        if (el_d8[i].checked) {
            count += 1;
        }
    }

    if (el_d8.length === count) {
        checkAll_d8.checked = true;
    } else {
        checkAll_d8.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_d8.addEventListener("click",() => {
    funcCheckAll_d8(checkAll_d8.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d8.length; i++) {
    el_d8[i].addEventListener("click", funcCheck_d8, false);
}



/*精神科系 */

//「全て選択」のチェックボックス
let checkAll_d9 = document.getElementById("Dept9");
//「全て選択」以外のチェックボックス
let el_d9 = document.getElementsByClassName("seisin");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d9 = (bool) => {
    for (let i = 0; i < el_d9.length; i++) {
        el_d9[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d9 = () => {
    let count = 0;
    for (let i = 0; i < el_d9.length; i++) {
        if (el_d9[i].checked) {
            count += 1;
        }
    }

    if (el_d9.length === count) {
        checkAll_d9.checked = true;
    } else {
        checkAll_d9.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_d9.addEventListener("click",() => {
    funcCheckAll_d9(checkAll_d9.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d9.length; i++) {
    el_d9[i].addEventListener("click", funcCheck_d9, false);
}



/*歯科系 */

//「全て選択」のチェックボックス
let checkAll_d10 = document.getElementById("Dept10");
//「全て選択」以外のチェックボックス
let el_d10 = document.getElementsByClassName("sika");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d10 = (bool) => {
    for (let i = 0; i < el_d10.length; i++) {
        el_d10[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d10 = () => {
    let count = 0;
    for (let i = 0; i < el_d10.length; i++) {
        if (el_d10[i].checked) {
            count += 1;
        }
    }

    if (el_d10.length === count) {
        checkAll_d10.checked = true;
    } else {
        checkAll_d10.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_d10.addEventListener("click",() => {
    funcCheckAll_d10(checkAll_d10.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d10.length; i++) {
    el_d10[i].addEventListener("click", funcCheck_d10, false);
}




/*その他 */

//「全て選択」のチェックボックス
let checkAll_d11 = document.getElementById("Dept11");
//「全て選択」以外のチェックボックス
let el_d11 = document.getElementsByClassName("sonota");

//全てのチェックボックスをON/OFFする
const funcCheckAll_d11 = (bool) => {
    for (let i = 0; i < el_d11.length; i++) {
        el_d11[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck_d11 = () => {
    let count = 0;
    for (let i = 0; i < el_d11.length; i++) {
        if (el_d11[i].checked) {
            count += 1;
        }
    }

    if (el_d11.length === count) {
        checkAll_d11.checked = true;
    } else {
        checkAll_d11.checked = false;
    }
};




//「全て選択」のチェックボックスをクリックした時
checkAll_d11.addEventListener("click",() => {
    funcCheckAll_d11(checkAll_d11.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el_d11.length; i++) {
    el_d11[i].addEventListener("click", funcCheck_d11, false);
}


