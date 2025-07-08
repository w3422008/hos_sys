/* document.getElementById("save").onclick = function() {
    let checkSaveFlg = window.confirm('更新内容が消えてしまいますがよろしいでしょうか？');
    if(checkSaveFlg) {
        window.location.href = "alerat.php"; 
        ///header('Location:../search/search_control.php');
    } else {
      document.getElementById("saveResult").textContent = ""; //ここはそのまま
    }
  };
*/



var submit_flg = false;

// ページ遷移時に確認ダイアログの設定
window.addEventListener('beforeunload', function(e) {
  if( submit_flg ) {
    e.preventDefault();
    e.returnValue = '他のページに移動しますか？';
    submit_flg = false; //★最後にsubmit_flg値初期化
  }
});

// 確認ダイヤログ表示させる場合：submit_flgをtrueに
var form = document.getElementById('form');
form.addEventListener('submit', function(e) {
  submit_flg = true;
});



