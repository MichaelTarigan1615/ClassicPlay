const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');

const box = 20;
const canvasWidthInBoxes = canvas.width / box;
const canvasHeightInBoxes = canvas.height / box;

let snake = [];
let food;
let score = 0;
let highscore = localStorage.getItem('highscore') || 0;
let d = null;
let gameStarted = false;
let isPaused = false;
let gameInterval;

let speed = 150; // Default speed
const minSpeed = 10;
const speedIncrease = 2.5;

document.getElementById('highscoreDisplay').innerText = highscore;

// Reference HTML elements
const pauseMenu = document.getElementById('pauseMenu');
const overlay = document.getElementById('overlay');
const resumeButton = document.getElementById('resumeButton');
const pauseRestartButton = document.getElementById('restartButton');
const pauseBackButton = document.getElementById('backButton');
const pauseButton = document.getElementById('pauseButton');

const gameOverMenu = document.getElementById('gameOverMenu');
const finalScoreDisplay = document.getElementById('finalScore');
const gameOverRestartButton = document.getElementById('restartGameButton');
const gameOverBackButton = document.getElementById('backHomeButton');

document.addEventListener('keydown', direction);

// Function to initialize or reset the game
function initGame() {
    snake = [
        { x: 9 * box, y: 10 * box },
        { x: 8 * box, y: 10 * box },
        { x: 7 * box, y: 10 * box },
        { x: 6 * box, y: 10 * box },
        { x: 5 * box, y: 10 * box }
    ];
    food = {
        x: Math.floor(Math.random() * canvasWidthInBoxes) * box,
        y: Math.floor(Math.random() * canvasHeightInBoxes) * box
    };
    score = 0;
    speed = 150;
    d = null;
    gameStarted = false;
    isPaused = false;
    updateScore();
    pauseMenu.style.display = 'none';
    gameOverMenu.style.display = 'none';
    overlay.style.display = 'none';
    clearInterval(gameInterval);
    gameInterval = setInterval(drawGame, speed);
}

// Direction control
function direction(event) {
    if (!isPaused) {
        if (!gameStarted && (event.keyCode === 37 || event.keyCode === 38 || event.keyCode === 39 || event.keyCode === 40)) {
            gameStarted = true; // Mark game as started on first valid direction input
        }
        if (event.keyCode === 37 && d !== "RIGHT") d = "LEFT";
        if (event.keyCode === 38 && d !== "DOWN") d = "UP";
        if (event.keyCode === 39 && d !== "LEFT") d = "RIGHT";
        if (event.keyCode === 40 && d !== "UP") d = "DOWN";
    }
    if (event.keyCode === 32 || event.key === 'p' || event.key === 'P' || event.key === 'Escape') {
        togglePause();
    }
}

// Collision detection
function collision(head, array) {
    return array.some(segment => head.x === segment.x && head.y === segment.y);
}

// Speed management
function increaseSpeed() {
    if (speed > minSpeed) speed -= speedIncrease;
    clearInterval(gameInterval);
    gameInterval = setInterval(drawGame, speed);
}

// Update score display
function updateScore() {
    document.getElementById('scoreDisplay').innerText = score;
}

// Check for new highscore
function checkHighscore() {
    if (score > highscore) {
        highscore = score;
        localStorage.setItem('highscore', highscore);
        document.getElementById('highscoreDisplay').innerText = highscore;
    }
}

// Draw the game on the canvas
function drawGame() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw the snake
    for (let i = 0; i < snake.length; i++) {
        ctx.fillStyle = i === 0 ? 'brown' : (i % 2 === 0 ? 'black' : 'green');
        ctx.fillRect(snake[i].x, snake[i].y, box, box);
    }

    // Draw the food
    ctx.fillStyle = 'red';
    ctx.fillRect(food.x, food.y, box, box);

    // If game has not started yet, skip movement and drawing logic
    if (!gameStarted) return;

    // Move the snake
    let snakeX = snake[0].x;
    let snakeY = snake[0].y;

    if (d) {
        if (d === "LEFT") snakeX -= box;
        if (d === "UP") snakeY -= box;
        if (d === "RIGHT") snakeX += box;
        if (d === "DOWN") snakeY += box;
    }

    // Check for food collision
    if (snakeX === food.x && snakeY === food.y) {
        score++;
        food = {
            x: Math.floor(Math.random() * canvasWidthInBoxes) * box,
            y: Math.floor(Math.random() * canvasHeightInBoxes) * box
        };
        increaseSpeed();
        updateScore();
    } else {
        snake.pop();
    }

    let newHead = { x: snakeX, y: snakeY };

    // Check for game over
    if (snakeX < 0 || snakeX >= canvas.width || snakeY < 0 || snakeY >= canvas.height || collision(newHead, snake)) {
        showGameOverMenu();
        return;
    }

    snake.unshift(newHead);
}

// Show game over menu
function showGameOverMenu() {
    clearInterval(gameInterval);
    checkHighscore();
    gameOverMenu.style.display = 'block';
    overlay.style.display = 'block';
    finalScoreDisplay.innerText = score;
}

// Pause and resume functionality
function togglePause() {
    if (isPaused) {
        isPaused = false;
        pauseMenu.style.display = 'none';
        overlay.style.display = 'none';
        if (gameStarted) {
            gameInterval = setInterval(drawGame, speed);
        }
    } else {
        isPaused = true;
        pauseMenu.style.display = 'block';
        overlay.style.display = 'block';
        clearInterval(gameInterval);
    }
}

// Event listeners for buttons
resumeButton.addEventListener('click', togglePause);
pauseRestartButton.addEventListener('click', initGame);
pauseBackButton.addEventListener('click', () => (window.location.href = "../../landingPage/home.php"));
pauseButton.addEventListener('click', togglePause);

gameOverRestartButton.addEventListener('click', initGame);
gameOverBackButton.addEventListener('click', () => (window.location.href = "../../landingPage/home.php"));

// Start the game
initGame();
