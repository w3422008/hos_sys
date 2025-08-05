(function() {
    var logoutUrl = 'http://localhost:8080/hos_sys/login/logout.php';
    var timeout = 60* 60 * 1000; // 15秒（ミリ秒）
    var countdownStart = 10; // 10秒前からカウントダウン
    var timer, countdownTimer;
    var countdownTab = null;

    function removeCountdownTab() {
        if (countdownTab && countdownTab.parentNode) {
            countdownTab.parentNode.removeChild(countdownTab);
            countdownTab = null;
        }
    }

    function showCountdownTab(seconds) {
        if (!countdownTab) {
            countdownTab = document.createElement('div');
            countdownTab.id = 'auto-logout-countdown-tab';
            document.body.appendChild(countdownTab);
        }
        countdownTab.textContent = 'あと' + seconds + '秒でログアウトされます';
    }

    function startCountdown() {
        var remain = countdownStart;
        showCountdownTab(remain);
        countdownTimer = setInterval(function() {
            remain--;
            if (remain > 0) {
                showCountdownTab(remain);
            } else {
                removeCountdownTab();
                clearInterval(countdownTimer);
            }
        }, 1000);
    }

    function resetTimer() {
        clearTimeout(timer);
        clearInterval(countdownTimer);
        removeCountdownTab();
        timer = setTimeout(function() {
            startCountdown();
            timer = setTimeout(function() {
                window.location.href = logoutUrl;
            }, countdownStart * 1000);
        }, timeout - countdownStart * 1000);
    }

    ['mousemove', 'mousedown', 'keydown', 'touchstart', 'wheel'].forEach(function(evt) {
        document.addEventListener(evt, resetTimer, true);
    });

    resetTimer();
})();