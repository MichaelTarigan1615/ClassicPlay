<?php
session_start();
require_once '../../landingPage/db.php';

if (isset($_POST['score']) && isset($_SESSION['user_id'])) {
    $score = $_POST['score'];
    $userId = $_SESSION['user_id'];

    if (!$userId) {
        echo json_encode(['error' => 'User not logged in']);
        exit;
    }

    $query = "INSERT INTO arkanoid_score (id_user, score) VALUES ($1, $2)";
    $result = pg_query_params($dbconn, $query, array($userId, $score));

    if ($result) {
        echo json_encode(['success' => true, 'score' => $score]);
    } else {
        echo json_encode(['error' => 'Failed to insert score']);
    }
} else {
    echo json_encode(['error' => 'No score provided']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arkanoid Game</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
     
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Arkanoid</h1>
                <div class="score-container">
                    <div>Score: <span id="score">0</span></div>
                </div>
                <canvas id="gameCanvas" width="900px" height="1200px"></canvas>
            </div>
    
            <div id="pauseMenu">
                <h1>Game Paused</h1>
                <button class="btn btn-primary" id="resumeButton">Resume</button>
                <button class="btn btn-danger" id="restartButton">Restart</button>
                <button class="btn btn-primary" id="backButton">Back to Home</button>
            </div>
    
            <div id="gameOverMenu">
                <h1>Game Over</h1>
                <p>Your Score: <span id="finalScore"></span></p>
                <button class="btn btn-danger" id="restartGameButton">Restart</button>
                <button class="btn btn-primary" id="homeButton">Back to Home</button>
            </div>
            
            <div class="col-md-6">
                <canvas id="leaderboard" width="320" height="640"></canvas>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="arkanoid.js"></script>

</body>
</html>