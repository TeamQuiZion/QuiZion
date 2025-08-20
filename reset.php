<?php
session_start();
// クイズ進行用だけ消す
unset($_SESSION['quiz_set']);
unset($_SESSION['current_index']);
unset($_SESSION['score']);
unset($_SESSION['answers']);
// ログイン情報（例: $_SESSION['user']）は残る
header('Location: top.php');
exit;