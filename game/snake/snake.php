<?php
session_start();
require_once '../../landingPage/db.php';

// Check if the POST data is received
if (isset($_POST['score']) && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];  // Get user_id from session
    $score = $_POST['score'];

    // Validate data
    if ($userId && $score !== null) {

        // Prepare the SQL query to insert the score
        $query = "INSERT INTO snake_score (id_user, score) VALUES ($1, $2)";
        $result = pg_query_params($dbconn, $query, array($userId, $score));

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Score saved successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error saving score.']);
        }

        // Close the database connection
        pg_close($dbconn);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snake Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Snake Game</h1>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3>Score: <span id="scoreDisplay">0</span></h3>
            </div>
            <div class="col-6">
                <h3>Highscore: <span id="highscoreDisplay">0</span></h3>
            </div>
        </div>
    </div>

    <!-- Adjusted canvas size to make it more compact -->
    <canvas id="gameCanvas" width="900" height="550"></canvas>

    <div class="overlay" id="overlay"></div>
    <div class="pause-menu" id="pauseMenu">
        <h2>Game Paused</h2>
        <button class="btn btn-primary btn-sm" id="resumeButton">Resume Game</button>
        <button class="btn btn-danger btn-sm" id="restartButton">Restart Game</button>
        <button class="btn btn-primary btn-sm" id="backButton">Back to Home</button>
    </div>

    <div class="game-over-menu" id="gameOverMenu" style="display: none;">
        <h2>Game Over</h2>
        <h3>Your Score: <span id="finalScore">0</span></h3>
        <button class="btn btn-primary btn-sm" id="restartGameButton">Restart</button>
        <button class="btn btn-secondary btn-sm" id="backHomeButton">Back to Home</button>
    </div>

    <button class="btn btn-warning btn-sm" id="pauseButton">Pause</button>

    <script src="snake.js"></script>

</body>
</html>