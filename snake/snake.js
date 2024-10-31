const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');

const box = 20;
const canvasWidthInBoxes = canvas.width / box;
const canvasHeightInBoxes = canvas.height / box;

let snake = [];
snake[0] = { x: 9 * box, y: 10 * box };
snake[1] = { x: 8 * box, y: 10 * box };
snake[2] = { x: 7 * box, y: 10 * box };
snake[3] = { x: 6 * box, y: 10 * box };
snake[4] = { x: 5 * box, y: 10 * box };

let food = {
    x: Math.floor(Math.random() * canvasWidthInBoxes) * box,
    y: Math.floor(Math.random() * canvasHeightInBoxes) * box
};

let score = 0;
let highscore = localStorage.getItem('highscore') || 0;
document.getElementById('highscoreDisplay').innerText = highscore;

let d;
let gameStarted = false;

let speed = 150;
let minSpeed = 10;
let speedIncrease = 2.5;

let isPaused = false;
let game;

const pauseMenu = document.getElementById('pauseMenu');
const overlay = document.getElementById('overlay');
const resumeButton = document.getElementById('resumeButton');
const restartButton = document.getElementById('restartButton');

document.addEventListener('keydown', direction);

function direction(event) {
    if (!isPaused) {
        if (event.keyCode === 37 && d !== "RIGHT") {
            d = "LEFT";
            gameStarted = true;
        } else if (event.keyCode === 38 && d !== "DOWN") {
            d = "UP";
            gameStarted = true;
        } else if (event.keyCode === 39 && d !== "LEFT") {
            d = "RIGHT";
            gameStarted = true;
        } else if (event.keyCode === 40 && d !== "UP") {
            d = "DOWN";
            gameStarted = true;
        }
    }

    if (event.keyCode === 32 || event.key === 'p' || event.key === 'P' || event.key === 'Escape') {  
        togglePause();
    }
}

function collision(head, array) {
    for (let i = 0; i < array.length; i++) {
        if (head.x === array[i].x && head.y === array[i].y) {
            return true;
        }
    }
    return false;
}

function increaseSpeed() {
    if (speed > minSpeed) {
        speed -= speedIncrease;
    }
    clearInterval(game);
    game = setInterval(drawGame, speed);
}

function updateScore() {
    document.getElementById('scoreDisplay').innerText = score;
}

function checkHighscore() {
    if (score > highscore) {
        highscore = score;
        localStorage.setItem('highscore', highscore);
        document.getElementById('highscoreDisplay').innerText = highscore;
    }
}

function drawGame() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (let i = 0; i < snake.length; i++) {
        if (i % 2 === 0) {
            ctx.fillStyle = (i === 0) ? 'brown' : 'black';
        } else {
            ctx.fillStyle = (i === 0) ? 'brown' : 'green';
        }
        ctx.fillRect(snake[i].x, snake[i].y, box, box);
    }

    ctx.fillStyle = 'red';
    ctx.fillRect(food.x, food.y, box, box);

    let snakeX = snake[0].x;
    let snakeY = snake[0].y;

    if (d) {
        if (d === "LEFT") snakeX -= box;
        if (d === "UP") snakeY -= box;
        if (d === "RIGHT") snakeX += box;
        if (d === "DOWN") snakeY += box;
    }

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

    if (gameStarted && (snakeX < 0 || snakeX >= canvas.width || snakeY < 0 || snakeY >= canvas.height || collision(newHead, snake))) {
        clearInterval(game);
        checkHighscore();
        alert('Game Over! Your Score: ' + score);
        return;
    }

    snake.unshift(newHead);
}

function togglePause() {
    if (isPaused) {
        isPaused = false;
        pauseMenu.style.display = 'none';
        overlay.style.display = 'none';
        game = setInterval(drawGame, speed); 
    } else {
        isPaused = true;
        pauseMenu.style.display = 'block';
        overlay.style.display = 'block';
        clearInterval(game);  
    }
}

function restartGame() {
    snake = [];
    snake[0] = { x: 9 * box, y: 10 * box };
    snake[1] = { x: 8 * box, y: 10 * box };
    snake[2] = { x: 7 * box, y: 10 * box };
    snake[3] = { x: 6 * box, y: 10 * box };
    snake[4] = { x: 5 * box, y: 10 * box };
    d = null;
    score = 0;
    speed = 150;
    updateScore();
    gameStarted = false;
    togglePause(); 
}

resumeButton.addEventListener('click', function() {
    togglePause();
});

restartButton.addEventListener('click', function() {
    restartGame();
});

game = setInterval(drawGame, speed);