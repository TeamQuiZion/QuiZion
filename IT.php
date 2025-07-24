<?php
session_start();
// データベースに接続するためのファイルを読み込む
include_once './app/database/dbconnect.php';

// データベースからquizテーブルのデータを取得
$sql = "SELECT * FROM quiz WHERE quiz_id = 1"; // quiz_idが1の問題を取得するSQL文
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
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/Quizstyle.css">
</head>
<body>

    <header>
    <h1>QuiZion</h1>
    <h1>IT</h1><br>
    <a href="top.php">topへ戻る</a>
    </header>

    <main>
    <!-- ローディングカウントダウン画面 -->
    <div id="loading-screen"></div>
    <h3>問題</h3>

    <p><?php print($row['title']) ?></p>

    <hr> <!--  「問題」の下に線を引くかどうか -->
    <br>
    
    <input type="button" value="ア" class="choice"><?php print($row['choise1']) ?><br>
    <input type="button" value="イ" class="choice"><?php print($row['choise2']) ?><br>
    <input type="button" value="ウ" class="choice"><?php print($row['choise3']) ?><br>
    <input type="button" value="エ" class="choice"><?php print($row['choise4']) ?><br>

    <br><br>

    <input type="button" value="解答を見る" id="choice1">
      <!-- 真ん中に大きく表示される〇用の要素 -->
    <div id="overlay">
        <div class="circle">〇</div> <!-- 〇を表示する要素 -->
    </div>

    <div id="toggleElement" style="display:none;">
        <h2>解答：><?php print($row['answer']) ?>「UPS」</h2>
        
        <p>UPS（Uninterruptible Power Supply）は、落雷などによる突発的な停電が発生したときに自家発電装置が電源を供給し始めるまでの間、サーバに電源を供給する装置です。また、電源の瞬断に対処したり停電時にシステムを安全に終了させるための役目を果たしたりします。</p>

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