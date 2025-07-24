<?php

// データベースに接続するためのファイルを読み込む
include_once './app/database/dbconnect.php';
// ユーザ定義関数
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// POSTリクエストが送信された場合の処理
if (isset($_POST['submitButton'])) {

    // 名前の入力が空の場合
    if (empty(trim($_POST['username']))) {
        $error_message_name['username'] = "ユーザー名を入力してください\n";
    }
    // パスワードの入力が空の場合
    if (empty(trim($_POST['password']))) {
        $error_message_pass['password'] = "パスワードを入力してください";
    }

    if (empty($error_message_name) && empty($error_message_pass)) { // $error_messageが空の場合(エラーがない場合)
        $member = $pdo->prepare('SELECT COUNT(*) AS cnt FROM user WHERE username=?');
        $member->execute(array($_POST['username']));
        $record = $member->fetch();
        if($record['cnt'] > 0){
            $error['username'] = '※ユーザー名は既に登録されています';
        }else{
            // 送信されたデータを処理する 後々追加する可能性あり
        $username = h($_POST['username']);
        $password = h($_POST['password']);
        $passhash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $passhash, PDO::PARAM_STR);

        $stmt->execute();
        echo "新規登録しました。";
        header('Location: login.php');
        }
        

        
    } 
    
}

?>

<!DOCTYPE html>
<html lang="en">

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
            <br>新規登録
        </div>

        <form action="" method="POST">
        
            <!-- <?php if($error['username'] == 'duplicate'): ?>
                <p class=error>※指定されたメールアドレスは既に登録されています</p>
            <?php endif; ?> -->
            <p>ユーザー名</p>
            <?php if (isset($error_message_name)): ?>
                <div class="error-message">
                    <?php foreach ($error_message_name as $message): ?>
                        <p style="color:red;"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                    <?php foreach ($error as $err): ?>
                        <p style="color:red;"><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endforeach; ?>
            <?php endif; ?>

            <input type="text" name="username" id=""><br>            
            <p>パスワード</p>
            <?php if(!empty($error_message_pass)): ?>
                    <div class="error-message">
                        <?php foreach ($error_message_pass as $message): ?>
                            <p style="color:red;"><?php echo h($message); ?></p>
                        <?php endforeach; ?>
                    </div>
            <?php endif; ?>
            <input type="password" name="password" id=""><br>

            <br>
            <input type="submit" value="新規登録" name="submitButton">
        </form>

        </form>

    </main>
    <div class="footer">
        <img src="image/チームロゴ背景透過.png" alt="" style="height: 100px">
        K³
    </div>

</body>

</html>