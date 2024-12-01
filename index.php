<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Play</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Bagian Header -->
    <header class="text-center p-4">
        <h1 class="custom-font">Classic Play</h1>
    </header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand">Classic Play</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="landingPage/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Perkenalan Singkat -->
    <section class="intro text-center py-5">
        <h2 class="mb-4">Welcome to Classic Play!</h2>
        <p class="mx-auto w-75">Classic Play is your gateway to timeless and exciting games! Explore our collection, connect with fellow gamers, and relive the nostalgia of classic gaming. Whether you're here to relax, compete, or simply have fun, Classic Play has something for everyone. Let's dive in and start playing!</p>
    </section>

    <!-- Tombol Login dan Register -->
    <div class="text-center mb-5">
        <a class="btn btn-primary mx-2" href="landingPage/login.php">Login</a>
        <a class="btn btn-secondary mx-2" href="landingPage/register.php">Register</a>
    </div>

    <!-- Bagian Footer -->
    <footer class="text-center py-3 bottom-0">
        <p>&copy; 2024 Classic Play. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
