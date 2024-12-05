<?php
session_start();
require_once '../../landingPage/db.php';

// Memeriksa apakah score dan user_id dikirim melalui AJAX
if (isset($_POST['score']) && isset($_SESSION['user_id'])) {
    $score = $_POST['score'];
    $user_id = $_SESSION['user_id'];

    // Menyimpan skor ke dalam tabel tetris_score
    $query = "INSERT INTO tetris_score (id_user, score) VALUES ($1, $2)";
    $result = pg_query_params($dbconn, $query, array($user_id, $score));

    if ($result) {
        echo json_encode(array('success' => true, 'score' => $score));
    } else {
        echo json_encode(array('success' => false, 'error' => 'Error saving score'));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Invalid request'));
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tetris</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container d-flex">
  <div class="game-container">
    <h1>Tetris</h1>
    <div class="score-container">
      <div>Score: <span id="score">0</span></div>
    </div>
    <canvas width="320" height="640" id="game"></canvas>
  </div>

  <div class="col-md-6">
    <canvas id="leaderboard" width="320" height="640" style="border:1px solid #000;"></canvas>
  </div>
</div>

<!-- Modal untuk Pause Menu -->
<div id="pauseMenu" class="pause-menu" style="display: none;">
  <div class="pause-content">
    <h2>Paused</h2>
    <button class="btn btn-primary" id="resumeButton">Resume</button>
    <button class="btn btn-danger" id="restartButton">Restart</button>
    <button class="btn btn-primary" id="homeButton">Back to Home</button>
  </div>
</div>

<!-- Modal untuk Game Over -->
<div id="gameOverMenu" class="game-over-menu" style="display: none;">
  <div class="game-over-content">
    <h2>Game Over</h2>
    <p>Your Score: <span id="finalScore">0</span></p>
    <button class="btn btn-primary" id="restartGameButton">Restart</button>
    <button class="btn btn-secondary" id="backHomeButton">Back to Home</button>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="tetris.js"></script>
</body>
</html>