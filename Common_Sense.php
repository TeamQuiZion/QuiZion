<?php
session_start();
include_once './app/database/dbconnect.php';
include_once './function/function.php';

// 10問セットアップ
if (!isset($_SESSION['quiz_set'])) {
    // 10問ランダム取得
    $stmt = $pdo->query("SELECT quiz.*, answer.answer, answer.answer_name, category.categoryname
        FROM quiz
        INNER JOIN answer ON answer.quiz_id = quiz.quiz_id
        INNER JOIN category ON quiz.category_id = category.category_id
        WHERE quiz.category_id = 3
        ORDER BY RAND() LIMIT 10");
    $_SESSION['quiz_set'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['current_index'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['answers'] = [];
}

// POSTで回答が送信された場合
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $idx = $_SESSION['current_index'];
    $quiz = $_SESSION['quiz_set'][$idx];
    $selected = (int)$_POST['answer'];
    $correct = (int)$quiz['answer'];
    $is_correct = ($selected === $correct);
    if ($is_correct) $_SESSION['score']++;

    // 回答履歴保存
    $_SESSION['answers'][] = [
        'quiz_id' => $quiz['quiz_id'],
        'selected' => $selected,
        'correct' => $correct,
        'is_correct' => $is_correct,
        'answered_at' => date('Y-m-d H:i:s'),
    ];

    $_SESSION['current_index']++;

    // 10問終わったら結果ページへ
    if ($_SESSION['current_index'] >= count($_SESSION['quiz_set'])) {
        header('Location: score.php');
        exit;
    }
}

// 現在の問題を取得
$idx = $_SESSION['current_index'];
$quiz = $_SESSION['quiz_set'][$idx];
$is_first = ($_SESSION['current_index'] === 0);
?>
<!-- ここからHTMLは今まで通りでOK。選択肢ボタンはformでPOST送信にする -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問題</title>
    <link rel="stylesheet" href="./CSS/Quizstyle.css">
    <script>
        const isFirst = <?= $is_first ? 'true' : 'false' ?>;
        const correctAnswer = <?= (int)$quiz['answer'] ?>;
        window.choice1 = <?= json_encode($quiz['choice1'] ?? '') ?>;
        window.choice2 = <?= json_encode($quiz['choice2'] ?? '') ?>;
        window.choice3 = <?= json_encode($quiz['choice3'] ?? '') ?>;
        window.choice4 = <?= json_encode($quiz['choice4'] ?? '') ?>;
    </script>
</head>

<body>

    <header>
        <h1>QuiZion</h1>
        <h1><?= h($quiz['categoryname']) ?></h1>
        <a href="reset.php">topへ戻る</a>
    </header>

    <main>

        <!-- ローディングカウントダウン画面 -->
        <div id="loading-screen"></div>

        <div id="main-content">
            <h2>第<?= ($idx + 1) ?>問 / 10</h2>
            <p><?= h($quiz['title']) ?></p>
            <hr><br>
            <form method="post" id="quiz-form">
                <?php if (!empty($quiz['choice1'])): ?>
                    <button type="button" name="answer" value="1" class="choice-btn">ア</button>
                    <?= h($quiz['choice1']) ?><br>
                <?php endif; ?>
                <?php if (!empty($quiz['choice2'])): ?>
                    <button type="button" name="answer" value="2" class="choice-btn">イ</button>
                    <?= h($quiz['choice2']) ?><br>
                <?php endif; ?>
                <?php if (!empty($quiz['choice3'])): ?>
                    <button type="button" name="answer" value="3" class="choice-btn">ウ</button>
                    <?= h($quiz['choice3']) ?><br>
                <?php endif; ?>
                <?php if (!empty($quiz['choice4'])): ?>
                    <button type="button" name="answer" value="4" class="choice-btn">エ</button>
                    <?= h($quiz['choice4']) ?><br>
                <?php endif; ?>

                <!-- 解説を見るボタン -->
                <button type="button" id="show-explanation-btn" class="big-btn">解説を見る</button>

                <div id="show-correct"></div>

                <input type="hidden" name="answer" id="hidden-answer">
                <div id="explanation" style="display:none;">
                    <?= h($quiz['Explanation'] ?? 'ここに解説が表示されます') ?>
                </div>
                <?php if ($idx < 9): ?>
                    <button type="submit" id="next-btn" class="big-btn" style="display:none;">次の問題へ</button>
                <?php else: ?>
                    <button type="submit" id="next-btn" class="big-btn" style="display:none;">結果を見る</button>
                <?php endif; ?>
            </form>
            <div id="result" class="result"></div>
            <br><br>
            <div id="overlay"></div>
        </div>
    </main>
    <footer>
    </footer>
    <script src="./JS/question.js"></script>
</body>

</html>