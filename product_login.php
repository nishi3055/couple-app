<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/login.css">
    <title>loginページ</title>
</head>
<body>
<section id="wrapper">
<section class="header">
    <div class="text"><p>Welcome！</p></div>
</section>
<section class="box">
    <div class="innner">
    <form action="product_check.php" method="POST">
        <dl>
            <dd><input type="text" id="email" name="email" placeholder="メールアドレス" required></dd>
            <dd><input type="text" id="pass" name="pass" placeholder="パスワード" required></dd>
        </dl>
       <button type="submit" name="login"><a href="main.php"> ログイン</button>
       <div class="reset"><a href="#">パスワードを忘れた方はこちら</a></div>
       <div style="background:#eee; height: 1px; margin: 10px 0 20px 0;"></div>
       <div class="regist"><a href="product_signp.php">新しいアカウント作成</a></div>
    </form>
    </div>
    </section>
    </section>
    <footer>

    </footer>
</body>
</html>