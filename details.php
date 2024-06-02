<?php
//interaktion med min datapase med SQLI - her bruger jeg $con for at få fat i min database som jeg har skabt via localhost
session_start();
    $_SESSION;

    //istedet for at jeg skal skrive min connection til min database, så kan jeg bruge en ekstra side som jeg skal koble til alle sider -
    //derfor skriver jeg include, da den skal inkludere connection.php-filen på alle sider, så jeg kan få fat i min database på hvilken som helst php fil
    include("connection.php");
    include("functions.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Eksamen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
    <!-- navbar -->
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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Settings
                        </a>
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item fw-medium" href="#">Login</a></li>
                            <li><a class="dropdown-item fw-medium" href="#">Help</a></li>
                            <li><hr class="dropdown-divider "></li>
                            <li><a class="dropdown-item fw-medium" href="#">FAQ</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex me-auto w-50" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-dark" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    
    <!-- Featured Products section -->
    <?php while ($product = mysqli_fetch_assoc($featured)) : ?>
    <section class="py-5">
        <div class="container">
            <h2 class="text-start text-uppercase fw-bold mb-4"><?= $product['title']; ?></h2>
            <div class="row">
                    <div class="col-md-4 mb-4">
                        <img src="<?= $product['image']; ?>" class="card-img-top img-edit" alt="<?= $product['title']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['title']; ?></h5>
                            <p class="card-text"><?= $product['description']; ?></p>
                            <p class="card-text"><strong>Price: </strong>$<?= $product['prices']; ?></p>
                            <a href="#" class="btn fw-medium btn-dark">Buy Now</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-4">
        <div class="container">
            <p>&copy; 2024 Webshop. All rights reserved.</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#" class="text-white">Privacy Policy</a></li>
                <li class="list-inline-item"><a href="#" class="text-white">Terms of Use</a></li>
                <li class="list-inline-item"><a href="#" class="text-white">Contact Us</a></li>
            </ul>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>