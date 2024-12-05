<?php
session_start();

if(isset($_SESSION["is_login"]) == false) {
    header("location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Classic Play</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="icon" type="img" href="../asset/iconbaru.png" />
    <link rel="stylesheet" href="home.css" />
  </head>
  <body>
  <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="../asset/iconbaru.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        Classic Play
      </a>
      <a href="account.php">
        <h5>Account</h5>
      </a>
    </div>
  </nav>

    <section id="games" class="container text-center">
      <h2>CLASSIC PLAY</h2>
      <h3>Pilih Medan Pertempuranmu!🫵</h3>

      
      <div class="available-games">
        <div class="card">
          <img src="../asset/maxresdefault.jpg" alt="Arkanoid Game" />
          <div class="card-body">
            <h4 class="card-title">Arkanoid</h4>
            <p class="card-text">Tunjukkan seberapa hebat skillmu!</p>
          </div>
          <a href="../game/arkanoid/arkanoid.php" class="card-footer enter"> MASUK </a>
        </div>  

        <div class="card">
          <img src="../asset/1_26lHxJ2Icsx4BWct9-h6Tw.jpg" alt="Tetris Game" />
          <div class="card-body">
            <h4 class="card-title">Tetris</h4>
            <p class="card-text">GESAT GESIT<br />Mana fasthand-nya?</p>
          </div>
          <a href="../game/tetris/tetris.php" class="card-footer enter"> MASUK </a>
        </div>

        <div class="card">
          <img src="../asset/snake.jpg" alt="Snake Game" />
          <div class="card-body">
            <h4 class="card-title">Snake</h4>
            <p class="card-text">SHHHHHHHHH......</p>
          </div>
          <a href="../game/snake/snake.php" class="card-footer enter"> MASUK </a>
        </div>
      </div>
    </section>

    <footer class="bg-dark text-white text-center py-4">
      <h5>&copy; 2024 My Game Collection. All Rights Reserved.</h5>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>