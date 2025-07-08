function formSwitch() {
    hoge = document.getElementsByName('maker');

    if (hoge[0].checked) {
        // 全件
        //document.getElementById('zenken').style.display = "";
        var g = document.getElementsByClassName('gairai');
        for(var i = 0; i < g.length; i++) {
            g[i].style.display = "";
        }
        var r = document.getElementsByClassName('renkei');
        for(var i = 0; i < r.length; i++) {
            r[i].style.display = "";
        }
        var s = document.getElementsByClassName('sonota');
        for(var i = 0; i < s.length; i++) {
            s[i].style.display = "";
        }
    } else if (hoge[1].checked) {
        // 外来
        //document.getElementById('zenken').style.display = "none";
        //document.getElementsByClassName('gairai').style.display = "";
        var g = document.getElementsByClassName('gairai');
        for(var i = 0; i < g.length; i++) {
            g[i].style.display = "";
        }
        var r = document.getElementsByClassName('renkei');
        for(var i = 0; i < r.length; i++) {
            r[i].style.display = "none";
        }
        var s = document.getElementsByClassName('sonota');
        for(var i = 0; i < s.length; i++) {
            s[i].style.display = "none";
        }
    } 
    else if (hoge[2].checked) {
        // 連携
        //document.getElementById('zenken').style.display = "none";
        var g = document.getElementsByClassName('gairai');
        for(var i = 0; i < g.length; i++) {
            g[i].style.display = "none";
        }
        var r = document.getElementsByClassName('renkei');
        for(var i = 0; i < r.length; i++) {
            r[i].style.display = "";
        }
        var s = document.getElementsByClassName('sonota');
        for(var i = 0; i < s.length; i++) {
            s[i].style.display = "none";
        }
    } 
    else if (hoge[3].checked) {
        // その他
        //document.getElementById('zenken').style.display = "none";
        var g = document.getElementsByClassName('gairai');
        for(var i = 0; i < g.length; i++) {
            g[i].style.display = "none";
        }
        var r = document.getElementsByClassName('renkei');
        for(var i = 0; i < r.length; i++) {
            r[i].style.display = "none";
        }
        var s = document.getElementsByClassName('sonota');
        for(var i = 0; i < s.length; i++) {
            s[i].style.display = "";
        }
    } 
/*    else {
        //document.getElementById('zenken').style.display = "none";
        document.getElementById('gairai').style.display = "none";
        document.getElementById('renkei').style.display = "none";
        document.getElementById('sonota').style.display = "none";
    }
*/
}

window.addEventListener('load', formSwitch());
