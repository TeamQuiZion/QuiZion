<?php
session_start();
// データベースに接続するためのファイルを読み込む
include_once './app/database/dbconnect.php';
// ユーザ定義関数
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// POSTリクエストが送信された場合の処理
if (isset($_POST['submitButton'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    // 名前の入力が空の場合
    if (empty($_POST['username'])) {
        $error_message_name[] = "ユーザー名を入力してください";
    }
    // パスワードの入力が空の場合
    if (empty($_POST['password'])) {
        $error_message_pass[] = "パスワードを入力してください";
    }

  if (empty($error_message)) {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // セッション保存
            $_SESSION['id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            header('Location: top.php');
            exit;
        } else {
            $error_message['login'] = "ユーザー名またはパスワードが間違っています。";
            //echo $error_message['login'];
        }
    }}

?>

<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="./CSS/style.css">
    </head>

    <body>

        <main>
            
            <div class="header">
                <img src="image/アプリロゴ背景透明.jpg" alt="">
                <br>
                ログイン
                
            </div>

            <form action="" method="POST">
                <p>ユーザー名</p>
                <?php if(!empty($error_message_name)): ?>
                    <div class="error-message">
                        <?php foreach ($error_message_name as $message): ?>
                            <p style="color:red;"><?php echo h($message); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <input type="text" name="username" class="user-form"><br>

                <p>パスワード</p>
                <?php if(!empty($error_message_pass)): ?>
                    <div class="error-message">
                        <?php foreach ($error_message_pass as $message): ?>
                            <p style="color:red;"><?php echo h($message); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <input type="text" name="password" class="pass-form"><br>

                <?php if(!empty($error_message) && !empty($username) && !empty($password)): ?>
                    <p class="error" style="color:red;"><?php  echo $error_message['login']; ?></p>
              
                <?php endif; ?>

                <br>
                <!-- <input type="button" value="新規登録" onclick="location.href='register.php'" style="margin-right:10px;"> -->
                <input type="submit" value="ログイン" name="submitButton" class="login-button">
                <p>新規登録は<a href="register.php">こちら</a></p>
                

            </form>

            

        </main>
        <!-- <div class="footer">
            <img src="image/チームロゴ背景透過.png" alt="" style="height: 100px">
        </div> -->

    </body>

</html>