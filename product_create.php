<?php

//POSTデータ確認
//var_dump($_POST);

if (
  !isset($_POST['name']) || $_POST['name'] === '' ||
  !isset($_POST['email']) || $_POST['email'] === '' ||
  !isset($_POST['pass']) || $_POST['pass'] === ''
) {
  exit('データが足りません');
}

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];


// DB接続
$dbn ='mysql:dbname=gs_d15_09;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';
try {
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit();
}


// SQL作成&実行
$sql = 'INSERT INTO register_list (id, name, email, pass, created_at, updated_at) VALUES (NULL, :name, :email, :pass, now(), now())';

$stmt = $pdo->prepare($sql);

// バインド変数を設定
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);

// SQL実行（実行に失敗すると `sql error ...` が出力される）
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header('Location:product_login.php');
exit();

?>
