function formSwitch() {
    hoge = document.getElementsByName('maker');

    if (hoge[0].checked) {
        // 好きな食べ物が選択されたら下記を実行します
        document.getElementById('zenken').style.display = "";
        document.getElementById('gairai').style.display = "none";
        document.getElementById('renkei').style.display = "none";
        document.getElementById('sonota').style.display = "none";
    } else if (hoge[1].checked) {
        // 好きな場所が選択されたら下記を実行します
        document.getElementById('zenken').style.display = "none";
        document.getElementById('gairai').style.display = "";
        document.getElementById('renkei').style.display = "none";
        document.getElementById('sonota').style.display = "none";
    } 
    else if (hoge[2].checked) {
        // 好きな場所が選択されたら下記を実行します
        document.getElementById('zenken').style.display = "none";
        document.getElementById('gairai').style.display = "none";
        document.getElementById('renkei').style.display = "";
        document.getElementById('sonota').style.display = "none";
    } 
    else if (hoge[3].checked) {
        // 好きな場所が選択されたら下記を実行します
        document.getElementById('zenken').style.display = "none";
        document.getElementById('gairai').style.display = "none";
        document.getElementById('renkei').style.display = "none";
        document.getElementById('sonota').style.display = "";
    } 
    else {
        document.getElementById('zenken').style.display = "none";
        document.getElementById('gairai').style.display = "none";
        document.getElementById('renkei').style.display = "none";
        document.getElementById('sonota').style.display = "none";
    }
}
window.addEventListener('load', formSwitch());
