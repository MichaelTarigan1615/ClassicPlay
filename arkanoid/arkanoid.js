const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");

let ballRadius = 10;
let x = canvas.width / 2;
let y = canvas.height - 30;
let dx = 2;
let dy = -2;

let paddleHeight = 10;
let paddleWidth = 200;
let paddleX = (canvas.width - paddleWidth) / 2;
let rightPressed = false;
let leftPressed = false;
let paddleSpeed = 4;

let brickRowCount = 7;
let brickColumnCount = 10;
const brickWidth = 75;
const brickHeight = 20;
const brickPadding = 10;
const brickOffsetTop = 30;
const brickOffsetLeft = 30;

let bricks = [];
initializeBricks();

let score = 0;
let paddleHits = 0; // Menghitung jumlah pantulan pada paddle
let isPaused = false;
let isGameOver = false; // Menandakan apakah permainan sudah berakhir

function initializeBricks() {
    for (let c = 0; c < brickColumnCount; c++) {
        bricks[c] = [];
        for (let r = 0; r < brickRowCount; r++) {
            bricks[c][r] = { x: 0, y: 0, status: 1 };
        }
    }
}

function addBrickRow() {
    // Tambahkan baris brick baru di atas
    for (let c = 0; c < brickColumnCount; c++) {
        bricks[c].unshift({ x: 0, y: 0, status: 1 });
    }
    brickRowCount++;

    // Jika jumlah baris brick mencapai paddle, game over
    if (brickOffsetTop + brickRowCount * (brickHeight + brickPadding) >= canvas.height - paddleHeight - 10) {
        endGame();
    }
}

function drawBall() {
    ctx.beginPath();
    ctx.arc(x, y, ballRadius, 0, Math.PI * 2);
    ctx.fillStyle = "#ff3b0f";
    ctx.fill();
    ctx.closePath();
}

function drawPaddle() {
    ctx.beginPath();
    ctx.fillStyle = "black";
    ctx.fillRect(paddleX, canvas.height - paddleHeight - 10, paddleWidth, paddleHeight);
    ctx.closePath();
}

function drawBricks() {
    for (let c = 0; c < brickColumnCount; c++) {
        for (let r = 0; r < brickRowCount; r++) {
            if (bricks[c][r].status == 1) {
                let brickX = (c * (brickWidth + brickPadding)) + brickOffsetLeft;
                let brickY = (r * (brickHeight + brickPadding)) + brickOffsetTop;
                bricks[c][r].x = brickX;
                bricks[c][r].y = brickY;
                ctx.beginPath();
                ctx.rect(brickX, brickY, brickWidth, brickHeight);
                ctx.fillStyle = "#ff3b0f";
                ctx.fill();
                ctx.closePath();
            }
        }
    }
}

function collisionDetection() {
    for (let c = 0; c < brickColumnCount; c++) {
        for (let r = 0; r < brickRowCount; r++) {
            let b = bricks[c][r];
            if (b.status == 1) {
                if (x > b.x && x < b.x + brickWidth && y > b.y && y < b.y + brickHeight) {
                    dy = -dy;
                    b.status = 0;
                    score++;
                    updateScore();
                }
            }
        }
    }
}

function updateScore() {
    document.getElementById("score").textContent = score;
}

function endGame() {
    isGameOver = true;
    document.getElementById("gameOverMenu").style.display = "block"; // Tampilkan menu Game Over
    document.getElementById("finalScore").textContent = score; // Tampilkan skor akhir
    document.querySelector('.container').style.justifyContent = 'center'; // Ensure alignment on game over
}

function draw() {
    if (isPaused || isGameOver) return;

    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawBricks();
    drawBall();
    drawPaddle();
    collisionDetection();

    // Pantulan bola dari dinding samping
    if (x + dx > canvas.width - ballRadius || x + dx < ballRadius) {
        dx = -dx;
    }

    // Pantulan bola dari dinding atas
    if (y + dy < ballRadius) {
        dy = -dy;
    } else if (y + dy > canvas.height - ballRadius) {
        // Bola menyentuh paddle
        if (x > paddleX && x < paddleX + paddleWidth) {
            // Hitung posisi relatif bola terhadap paddle
            let relativeX = x - (paddleX + paddleWidth / 2);
            let maxAngle = Math.PI / 3; // Maksimum sudut pantulan (60 derajat)
            let angle = (relativeX / (paddleWidth / 2)) * maxAngle;

            // Perbarui kecepatan bola berdasarkan sudut
            let speed = Math.sqrt(dx * dx + dy * dy); // Kecepatan total tetap
            dx = speed * Math.sin(angle);
            dy = -speed * Math.cos(angle);

            paddleHits++;

            // Tambahkan baris brick baru setiap 3 pantulan
            if (paddleHits % 3 === 0) {
                addBrickRow();
            }
        } else {
            // Bola jatuh ke bawah (Game Over)
            endGame();
        }
    }

    // Gerakan paddle
    if (rightPressed && paddleX < canvas.width - paddleWidth) {
        paddleX += paddleSpeed;
    } else if (leftPressed && paddleX > 0) {
        paddleX -= paddleSpeed;
    }

    // Update posisi bola
    x += dx;
    y += dy;

    requestAnimationFrame(draw);
}

function keyDownHandler(e) {
    if (e.key == "Right" || e.key == "ArrowRight") {
        rightPressed = true;
    } else if (e.key == "Left" || e.key == "ArrowLeft") {
        leftPressed = true;
    } else if (e.key == " " || e.key.toLowerCase() === "p") {
        togglePause();
    }
}

function keyUpHandler(e) {
    if (e.key == "Right" || e.key == "ArrowRight") {
        rightPressed = false;
    } else if (e.key == "Left" || e.key == "ArrowLeft") {
        leftPressed = false;
    }
}

function togglePause() {
    isPaused = !isPaused;
    const pauseMenu = document.getElementById("pauseMenu");
    if (isPaused) {
        pauseMenu.style.display = "block";
    } else {
        pauseMenu.style.display = "none";
        draw();
    }
}

document.getElementById("resumeButton").addEventListener("click", () => {
    isPaused = true;
    togglePause();
});

document.getElementById("restartButton").addEventListener("click", () => {
    document.location.reload();
});

document.getElementById("backButton").addEventListener("click", () => {
    window.location.href = "../home.html";
});

// Restart Game Over
document.getElementById("restartGameButton").addEventListener("click", () => {
    location.reload();
});

// Back to Home from Game Over
document.getElementById("homeButton").addEventListener("click", () => {
    window.location.href = "../home.html";
});

document.addEventListener("keydown", keyDownHandler, false);
document.addEventListener("keyup", keyUpHandler, false);

draw();
