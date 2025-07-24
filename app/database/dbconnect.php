<?php

$user = 'root';
$password = '';

// データベース接続
try {
    // PDOインスタンスを作成
    $pdo = new PDO('mysql:host=localhost;dbname=quizion;charset=utf8', $user, $password);
    // エラーモードを例外に設定
    // echo '接続成功'
} catch (PDOException $e) {
    // 接続エラー時の処理
    echo '接続失敗: ' . $e->getMessage();
    exit;
}
