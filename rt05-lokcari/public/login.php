<?php require_once '../config.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
 $s=$pdo->prepare("SELECT * FROM users WHERE username=?");$s->execute([$_POST['username']]);
 $u=$s->fetch();
 if($u && password_verify($_POST['password'],$u['password'])){
    $_SESSION['user_id']=$u['id']; header('Location: index.php'); exit;
 } $err='Login gagal';
}
?>
<!doctype html><html><head><title>Login RT05</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body><div class="login"><h2>Login Sistem RT 05</h2>
<form method="post"><input name="username" placeholder="Username" required>
<input name="password" type="password" placeholder="Password" required>
<button>Masuk</button></form><div class="err"><?= $err??'' ?></div></div></body></html>