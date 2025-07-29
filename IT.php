<?php
session_start();
// データベースに接続するためのファイルを読み込む
include_once './app/database/dbconnect.php';
// ユーザ定義関数
include_once './function/function.php';

// データベースからquizテーブルのデータを取得
//クイズを1問取得
$sql = "SELECT * FROM quiz 
inner join category on quiz.category_id=category.category_id
inner join answer on answer.quiz_id=quiz.quiz_id
ORDER BY RAND() LIMIT 1"; 
$stmt = $pdo->query($sql);
$quiz = $stmt->fetch(PDO::FETCH_ASSOC);


?>



<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>問題</title>
    <link rel="stylesheet" href="./CSS/Quizstyle.css">
</head>
<body>

    <header>
    <h1>QuiZion</h1>
    <h1><?php echo h($quiz['categoryname']); ?></h1><br>
    <a href="top.php">topへ戻る</a>
    </header>

    <main>
    <!-- ローディングカウントダウン画面 -->
    <div id="loading-screen"></div>
    <h3>問題</h3>

    <p><?php echo h($quiz['title']); ?></p>

    <hr> <!--  「問題」の下に線を引くかどうか -->
    <br>
    
    <input type="button" value="ア" class="choice-btn" data-choice="1"><?php echo h($quiz['choice1']); ?><br>
    <input type="button" value="イ" class="choice-btn" data-choice="2"><?php echo h($quiz['choice2']); ?><br>
    <input type="button" value="ウ" class="choice-btn" data-choice="3"><?php echo h($quiz['choice3']); ?><br>
    <input type="button" value="エ" class="choice-btn" data-choice="4"><?php echo h($quiz['choice4']); ?><br>

    <div id="result" class="result"></div>
    <br><br>

    <input type="button" value="解答を見る" id="choice1">
      <!-- 真ん中に大きく表示される〇用の要素 -->
    <div id="overlay">
        <!-- <div class="circle">〇</div> 〇を表示する要素 -->
    </div>

    <div id="toggleElement" style="display:none;">
        <h2>解答：<?php echo h($quiz['answer_name']); ?></h2>
        
        <p><?php echo h($quiz['Explanation']);?></p>
        <form action="IT.php" method="post">
            <button>次の問題へ</button>
        </form>
        
        <form action="score.php" method="post">
            <button>結果を見る</button>
        </form>
    </div>


    </main>

    <footer>

    </footer>
    <script>
        const correctAnswer=<?= (int)$quiz['answer'] ?>; // 正解の選択肢番号をPHPからJavaScriptに渡す
    </script>
    <script src="./JS/question.js"></script>
</body>

</html>