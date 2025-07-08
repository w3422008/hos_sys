//岡山県
//「全て選択」のチェックボックス
let checkAllall = document.getElementById("ALL");
//「全て選択」以外のチェックボックス
let elall = document.getElementsByClassName("All");

//全てのチェックボックスをON/OFFする
const funcCheckAllall = (bool) => {
    for (let i = 0; i < elall.length; i++) {
        elall[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheckall = () => {
    let count = 0;
    for (let i = 0; i < elall.length; i++) {
        if (elall[i].checked) {
            count += 1;
        }
    }

    if (elall.length === count) {
        checkAllall.checked = true;
    } else {
        checkAllall.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllall.addEventListener("click",() => {
    funcCheckAllall(checkAllall.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elall.length; i++) {
    elall[i].addEventListener("click", funcCheckall, false);
}


//県南東部
//「全て選択」のチェックボックス
let checkAllea = document.getElementById("EAST");
//「全て選択」以外のチェックボックス
let elea = document.getElementsByClassName("east");

//全てのチェックボックスをON/OFFする
const funcCheckAllea = (bool) => {
    for (let i = 0; i < elea.length; i++) {
        elea[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheckea = () => {
    let count = 0;
    for (let i = 0; i < elea.length; i++) {
        if (elea[i].checked) {
            count += 1;
        }
    }

    if (elea.length === count) {
        checkAllea.checked = true;
    } else {
        checkAllea.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllea.addEventListener("click",() => {
    funcCheckAllea(checkAllea.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elea.length; i++) {
    elea[i].addEventListener("click", funcCheckea, false);
}


//県南西部
//「全て選択」のチェックボックス
let checkAllwe = document.getElementById("WEST");
//「全て選択」以外のチェックボックス
let elwe = document.getElementsByClassName("west");

//全てのチェックボックスをON/OFFする
const funcCheckAllwe = (bool) => {
    for (let i = 0; i < elwe.length; i++) {
        elwe[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheckwe = () => {
    let count = 0;
    for (let i = 0; i < elwe.length; i++) {
        if (elwe[i].checked) {
            count += 1;
        }
    }

    if (elwe.length === count) {
        checkAllwe.checked = true;
    } else {
        checkAllwe.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllwe.addEventListener("click",() => {
    funcCheckAllwe(checkAllwe.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elwe.length; i++) {
    elwe[i].addEventListener("click", funcCheckwe, false);
}


//高梁・新見
//「全て選択」のチェックボックス
let checkAlltani = document.getElementById("TANI");
//「全て選択」以外のチェックボックス
let eltani = document.getElementsByClassName("tani");

//全てのチェックボックスをON/OFFする
const funcCheckAlltani = (bool) => {
    for (let i = 0; i < eltani.length; i++) {
        eltani[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcChecktani = () => {
    let count = 0;
    for (let i = 0; i < eltani.length; i++) {
        if (eltani[i].checked) {
            count += 1;
        }
    }

    if (eltani.length === count) {
        checkAlltani.checked = true;
    } else {
        checkAlltani.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAlltani.addEventListener("click",() => {
    funcCheckAlltani(checkAlltani.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < eltani.length; i++) {
    eltani[i].addEventListener("click", funcChecktani, false);
}


//真庭
//「全て選択」のチェックボックス
let checkAllmani = document.getElementById("MANI");
//「全て選択」以外のチェックボックス
let elmani = document.getElementsByClassName("mani");

//全てのチェックボックスをON/OFFする
const funcCheckAllmani = (bool) => {
    for (let i = 0; i < elmani.length; i++) {
        elmani[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheckmani = () => {
    let count = 0;
    for (let i = 0; i < elmani.length; i++) {
        if (elmani[i].checked) {
            count += 1;
        }
    }

    if (elmani.length === count) {
        checkAllmani.checked = true;
    } else {
        checkAllmani.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllmani.addEventListener("click",() => {
    funcCheckAllmani(checkAllmani.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elmani.length; i++) {
    elmani[i].addEventListener("click", funcCheckmani, false);
}


//津山・英田
//「全て選択」のチェックボックス
let checkAlltua = document.getElementById("TUA");
//「全て選択」以外のチェックボックス
let eltua = document.getElementsByClassName("tua");

//全てのチェックボックスをON/OFFする
const funcCheckAlltua = (bool) => {
    for (let i = 0; i < eltua.length; i++) {
        eltua[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcChecktua = () => {
    let count = 0;
    for (let i = 0; i < eltua.length; i++) {
        if (eltua[i].checked) {
            count += 1;
        }
    }

    if (eltua.length === count) {
        checkAlltua.checked = true;
    } else {
        checkAlltua.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAlltua.addEventListener("click",() => {
    funcCheckAlltua(checkAlltua.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < eltua.length; i++) {
    eltua[i].addEventListener("click", funcChecktua, false);
}