<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/top-style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 


</head>

<body>
    <div class="body-top">
        <div class="header">
            <h1>QuiZion</h1>
        </div>

        <div class="main-item">
            <a href="IT.php">
                <div class="item item1">
                    IT
                </div>
            </a>
            <a href="IT.php">
                <div class="item item2">
                    英語
                </div>
            </a>
            <a href="IT.php">
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
                        <span>1回目：80%</span>
                        <span>2回目：90%</span>
                        <span>3回目：70%</span>
                    </div>
                    <canvas id="chart1"></canvas>
                </div>

                <div class="bar-chart-wrapper">
                    <div class="chart-title">正答率（過去3回）</div>
                    <div class="accuracy-texts">
                        <span>1回目：80%</span>
                        <span>2回目：90%</span>
                        <span>3回目：70%</span>
                    </div>
                    <canvas id="chart2"></canvas>
                </div>

                <div class="bar-chart-wrapper">
                    <div class="chart-title">正答率（過去3回）</div>
                    <div class="accuracy-texts">
                        <span>1回目：80%</span>
                        <span>2回目：90%</span>
                        <span>3回目：70%</span>
                    </div>
                    <canvas id="chart3"></canvas>
                </div>



            </div>
        </div>


    </div>
    <div class="footer">
        ユーザー名 　
        <a href="login.php">ログアウト</a>
    </div>
</body>
<script src="./JS/script.js"></script>

</html>