<?php
session_start();
include_once './app/database/dbconnect.php';

$user_id = $_SESSION['user_id'] ?? null;
$categories = [
    1 => 'IT',
    2 => '英語',
    3 => '一般常識'
];
$history = [];
foreach ($categories as $cat_id => $cat_name) {
    $history[$cat_name] = [0, 0, 0]; // ここで必ず初期化
}
if ($user_id) {
    foreach ($categories as $cat_id => $cat_name) {
        $stmt = $pdo->prepare('SELECT correct_rate FROM score_history WHERE user_id=? AND category_id=? ORDER BY played_at DESC LIMIT 3');
        $stmt->execute([$user_id, $cat_id]);
        $rates = $stmt->fetchAll(PDO::FETCH_COLUMN);
        // 3回分なければ0で埋める
        while (count($rates) < 3) array_unshift($rates, 0); // 先頭に0を追加
        $history[$cat_name] = $rates; // 新しい順（[最新, 2回前, 3回前]）
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuiZion</title>
    <link rel="stylesheet" href="./CSS/top-style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body>
    <div class="body-top">
        <div class="user-name">
            <?php
            if (isset($_SESSION['username'])) {
                echo 'ようこそ、' . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') . 'さん';
            } else {
                echo 'ログインしてください。';
            }
            ?>
            <a href="login.php">ログアウト</a>
        </div>
        <div class="header">
            <h1>QuiZion</h1>
        </div>

        <div class="main-item">
            <a href="IT.php">
                <div class="item item1">
                    IT
                </div>
            </a>
            <a href="English.php">
                <div class="item item2">
                    英語
                </div>
            </a>
            <a href="Common_Sense.php">
                <div class="item item3">
                    一般常識
                </div>
            </a>
        </div>

        <hr class="long-line">

        <div class="body-top2">

            <div class="chart-row">



                <div class="bar-chart-wrapper">
                    <div class="chart-title">正答率（過去3回）</div>
                    <div class="accuracy-texts">
                        <span>最新：<?php echo $history['IT'][0]; ?>%</span>
                        <span>2回前：<?php echo $history['IT'][1]; ?>%</span>
                        <span>3回前：<?php echo $history['IT'][2]; ?>%</span>
                    </div>
                    <canvas id="chart1"></canvas>
                </div>

                <div class="bar-chart-wrapper">
                    <div class="chart-title">正答率（過去3回）</div>
                    <div class="accuracy-texts">
                        <span>最新：<?php echo $history['英語'][0]; ?>%</span>
                        <span>2回目：<?php echo $history['英語'][1]; ?>%</span>
                        <span>3回目：<?php echo $history['英語'][2]; ?>%</span>
                    </div>
                    <canvas id="chart2"></canvas>
                </div>

                <div class="bar-chart-wrapper">
                    <div class="chart-title">正答率（過去3回）</div>
                    <div class="accuracy-texts">
                        <span>最新：<?php echo $history['一般常識'][0]; ?>%</span>
                        <span>2回目：<?php echo $history['一般常識'][1]; ?>%</span>
                        <span>3回目：<?php echo $history['一般常識'][2]; ?>%</span>
                    </div>
                    <canvas id="chart3"></canvas>
                </div>



            </div>
        </div>


    </div>
    <!-- <div class="footer">
        ユーザー名 　
        <a href="login.php">ログアウト</a>
    </div> -->
</body>
<script>
    const itRates = <?= json_encode($history['IT']) ?>;
    const enRates = <?= json_encode($history['英語']) ?>;
    const csRates = <?= json_encode($history['一般常識']) ?>;
</script>
<script src="./JS/script.js"></script>

</html>