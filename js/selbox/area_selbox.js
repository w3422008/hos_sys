/* 高橋20230512 */
//１）都道府県→地域、地区コード
function change() {
if (document.getElementById("selbox").value) {
selboxValue = document.getElementById("selbox").value;
if (selboxValue == "岡山県") {
    //『岡山県』を表示
    document.getElementById("area1").style.display = ""; //地域
    document.getElementById("are_cd1").style.display = ""; //地区コード
    //『広島県』を非表示
    document.getElementById("area2").style.display = "none"; //地域
    document.getElementById("are_cd2").style.display = "none"; //地区コード
        //値のクリア
        document.getElementById("area2").value = "";
        document.getElementById("are_cd2").value = "";

} else if (selboxValue == "広島県") {
    //『広島県』を表示
    document.getElementById("area2").style.display = ""; //地域
    document.getElementById("are_cd2").style.display = ""; //地区コード
    //『岡山県』を非表示
    document.getElementById("area1").style.display = "none"; //地域
    document.getElementById("are_cd1").style.display = "none"; //地区コード
        //値のクリア
        document.getElementById("area1").value = "";
        document.getElementById("are_cd1").value = "";
}
//値のクリア
document.getElementById("city").value = "";
document.getElementById("zone").value = "";
document.getElementById("town").value = "";
document.getElementById("str_num").value = "";

}
}


//２）地域＝地区コード→市・区・町
function change2() {
selboxValue = document.getElementById("selbox").value;
    //値の取得
    if (selboxValue == "岡山県") {
        areaName = document.getElementById("area1").value; 
    } else if (selboxValue == "広島県"){
        areaName = document.getElementById("area2").value; 
    }
    
    //配列
    Object.keys(areaCd_array).forEach(function(key){
        //値の代入
        if(areaName == this[key]['area2']) {
            if (selboxValue == "岡山県") {
            document.getElementById("are_cd1").value = String( this[key]['sec_cd'] );
            } else if (selboxValue == "広島県"){
            document.getElementById("are_cd2").value = String( this[key]['sec_cd'] );
            }
            document.getElementById("city").value = this[key]['city'];
            document.getElementById("zone").value = this[key]['zone'];
            document.getElementById("town").value = this[key]['town'];
            document.getElementById("str_num").value = "";

        }else if(areaName == "") {
            if (selboxValue == "岡山県") {
            document.getElementById("are_cd1").value = "";
            } else if (selboxValue == "広島県"){
            document.getElementById("are_cd2").value = "";
            }
            document.getElementById("city").value = "";
            document.getElementById("zone").value = "";
            document.getElementById("town").value = "";
            document.getElementById("str_num").value = "";

        }
    }, areaCd_array);
}
/* 高橋20230512 */


//２＋α）地区コード＝地域
function change3() {
selboxValue = document.getElementById("selbox").value;
    //値の取得
    if (selboxValue == "岡山県") {
        areaCd = document.getElementById("are_cd1").value; 
    } else if (selboxValue == "広島県"){
        areaCd = document.getElementById("are_cd2").value; 
    }
    
    //配列
    Object.keys(areaCd_array).forEach(function(key){
        //値の代入
        if(areaCd == this[key]['sec_cd']) {
            if (selboxValue == "岡山県") {
            document.getElementById("area1").value = String( this[key]['area2'] );
            } else if (selboxValue == "広島県"){
            document.getElementById("area2").value = String( this[key]['area2'] );
            }
            document.getElementById("city").value = this[key]['city'];
            document.getElementById("zone").value = this[key]['zone'];
            document.getElementById("town").value = this[key]['town'];
            document.getElementById("str_num").value = "";

        }else if(areaCd == "") {
            if (selboxValue == "岡山県") {
            document.getElementById("area1").value = "";
            } else if (selboxValue == "広島県"){
            document.getElementById("area2").value = "";
            }
            document.getElementById("city").value = "";
            document.getElementById("zone").value = "";
            document.getElementById("town").value = "";
            document.getElementById("str_num").value = "";

        }
    }, areaCd_array);
}