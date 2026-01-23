/**
 * フォーム送信時の未入力チェックと入力値検証
 */

// フォーム送信時の検証メイン関数
function Check(){
    //未入力チェック
    let array = [];
    
    if(document.myform.hos_cd.value==""){array.push('医療機関コード'); }
    if(document.myform.hos_name.value==""){array.push('医療機関名'); }
    if(document.myform.zipcode.value==""){array.push('郵便番号'); }
    if(document.myform.pre.value==""){array.push('都道府県'); }
    if(document.myform.are_cd1.value==""&&document.myform.are_cd2.value==""){array.push('地区コード'); }
    if(document.myform.area1.value==""&&document.myform.area2.value==""){array.push('地域'); }

    //入力値チェック
    let array2 = [];
    if(typeof arr_strCheck !== 'undefined') {
        if(arr_strCheck(0)==false || arr_strCheck(1)==false || arr_strCheck(2)==false){
            array2.push('「医療連携懇話会 参加年度(連携状況タブ)」');
        }
    }

    // エラー処理
    if(array.length !== 0){
        alert(array.join('・') + "は必ず入力してください。");
        return false;
    } else if(array2.length !== 0){
        alert(array2.join('、') + "の入力に誤りがあります。");
        return false;
    } else {
        return true;
    }
}