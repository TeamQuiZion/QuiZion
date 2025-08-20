<?php
session_start();
include_once './function/function.php';
include_once './app/database/dbconnect.php'; // DB接続

// 直接来た・途中ならITへ
if (!isset($_SESSION['quiz_set']) || $_SESSION['current_index'] < count($_SESSION['quiz_set'])) {
    header('Location: IT.php');
    exit;
}

$total = count($_SESSION['quiz_set']);
$score = (int)$_SESSION['score'];
$answers = $_SESSION['answers'];

// 正答率
$rate = $total > 0 ? round(($score / $total) * 100, 1) : 0.0;

// （任意）ここでDBに履歴をまとめて保存したい場合は、$answersをループしてINSERTしてください。

// スコア履歴保存
if (isset($_SESSION['id'])) { // ←ここを修正
    $user_id = $_SESSION['id']; // ←ここも修正
    $category_id = $_SESSION['quiz_set'][0]['category_id']; // 1問目のカテゴリID
    $rate = $total > 0 ? round(($score / $total) * 100, 1) : 0.0; // 正答率
    $stmt = $pdo->prepare('INSERT INTO score_history (user_id, category_id, correct_rate) VALUES (?, ?, ?)');
    $stmt->execute([$user_id, $category_id, $rate]);
}

// 終了後、再挑戦で新しく回したい場合は下のunsetはコメントアウトでもOK
// セッションを消す → クイズ進行用だけunset、ログイン情報は残す
unset($_SESSION['quiz_set']);
unset($_SESSION['current_index']);
unset($_SESSION['score']);
unset($_SESSION['answers']);

// session_unset(); session_destroy(); ← これは削除またはコメントアウト
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>結果</title>
    <link rel="stylesheet" href="./CSS/Quizstyle.css">
</head>

<body>
    <header>
        <h1>QuiZion</h1>
        <h2>結果</h2>
        <a href="top.php">topへ戻る</a>
    </header>

    <main class="score-main">
        <section class="score-box">
            <p>正解数：<?= h($score) ?> / <?= h($total) ?></p>
        </section>
        <details>
            <summary>詳細を見る</summary>
            <ol>
            <?php foreach ($answers as $i => $ans): ?>
                <li>
                    問<?= $i+1 ?>　
                    <?= $ans['is_correct'] ? '〇' : '×' ?>　
                    選択：<?= h($ans['selected']) ?>　
                    正解：<?= h($ans['correct']) ?>
                </li>
            <?php endforeach; ?>
            </ol>
        </details>
        <div class="btn-row">
        </div>
    </main>
</body>

</html>