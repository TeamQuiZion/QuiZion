<?php
session_start();
// データベースに接続するためのファイルを読み込む
include_once './app/database/dbconnect.php';
// ユーザ定義関数
include_once './function/function.php';

// データベースからquizテーブルのデータを取得
$sql = "SELECT * FROM quiz inner join category on quiz.category_id =
         category.category_id where quiz_id=1"; // quiz_idが1の問題を取得するSQL文
$stmt = $pdo->prepare($sql);
$stmt->execute();

// データを1件取得
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    // データが取得できなかった場合の処理
    echo "問題が見つかりませんでした。";
    exit;
}
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
    <h1><?php echo h($row['categoryname']); ?></h1><br>
    <a href="top.php">topへ戻る</a>
    </header>

    <main>
    <!-- ローディングカウントダウン画面 -->
    <div id="loading-screen"></div>
    <h3>問題</h3>

    <p><?php echo h($row['title']); ?></p>

    <hr> <!--  「問題」の下に線を引くかどうか -->
    <br>
    
    <input type="button" value="ア" class="choice"><?php echo h($row['choice1']); ?><br>
    <input type="button" value="イ" class="choice"><?php echo h($row['choice2']); ?><br>
    <input type="button" value="ウ" class="choice" id="correctChoice"><?php echo h($row['choice3']); ?><br>
    <input type="button" value="エ" class="choice"><?php echo h($row['choice4']); ?><br>

    <br><br>

    <input type="button" value="解答を見る" id="choice1">
      <!-- 真ん中に大きく表示される〇用の要素 -->
    <div id="overlay">
        <!-- <div class="circle">〇</div> 〇を表示する要素 -->
    </div>

    <div id="toggleElement" style="display:none;">
        <h2>解答：<?php echo h($row['answer']); ?>「UPS」</h2>
        
        <p><?php echo h($row['Explanation']);?></p>

        <button>次の問題へ</button>
        <form action="score.php" method="post">
            <button>結果を見る</button>
        </form>
    </div>


    </main>

    <footer>

    </footer>
    <script src="./JS/question.js"></script>
</body>

</html>