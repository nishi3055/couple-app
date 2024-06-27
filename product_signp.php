<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
</head>
<body>
    <div class="wrapper">
        <div class=img><img class="logo" src="img/tourokubotan_doubutu_hituzi.png"></div>
        <h1>新規会員登録</h1>

        <form action="product_create.php" method="POST">
            <label for="name">名前:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="pass">パスワード:</label>
            <input type="text" id="pass" name="pass" required>
            <br>
            <input type="submit" value="新規登録">
        </form>    
        <p>すでに登録済みの方は<a href="product_login.php">こちら</a></p>
    </div>
</body>
</html>