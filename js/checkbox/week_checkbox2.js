
/* 診察日 全選択 */
    //「全て選択」のチェックボックス
    let checkAll1 = document.getElementById("All1");
    //「全て選択」以外のチェックボックス
    let el1 = document.getElementsByClassName("diagnosis");

    //全てのチェックボックスをON/OFFする
    const funcCheckAll1 = (bool) => {
        for (let i = 0; i < el1.length; i++) {
            el1[i].checked = bool;
        }
    }

    //「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
    const funcCheck1 = () => {
        let count = 0;
        for (let i = 0; i < el1.length; i++) {
            if (el1[i].checked) {
                count += 1;
            }
        }

        if (el1.length === count) {
            checkAll1.checked = true;
        } else {
            checkAll1.checked = false;
        }
    };

    //「全て選択」のチェックボックスをクリックした時
    checkAll1.addEventListener("click",() => {
        funcCheckAll1(checkAll1.checked);
    },false);

    //「全て選択」以外のチェックボックスをクリックした時
    for (let i = 0; i < el1.length; i++) {
        el1[i].addEventListener("click", funcCheck1, false);
    }


/* 手術日 全選択 */
    //「全て選択」のチェックボックス
    let checkAll2 = document.getElementById("All2");
    //「全て選択」以外のチェックボックス
    let el2 = document.getElementsByClassName("surgery");

    //全てのチェックボックスをON/OFFする
    const funcCheckAll2 = (bool) => {
        for (let i = 0; i < el2.length; i++) {
            el2[i].checked = bool;
        }
    }

    //「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
    const funcCheck2 = () => {
        let count = 0;
        for (let i = 0; i < el2.length; i++) {
            if (el2[i].checked) {
                count += 1;
            }
        }

        if (el2.length === count) {
            checkAll2.checked = true;
        } else {
            checkAll2.checked = false;
        }
    };

    //「全て選択」のチェックボックスをクリックした時
    checkAll2.addEventListener("click",() => {
        funcCheckAll2(checkAll2.checked);
    },false);

    //「全て選択」以外のチェックボックスをクリックした時
    for (let i = 0; i < el2.length; i++) {
        el2[i].addEventListener("click", funcCheck2, false);
    }



/* 祝日 */
    //「全て選択」のチェックボックス
    let checkAllhod = document.getElementById("Hol");
    //「全て選択」以外のチェックボックス
    let elhod = document.getElementsByClassName("HOLIDAY");

    //全てのチェックボックスをON/OFFする
    const funcCheckAllhod = (bool) => {
        for (let i = 0; i < elhod.length; i++) {
            elhod[i].checked = bool;
        }
    }

    //「checks」のclassを持つ要素のチェック状態で「全て選択」のチェック状態をON/OFFする
    const funcCheckhod = () => {
        let count = 0;
        for (let i = 0; i < elhod.length; i++) {
            if (elhod[i].checked) {
                count += 1;
            }
        }

        if (elhod.length === count) {
            checkAllhod.checked = true;
        } else {
            checkAllhod.checked = false;
        }
    };

    //「全て選択」のチェックボックスをクリックした時
    checkAllhod.addEventListener("click",() => {
        funcCheckAllhod(checkAllhod.checked);
    },false);

    //「全て選択」以外のチェックボックスをクリックした時
    for (let i = 0; i < elhod.length; i++) {
        elhod[i].addEventListener("click", funcCheckhod, false);
    }

