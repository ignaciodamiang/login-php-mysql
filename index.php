<?php
  session_start();
  require 'database.php';
  if(isset($_SESSION['user_id'])){
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;
    if(count($results) > 0) {
      $user = $results;
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>Welcome to your App</title>
</head>
<body>

<?php require 'partials/header.php'?>
<?php if(!empty($user)): ?>
  <br>Welcome <?= $user['email'] ?>
  <br> You are successfully Logged In.
  <a href="logout.php">Logout</a>
<?php else: ?>
  <h1>Please Login or SignUp</h1>
  <a href="login.php">Login</a>
  <a href="signup.php">SignUp</a>
<?php endif; ?>
</body>
</html>
