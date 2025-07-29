// カウントダウン


document.addEventListener("DOMContentLoaded", function () {
  let timeLeft = 3;
  const choice1 = document.getElementById('choice1');
  const toggleElement = document.getElementById('toggleElement');
  let isOverlayShown = false; // フラグを追加
  const loadingScreen = document.getElementById('loading-screen');
  const mainContent = document.getElementById('main-content');

  function updateCountdown() {
    if (timeLeft > 0) {
      loadingScreen.textContent = timeLeft;
    } else if (timeLeft === 0) {
      loadingScreen.textContent = "GO!";
    } else {
      clearInterval(countdownInterval);
      loadingScreen.style.transition = "transform 1s ease, opacity 1s ease"; // アニメーション設定
      loadingScreen.style.transform = "translateY(100%)"; // 下に移動
      loadingScreen.style.opacity = "0"; // フェードアウト
      setTimeout(() => {
        loadingScreen.style.display = "none"; // アニメーション後に非表示
        mainContent.style.display = "block"; // メインコンテンツ表示
      }, 1000); // アニメーション時間と一致
    }
    timeLeft--;
  }

  updateCountdown(); // 初回表示
  const countdownInterval = setInterval(updateCountdown, 1000);

    // 解答を見るボタン
  if (choice1) {
    choice1.addEventListener('click', () => {
      if (toggleElement.style.display === 'none') {
        toggleElement.style.display = 'block';
        //表示してからスクロール
        setTimeout(() => {
          toggleElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        },10);
      } else {
        toggleElement.style.display = 'none';
      }
    });
  }

  

  // 選択肢ボタンのクリックイベント
  const buttons = document.querySelectorAll('.choice-btn');
  const overlay = document.getElementById('overlay');
  buttons.forEach(button => {
    button.addEventListener('click', function () {
      if (!isOverlayShown) { // フラグがfalseの場合のみ実行
        isOverlayShown = true; // フラグをtrueに設定
        const selectedChoice = parseInt(this.dataset.choice);
        if (selectedChoice === correctAnswer) {
          overlay.innerHTML = '<div class="circle">○</div>'; // ○を表示
          overlay.style.display = 'flex'; // 画面中央に○を表示
        } else {
          overlay.innerHTML = '<div class="cross">×</div>'; // ×を表示
          overlay.style.display = 'flex'; // 画面中央に×を表示
        }


        setTimeout(() => {
          overlay.style.display = 'none'; // 1秒後に非表示
          isOverlayShown = false; // フラグをリセット
          // 解答と解説を表示
          if (toggleElement.style.display === 'none') {
            toggleElement.style.display = 'block';
          }

          // 解答と解説を画面中央にスクロール
          toggleElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 900);
      }
    });
  });
});

// 選択が押された時の正誤の〇✖
//解答を見るボタンを押したら解答が見えるイベント



// const correctChoice = document.getElementById('correctChoice'); // ウのボタンを取得

// correctChoice.addEventListener('click', () => {
//   if (!isOverlayShown) { // フラグがfalseの場合のみ実行
//     isOverlayShown = true; // フラグをtrueに設定
//     const overlay = document.getElementById('overlay');
//     overlay.innerHTML = '<div class="circle">○</div>'; // ○を表示
//     overlay.style.display = 'flex'; // 画面中央に○を表示

//     setTimeout(() => {
//       overlay.style.display = 'none'; // 1秒後に非表示
//       isOverlayShown = false; // フラグをリセット

//       // 解答と解説を表示
//       if (toggleElement.style.display === 'none') {
//         toggleElement.style.display = 'block';
//       }

//       // 解答と解説を画面中央にスクロール
//       toggleElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
//     }, 900);
//   }
// });

// // ア、イ、エのボタンを取得
// const incorrectChoices = document.querySelectorAll('.choice:not(#correctChoice)');

// incorrectChoices.forEach(choice => {
//   choice.addEventListener('click', () => {
//     if (!isOverlayShown) { // フラグがfalseの場合のみ実行
//       isOverlayShown = true; // フラグをtrueに設定
//       const overlay = document.getElementById('overlay');
//       overlay.innerHTML = '<div class="cross">×</div>'; // ×を表示
//       overlay.style.display = 'flex'; // 画面中央に×を表示

//       // アニメーション終了後に非表示
//       setTimeout(() => {
//         overlay.style.display = 'none'; // 1秒後に非表示
//         isOverlayShown = false; // フラグをリセット

//         // 解答と解説を表示
//         if (toggleElement.style.display === 'none') {
//           toggleElement.style.display = 'block';
//         }

//         // 解答と解説を画面中央にスクロール
//         toggleElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
//       }, 900);
//     }
//   });
// });

