<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location: login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Classic Play</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
  <link rel="icon" type="img" href="../asset/iconbaru.png" />
  <link rel="stylesheet" href="home.css" />
</head>

<body>
  <div class="jumbotron text-center">
    <h1 id="welcome">Welcome back, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
  </div>

  <section id="games" class="container text-center">
    <h2>Classic Play | Update ver 1.4</h2>
    <div class="available-games">
      <div class="card">
        <img src="../asset/maxresdefault.jpg" alt="Arkanoid Game" />
        <div class="card-body">
          <h4 class="card-title">Arkanoid</h4>
          <p class="card-text">Tunjukkan seberapa hebat skillmu!</p>
        </div>
        <a href="../arkanoid/arkanoid.html" class="card-footer enter">Enter</a>
      </div>
      <div class="card">
        <img src="../asset/1_26lHxJ2Icsx4BWct9-h6Tw.jpg" alt="Tetris Game" />
        <div class="card-body">
          <h4 class="card-title">Tetris</h4>
          <p class="card-text">GESAT GESIT<br />Mana fasthand-nya?</p>
        </div>
        <a href="../tetris/tetris.html" class="card-footer enter">Enter</a>
      </div>
      <div class="card">
        <img src="../asset/snake.jpg" alt="Snake Game" />
        <div class="card-body">
          <h4 class="card-title">Snake</h4>
          <p class="card-text">SHHHHHHHHH......</p>
        </div>
        <a href="../snake/snake.html" class="card-footer enter">Enter</a>
      </div>
    </div>

    <div class="logout">
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
  </section>

</body>

</html>