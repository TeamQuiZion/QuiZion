// カウントダウン
let timeLeft = 3;
const choice1 = document.getElementById('choice1');
const toggleElement = document.getElementById('toggleElement');

document.addEventListener("DOMContentLoaded", function () {
  const loadingScreen = document.getElementById('loading-screen');
  const mainContent = document.getElementById('main-content');

  function updateCountdown() {
    if (timeLeft > 0) {
      loadingScreen.textContent = timeLeft;
    } else if (timeLeft === 0) {
      loadingScreen.textContent = "GO!";
    } else {
      clearInterval(countdownInterval);
      loadingScreen.style.display = "none";   // ローディング画面を消す
      mainContent.style.display = "block";    // メインコンテンツ表示
    }
    timeLeft--;
  }

  updateCountdown(); // 初回表示
  const countdownInterval = setInterval(updateCountdown, 1000);
});

// 選択が押された時の正誤の〇✖
//解答を見るボタンを押したら解答が見えるイベント
choice1.addEventListener('click', () => {
    if(toggleElement.style.display === 'none') { 
        toggleElement.style.display = 'block';
    } else {
        toggleElement.style.display = 'none';
    }
    const overlay = document.getElementById('overlay');
    overlay.style.display = 'flex'; // 画面中央に〇を表示
    setTimeout(() => {
        overlay.style.display = 'none'; // 1秒後に非表示
    }, 1000);
});