<?php
session_start();
include("connection.php");
include("functions.php");

// Check if the user is logged in
$user_data = null;
if (isset($_SESSION['user_id'])) {
    $user_data = check_login($con);
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kunde Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg text-black bg-danger-subtle fw-medium fs-5">
        <div class="container-fluid">
            <a class="nav-link active" aria-current="page" href="index.php">
                <img src="./images/logo.png" alt="logo" width="40" height="24">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Settings
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item fw-medium" href="logout.php">Log out</a></li>
                            <li><a class="dropdown-item fw-medium" href="#">Help</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item fw-medium" href="#">FAQ</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex me-auto w-50" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-dark" type="submit">Search</button>
                </form>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Welcome Section -->
    <section class="text-start p-5 py-5">
        <div class="container-fluid">
            <h2 class="fw-bold">Welcome, <?= htmlspecialchars($user_data['user_name']); ?>!</h2>
            <p class="lead fw-medium">Enjoy shopping with us. Find the best products at unbeatable prices.</p>
            <a href="#" class="btn text-uppercase fw-medium btn-custom-primary btn-lg">Shop Now</a>
            <br><br>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
