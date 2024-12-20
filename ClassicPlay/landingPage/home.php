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
    <div class="jumbotron text-center">
      <h1 id="welcome"></h1>
      <!-- <h2>Pilih medan pertempuranmu</h2> -->
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
          <a href="../arkanoid/arkanoid.html" class="card-footer enter"
            >Enter
          </a>
        </div>

        <div class="card">
          <img src="../asset/1_26lHxJ2Icsx4BWct9-h6Tw.jpg" alt="Tetris Game" />
          <div class="card-body">
            <h4 class="card-title">Tetris</h4>
            <p class="card-text">GESAT GESIT<br />Mana fasthand-nya?</p>
          </div>
          <a href="../tetris/tetris.html" class="card-footer enter"> Enter </a>
        </div>

        <div class="card">
          <img src="../asset/snake.jpg" alt="Snake Game" />
          <div class="card-body">
            <h4 class="card-title">Snake</h4>
            <p class="card-text">SHHHHHHHHH......</p>
          </div>
          <a href="../snake/snake.html" class="card-footer enter"> Enter</a>
        </div>
      </div>

      <div class="logout">
        <button onclick="logout()" class="btn-danger">Logout</button>
      </div>
    </section>

    <!-- <footer class="bg-dark text-white text-center py-4">
      <h5>&copy; 2024 My Game Collection. All Rights Reserved.</h5>
    </footer> -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
      function logout() {
        window.location.href = "index.php";
      }
    </script>

    <!-- <script>
      const uname = localStorage.getItem("username");
      const welcome = document.getElementById("welcome");
      welcome.textContent = `welcome back ${uname}!`;
    </script> -->
  </body>
</html>
