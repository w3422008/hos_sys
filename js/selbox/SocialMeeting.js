/* 高橋20231121 懇話会追加 */
    function plus($ins) {
        if ($ins===0){ //附
            textbox_element = document.getElementById("txt_sm1");
            new_element = document.getElementById("years_kurashiki").value;
        } else if($ins===1) { //総C
            textbox_element = document.getElementById("txt_sm2");
            new_element = document.getElementById("years_okayama1").value;
        } else if($ins===2) { //高齢C
            textbox_element = document.getElementById("txt_sm3");
            new_element = document.getElementById("years_okayama2").value;
        }
        textbox_element.value += new_element+"\r\n";
        //console.log(textbox_element.value);
    }
/* 高橋20231121 懇話会追加 */

/* 高橋20231122　懇話会バリデーション */
function arr_strCheck($ins){

    if ($ins===0){ //附
        input_txt = document.getElementById("txt_sm1").value; //入力値
        err_elem = document.getElementById("err_sm1"); //エラー表示の場所
    } else if($ins===1) { //総C
        input_txt = document.getElementById("txt_sm2").value; //入力値
        err_elem = document.getElementById("err_sm2"); //エラー表示の場所
    } else if($ins===2) { //高齢C
        input_txt = document.getElementById("txt_sm3").value; //入力値
        err_elem = document.getElementById("err_sm3"); //エラー表示の場所
    }
    var errorMessage = "西暦(半角数字4桁)で入力してください"; //エラー内容
    var arr = input_txt.split(/\r\n|\n/); //入力値を配列に保存
    let every = arr.every(elem => {
        if(isNaN(elem) == false && (elem.length==0 ||elem.length==4)){return true;}else{return false;}
     } );

    //console.log(every);
    if(every === true){ //エラーが無ければ：エラー非表示＆true
        err_elem.style.display = "none";
        return true; /* 20231128高橋 懇話会アラート */
    } else { //エラーがあれば：エラー表示＆false
        err_elem.textContent = errorMessage;
        err_elem.style.display = "";
        return false; /* 20231128高橋 懇話会アラート */
    }
};
/* 高橋20231122　懇話会バリデーション */