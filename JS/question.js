document.addEventListener("DOMContentLoaded", function () {
  const loadingScreen = document.getElementById('loading-screen');
  const mainContent   = document.getElementById('main-content');
  const overlay       = document.getElementById('overlay');
  const nextBtn       = document.getElementById('next-btn');
  const hiddenAnswer  = document.getElementById('hidden-answer');
  let busy = false;

  // カウントダウン
  function runCountdown(callback) {
    let timeLeft = 3;
    function update() {
      if (!loadingScreen) return;
      if (timeLeft > 0) {
        loadingScreen.textContent = timeLeft;
      } else if (timeLeft === 0) {
        loadingScreen.textContent = "GO!";
      } else {
        clearInterval(t);
        loadingScreen.style.transition = "transform 1s, opacity 1s";
        loadingScreen.style.transform = "translateY(100%)";
        loadingScreen.style.opacity = "0";
        setTimeout(() => {
          loadingScreen.style.display = "none";
          if (mainContent) mainContent.style.display = "block"; // ←ここを追加
          if (callback) callback();
        }, 1000);
      }
      timeLeft--;
    }
    update();
    const t = setInterval(update, 1000);
  }

  // 初回だけカウントダウン
  if (typeof isFirst !== "undefined" && isFirst && loadingScreen) {
    mainContent.style.display = "none";
    runCountdown();
  } else {
    if (loadingScreen) loadingScreen.style.display = "none";
    if (mainContent)   mainContent.style.display   = "block";
  }

  // ○×演出→解説スクロール→「次の問題へ」ボタン表示
  function showMarkAndScroll(selectedValue) {
    if (busy || !overlay) return;
    busy = true;
    const isCorrect = (parseInt(selectedValue, 10) === parseInt(correctAnswer, 10));
    overlay.innerHTML = isCorrect ? '<div class="circle">○</div>' : '<div class="cross">×</div>';
    overlay.style.display = 'flex';

    setTimeout(() => {
      overlay.style.display = 'none';
      // 正解表示
      const showCorrect = document.getElementById('show-correct');
      if (showCorrect) {
        // 正解番号→記号のみ
        const correctNum = parseInt(correctAnswer, 10);
        let correctMark = '';
        switch (correctNum) {
          case 1: correctMark = 'ア'; break;
          case 2: correctMark = 'イ'; break;
          case 3: correctMark = 'ウ'; break;
          case 4: correctMark = 'エ'; break;
        }
        showCorrect.textContent = `正解：${correctMark}`;
        showCorrect.style.display = "block";
      }
      // 解説までスクロール
      const explanation = document.getElementById('explanation');
      if (explanation) {
        explanation.style.display = "block";
        explanation.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      // 「次の問題へ」ボタンを表示
      if (nextBtn && hiddenAnswer) {
        hiddenAnswer.value = selectedValue;
        nextBtn.style.display = "inline-block";
      }
    }, 900);
  }

  // ボタン選択時
  const buttons = document.querySelectorAll('.choice-btn');
  if (buttons.length) {
    buttons.forEach((btn) => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        showMarkAndScroll(this.value);
      });
    });
  }

  // 「解説を見る」ボタンの処理
  const showExplanationBtn = document.getElementById('show-explanation-btn');
  if (showExplanationBtn) {
    showExplanationBtn.addEventListener('click', function () {
      // 解説表示
      const explanation = document.getElementById('explanation');
      if (explanation) {
        explanation.style.display = "block";
        explanation.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      // 正解表示も出す場合は下記を有効化
      // const showCorrect = document.getElementById('show-correct');
      // if (showCorrect) {
      //   const correctNum = parseInt(correctAnswer, 10);
      //   let correctMark = '';
      //   switch (correctNum) {
      //     case 1: correctMark = 'ア'; break;
      //     case 2: correctMark = 'イ'; break;
      //     case 3: correctMark = 'ウ'; break;
      //     case 4: correctMark = 'エ'; break;
      //   }
      //   showCorrect.textContent = `正解：${correctMark}`;
      //   showCorrect.style.display = "block";
      // }
      // 「次の問題へ」ボタンも表示
      if (nextBtn) nextBtn.style.display = "inline-block";
    });
  }
});
