//すべて選択
//「全て選択」のチェックボックス
let checkAll = document.getElementById("All");
//「全て選択」以外のチェックボックス
let el = document.getElementsByClassName("all");

//全てのチェックボックスをON/OFFする
const funcCheckAll = (bool) => {
    for (let i = 0; i < el.length; i++) {
        el[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheck = () => {
    let count = 0;
    for (let i = 0; i < el.length; i++) {
        if (el[i].checked) {
            count += 1;
        }
    }

    if (el.length === count) {
        checkAll.checked = true;
    } else {
        checkAll.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAll.addEventListener("click",() => {
    funcCheckAll(checkAll.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < el.length; i++) {
    el[i].addEventListener("click", funcCheck, false);
}


//月曜日
//「全て選択」のチェックボックス
let checkAllmod = document.getElementById("Mon");
//「全て選択」以外のチェックボックス
let elmod = document.getElementsByClassName("MONDAY");

//全てのチェックボックスをON/OFFする
const funcCheckAllmod = (bool) => {
    for (let i = 0; i < elmod.length; i++) {
        elmod[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheckmod = () => {
    let count = 0;
    for (let i = 0; i < elmod.length; i++) {
        if (elmod[i].checked) {
            count += 1;
        }
    }

    if (elmod.length === count) {
        checkAllmod.checked = true;
    } else {
        checkAllmod.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllmod.addEventListener("click",() => {
    funcCheckAllmod(checkAllmod.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elmod.length; i++) {
    elmod[i].addEventListener("click", funcCheckmod, false);
}


//火曜日
//「全て選択」のチェックボックス
let checkAlltud = document.getElementById("Tue");
//「全て選択」以外のチェックボックス
let eltud = document.getElementsByClassName("TUESDAY");

//全てのチェックボックスをON/OFFする
const funcCheckAlltud = (bool) => {
    for (let i = 0; i < eltud.length; i++) {
        eltud[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcChecktud = () => {
    let count = 0;
    for (let i = 0; i < eltud.length; i++) {
        if (eltud[i].checked) {
            count += 1;
        }
    }

    if (eltud.length === count) {
        checkAlltud.checked = true;
    } else {
        checkAlltud.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAlltud.addEventListener("click",() => {
    funcCheckAlltud(checkAlltud.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < eltud.length; i++) {
    eltud[i].addEventListener("click", funcChecktud, false);
}


//水曜日
//「全て選択」のチェックボックス
let checkAllwed = document.getElementById("Wed");
//「全て選択」以外のチェックボックス
let elwed = document.getElementsByClassName("WEDNESDAY");

//全てのチェックボックスをON/OFFする
const funcCheckAllwed = (bool) => {
    for (let i = 0; i < elwed.length; i++) {
        elwed[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheckwed = () => {
    let count = 0;
    for (let i = 0; i < elwed.length; i++) {
        if (elwed[i].checked) {
            count += 1;
        }
    }

    if (elwed.length === count) {
        checkAllwed.checked = true;
    } else {
        checkAllwed.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllwed.addEventListener("click",() => {
    funcCheckAllwed(checkAllwed.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elwed.length; i++) {
    elwed[i].addEventListener("click", funcCheckwed, false);
}


//木曜日
//「全て選択」のチェックボックス
let checkAllthd = document.getElementById("Thu");
//「全て選択」以外のチェックボックス
let elthd = document.getElementsByClassName("THURSDAY");

//全てのチェックボックスをON/OFFする
const funcCheckAllthd = (bool) => {
    for (let i = 0; i < elthd.length; i++) {
        elthd[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheckthd = () => {
    let count = 0;
    for (let i = 0; i < elthd.length; i++) {
        if (elthd[i].checked) {
            count += 1;
        }
    }

    if (elthd.length === count) {
        checkAllthd.checked = true;
    } else {
        checkAllthd.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllthd.addEventListener("click",() => {
    funcCheckAllthd(checkAllthd.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elthd.length; i++) {
    elthd[i].addEventListener("click", funcCheckthd, false);
}


//金曜日
//「全て選択」のチェックボックス
let checkAllfrd = document.getElementById("Fri");
//「全て選択」以外のチェックボックス
let elfrd = document.getElementsByClassName("FRIDAY");

//全てのチェックボックスをON/OFFする
const funcCheckAllfrd = (bool) => {
    for (let i = 0; i < elfrd.length; i++) {
        elfrd[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheckfrd = () => {
    let count = 0;
    for (let i = 0; i < elfrd.length; i++) {
        if (elfrd[i].checked) {
            count += 1;
        }
    }

    if (elfrd.length === count) {
        checkAllfrd.checked = true;
    } else {
        checkAllfrd.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllfrd.addEventListener("click",() => {
    funcCheckAllfrd(checkAllfrd.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elfrd.length; i++) {
    elfrd[i].addEventListener("click", funcCheckfrd, false);
}


//土曜日
//「全て選択」のチェックボックス
let checkAllsad = document.getElementById("Sat");
//「全て選択」以外のチェックボックス
let elsad = document.getElementsByClassName("SATURDAY");

//全てのチェックボックスをON/OFFする
const funcCheckAllsad = (bool) => {
    for (let i = 0; i < elsad.length; i++) {
        elsad[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcChecksad = () => {
    let count = 0;
    for (let i = 0; i < elsad.length; i++) {
        if (elsad[i].checked) {
            count += 1;
        }
    }

    if (elsad.length === count) {
        checkAllsad.checked = true;
    } else {
        checkAllsad.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllsad.addEventListener("click",() => {
    funcCheckAllsad(checkAllsad.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elsad.length; i++) {
    elsad[i].addEventListener("click", funcChecksad, false);
}


//日曜日
//「全て選択」のチェックボックス
let checkAllsud = document.getElementById("Sun");
//「全て選択」以外のチェックボックス
let elsud = document.getElementsByClassName("SUNDAY");

//全てのチェックボックスをON/OFFする
const funcCheckAllsud = (bool) => {
    for (let i = 0; i < elsud.length; i++) {
        elsud[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcChecksud = () => {
    let count = 0;
    for (let i = 0; i < elsud.length; i++) {
        if (elsud[i].checked) {
            count += 1;
        }
    }

    if (elsud.length === count) {
        checkAllsud.checked = true;
    } else {
        checkAllsud.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllsud.addEventListener("click",() => {
    funcCheckAllsud(checkAllsud.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elsud.length; i++) {
    elsud[i].addEventListener("click", funcChecksud, false);
}


//午前
//「全て選択」のチェックボックス
let checkAllam = document.getElementById("AM");
//「全て選択」以外のチェックボックス
let elam = document.getElementsByClassName("am");

//全てのチェックボックスをON/OFFする
const funcCheckAllam = (bool) => {
    for (let i = 0; i < elam.length; i++) {
        elam[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheckam = () => {
    let count = 0;
    for (let i = 0; i < elam.length; i++) {
        if (elam[i].checked) {
            count += 1;
        }
    }

    if (elam.length === count) {
        checkAllam.checked = true;
    } else {
        checkAllam.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllam.addEventListener("click",() => {
    funcCheckAllam(checkAllam.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elam.length; i++) {
    elam[i].addEventListener("click", funcCheckam, false);
}


//午後
//「全て選択」のチェックボックス
let checkAllpm = document.getElementById("PM");
//「全て選択」以外のチェックボックス
let elpm = document.getElementsByClassName("pm");

//全てのチェックボックスをON/OFFする
const funcCheckAllpm = (bool) => {
    for (let i = 0; i < elpm.length; i++) {
        elpm[i].checked = bool;
    }
}

//「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
const funcCheckpm = () => {
    let count = 0;
    for (let i = 0; i < elpm.length; i++) {
        if (elpm[i].checked) {
            count += 1;
        }
    }

    if (elpm.length === count) {
        checkAllpm.checked = true;
    } else {
        checkAllpm.checked = false;
    }
};

//「全て選択」のチェックボックスをクリックした時
checkAllpm.addEventListener("click",() => {
    funcCheckAllpm(checkAllpm.checked);
},false);

//「全て選択」以外のチェックボックスをクリックした時
for (let i = 0; i < elpm.length; i++) {
    elpm[i].addEventListener("click", funcCheckpm, false);
}
