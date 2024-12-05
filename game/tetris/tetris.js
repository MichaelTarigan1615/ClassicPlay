// Fungsi utilitas untuk menghasilkan angka acak
function getRandomInt(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

// Menghasilkan urutan tetromino acak
function generateSequence() {
  const sequence = ['I', 'J', 'L', 'O', 'S', 'T', 'Z'];
  while (sequence.length) {
    const rand = getRandomInt(0, sequence.length - 1);
    const name = sequence.splice(rand, 1)[0];
    tetrominoSequence.push(name);
  }
}

// Mendapatkan tetromino berikutnya
function getNextTetromino() {
  if (tetrominoSequence.length === 0) {
    generateSequence();
  }

  const name = tetrominoSequence.pop();
  const matrix = tetrominos[name];
  const col = playfield[0].length / 2 - Math.ceil(matrix[0].length / 2);
  const row = name === 'I' ? -1 : -2;

  return { name, matrix, row, col };
}

// Rotasi tetromino
function rotate(matrix) {
  const N = matrix.length - 1;
  return matrix.map((row, i) =>
    row.map((val, j) => matrix[N - j][i])
  );
}

// Validasi pergerakan
function isValidMove(matrix, cellRow, cellCol) {
  for (let row = 0; row < matrix.length; row++) {
    for (let col = 0; col < matrix[row].length; col++) {
      if (matrix[row][col] && (
        cellCol + col < 0 ||
        cellCol + col >= playfield[0].length ||
        cellRow + row >= playfield.length ||
        playfield[cellRow + row][cellCol + col]
      )) {
        return false;
      }
    }
  }
  return true;
}

// Menempatkan tetromino pada playfield
function placeTetromino() {
  let rowsCleared = 0;

  for (let row = 0; row < tetromino.matrix.length; row++) {
    for (let col = 0; col < tetromino.matrix[row].length; col++) {
      if (tetromino.matrix[row][col]) {
        if (tetromino.row + row < 0) {
          return showGameOver();
        }
        playfield[tetromino.row + row][tetromino.col + col] = tetromino.name;
      }
    }
  }

  for (let row = playfield.length - 1; row >= 0;) {
    if (playfield[row].every(cell => !!cell)) {
      rowsCleared++;
      for (let r = row; r >= 0; r--) {
        for (let c = 0; c < playfield[r].length; c++) {
          playfield[r][c] = playfield[r - 1][c];
        }
      }
    } else {
      row--;
    }
  }

  updateScore(rowsCleared);
  tetromino = getNextTetromino();
}

// Menampilkan pesan Game Over
function showGameOver() {
  cancelAnimationFrame(rAF);
  gameOver = true;
  leaderboard.push(score);
  leaderboard.sort((a, b) => b - a);
  drawLeaderboard();

  context.fillStyle = 'black';
  context.globalAlpha = 0.75;
  context.fillRect(0, canvas.height / 2 - 30, canvas.width, 60);

  context.globalAlpha = 1;
  context.fillStyle = 'white';
  context.font = '36px monospace';
  context.textAlign = 'center';
  context.textBaseline = 'middle';
  context.fillText('Game Over', canvas.width / 2, canvas.height / 2);
}

// Memperbarui skor
function updateScore(rowsCleared) {
  const pointsPerLine = [0, 100, 300, 500, 800];
  score += pointsPerLine[rowsCleared];

  document.getElementById('score').innerText = `${score}`;
}

// Menggambar leaderboard
function drawLeaderboard() {
  const leaderboardCanvas = document.getElementById('leaderboard');
  const leaderboardContext = leaderboardCanvas.getContext('2d');

  leaderboardContext.clearRect(0, 0, leaderboardCanvas.width, leaderboardCanvas.height);
  leaderboardContext.fillStyle = 'white';
  leaderboardContext.font = '24px monospace';
  leaderboardContext.textAlign = 'left';

  leaderboard.forEach((score, index) => {
    leaderboardContext.fillText(`${index + 1}. ${score}`, 10, 30 + index * 30);
  });
}

// Variabel tambahan untuk Pause
let isPaused = false;

// Fungsi untuk menampilkan atau menyembunyikan menu pause
function togglePauseMenu(show) {
  const pauseMenu = document.getElementById('pauseMenu');
  pauseMenu.style.display = show ? 'flex' : 'none';
}

// Fungsi untuk pause/resume game
function togglePause() {
  if (!gameOver) {
    isPaused = !isPaused;
    if (isPaused) {
      cancelAnimationFrame(rAF); // Hentikan loop game
      togglePauseMenu(true);
    } else {
      togglePauseMenu(false);
      rAF = requestAnimationFrame(loop); // Lanjutkan loop game
    }
  }
}

// Menampilkan pesan Game Over dengan skor akhir, restart, dan back to home
function showGameOver() {
  cancelAnimationFrame(rAF);
  gameOver = true;
  leaderboard.push(score);
  leaderboard.sort((a, b) => b - a);
  drawLeaderboard();

  // Menyimpan skor ke database
  saveScoreToDatabase(score);

  context.fillStyle = 'black';
  context.globalAlpha = 0.75;
  context.fillRect(0, canvas.height / 2 - 30, canvas.width, 60);

  context.globalAlpha = 1;
  context.fillStyle = 'white';
  context.font = '36px monospace';
  context.textAlign = 'center';
  context.textBaseline = 'middle';
  context.fillText('Game Over', canvas.width / 2, canvas.height / 2);
  
  // Teks "Skor Akhir"
  context.font = '24px monospace';
  context.fillText(`Final Score: ${score}`, canvas.width / 2, canvas.height / 2);

  // Tombol Restart
  const restartButton = document.createElement('button');
  restartButton.innerText = 'Restart';
  restartButton.style.position = 'absolute';
  restartButton.style.left = `${canvas.offsetLeft + canvas.width / 2 - 50}px`;
  restartButton.style.top = `${canvas.offsetTop + canvas.height / 2 + 30}px`;
  restartButton.style.width = '100px';
  restartButton.style.height = '40px';
  restartButton.onclick = () => window.location.reload(); // Reload halaman untuk restart

  // Tombol Back to Home
  const homeButton = document.createElement('button');
  homeButton.innerText = 'Home';
  homeButton.style.position = 'absolute';
  homeButton.style.left = `${canvas.offsetLeft + canvas.width / 2 - 50}px`;
  homeButton.style.top = `${canvas.offsetTop + canvas.height / 2 + 80}px`;
  homeButton.style.width = '100px';
  homeButton.style.height = '40px';
  homeButton.onclick = () => (window.location.href = "../../landingPage/home.php"); // Ganti URL jika perlu

  // Menambahkan tombol ke halaman
  document.body.appendChild(restartButton);
  document.body.appendChild(homeButton);
}

function saveScoreToDatabase(score) {
  // Kirimkan skor ke server melalui POST request
  fetch('../tetris/tetris.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'score=' + encodeURIComponent(score),
  })
  .then(response => response.json())  // Mengharapkan JSON dari server
  .then(data => {
    if (data.success) {
      console.log('Score saved:', data.score);
    } else {
      console.error('Error saving score:', data.error);
    }
  })
  .catch(error => console.error('Error:', error));
}

// Inisialisasi variabel utama
const canvas = document.getElementById('game');
const context = canvas.getContext('2d');
const grid = 32;
const tetrominoSequence = [];
const playfield = [];
for (let row = -2; row < 20; row++) {
  playfield[row] = [];
  for (let col = 0; col < 10; col++) {
    playfield[row][col] = 0;
  }
}

const tetrominos = {
  'I': [[0, 0, 0, 0], [1, 1, 1, 1], [0, 0, 0, 0], [0, 0, 0, 0]],
  'J': [[1, 0, 0], [1, 1, 1], [0, 0, 0]],
  'L': [[0, 0, 1], [1, 1, 1], [0, 0, 0]],
  'O': [[1, 1], [1, 1]],
  'S': [[0, 1, 1], [1, 1, 0], [0, 0, 0]],
  'Z': [[1, 1, 0], [0, 1, 1], [0, 0, 0]],
  'T': [[0, 1, 0], [1, 1, 1], [0, 0, 0]]
};

const colors = {
  'I': 'cyan',
  'O': 'yellow',
  'T': 'purple',
  'S': 'green',
  'Z': 'red',
  'J': 'blue',
  'L': 'orange'
};

let score = 0;
let leaderboard = [];
let count = 0;
let tetromino = getNextTetromino();
let tetrominoStopped = false; // Untuk delay
let gameOver = false;
let rAF = null;

// Fungsi utama loop game
function loop() {
  if (!isPaused) {
    rAF = requestAnimationFrame(loop);
    context.clearRect(0, 0, canvas.width, canvas.height);

    // Gambar playfield
    for (let row = 0; row < 20; row++) {
      for (let col = 0; col < 10; col++) {
        if (playfield[row][col]) {
          const name = playfield[row][col];
          context.fillStyle = colors[name];
          context.fillRect(col * grid, row * grid, grid - 1, grid - 1);
        }
      }
    }

    if (tetromino) {
      if (++count > 75) {
        tetromino.row++;
        count = 0;

        if (!isValidMove(tetromino.matrix, tetromino.row, tetromino.col)) {
          tetromino.row--;

          if (!tetrominoStopped) {
            tetrominoStopped = true;
            setTimeout(() => {
              placeTetromino();
              tetrominoStopped = false;
            }, 500); // Delay 500ms sebelum tetromino ditempatkan
          }
        }
      }

      context.fillStyle = colors[tetromino.name];
      for (let row = 0; row < tetromino.matrix.length; row++) {
        for (let col = 0; col < tetromino.matrix[row].length; col++) {
          if (tetromino.matrix[row][col]) {
            context.fillRect(
              (tetromino.col + col) * grid,
              (tetromino.row + row) * grid,
              grid - 1,
              grid - 1
            );
          }
        }
      }
    }
  }
}

// Menambahkan fitur drop langsung dengan tombol Space
function dropTetromino() {
  while (isValidMove(tetromino.matrix, tetromino.row + 1, tetromino.col)) {
    tetromino.row++;
  }
  placeTetromino();
}

// Event listener untuk input pemain
document.addEventListener('keydown', function (e) {
  if (gameOver) return;

  if (e.which === 37 || e.which === 39) {
    const col = e.which === 37 ? tetromino.col - 1 : tetromino.col + 1;
    if (isValidMove(tetromino.matrix, tetromino.row, col)) {
      tetromino.col = col;
    }
  }

  if (e.which === 38) {
    const matrix = rotate(tetromino.matrix);
    if (isValidMove(matrix, tetromino.row, tetromino.col)) {
      tetromino.matrix = matrix;
    }
  }

  if (e.which === 40) {
    const row = tetromino.row + 1;
    if (!isValidMove(tetromino.matrix, row, tetromino.col)) {
      tetromino.row = row - 1;
      if (!tetrominoStopped) {
        tetrominoStopped = true;
        setTimeout(() => {
          placeTetromino();
          tetrominoStopped = false;
        }, 1000);
      }
      return;
    }
    tetromino.row = row;
  }

  if (e.which === 32) { // Tombol Space
    dropTetromino();
  }

  if (e.which === 80 || e.which === 27) { // Tombol P atau Esc untuk Pause
    togglePause();
  }  
});

// Event listener untuk tombol di menu pause
document.getElementById('resumeButton').addEventListener('click', () => {
  togglePause(); // Lanjutkan game
});

document.getElementById('restartButton').addEventListener('click', () => {
  window.location.reload(); // Muat ulang halaman untuk restart
});

document.getElementById('homeButton').addEventListener('click', () => {
  window.location.href = "../../landingPage/home.php"; // Ganti 'index.html' dengan URL halaman utama Anda
});

// Memulai loop game
rAF = requestAnimationFrame(loop);