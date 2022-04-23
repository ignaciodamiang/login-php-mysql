<?php

  session_start();

  if(isset($_SESSION['user_id'])){
    header('Location: /login-php-mysql');
  }

    require 'database.php';
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = array();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        if(!is_countable($results))
          $results = [];
        if(count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['user_id'] = $results['id'];
            header('Location: /login-php-mysql');
        } else {
          $message = 'Sorry, those credentials do not match';
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Formulario Login</title>
</head>
<body>
<?php require 'partials/header.php'?>
<h1>Login</h1>
<span>or <a href="signup.php">SignUp</a></span>

<?php if(!empty($message)): ?>
  <p><?= $message ?></p>
<?php endif; ?>


<form action="login.php" method="post">
    <input type="text" name="email" placeholder="Enter your email">
    <input type="password" name="password" placeholder="Enter your password">
    <input type="submit" value="Send">
</form>
</body>
</html>
