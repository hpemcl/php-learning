<?php
//interaktion med min datapase med SQLI - her bruger jeg $con for at få fat i min database som jeg har skabt via localhost
    $con = mysqli_connect('localhost', 'root', 'Hent5fisk!', 'php_learning');

    //hvis der er en error med at hente databasen
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //interaktion med at hente products fra databasen med featured as 1
    $sql = "SELECT * FROM products WHERE featured=1";
    $featured = $con->query($sql);

    //hvis der er en error med at hente products
    if ($featured === false) {
        die("Error: " . $con->error);
    }
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
            <img src="./images/logo.png" alt="logo" width="40" height="24">
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
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item fw-medium" href="#">Login</a></li>
                            <li><a class="dropdown-item fw-medium" href="#">Help</a></li>
                            <li><hr class="dropdown-divider "></li>
                            <li><a class="dropdown-item fw-medium" href="#">FAQ</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-dark" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hero section -->
    <section class="text-center p-5 py-5">
        <div class="container ">
            <h1 class="display-4 fw-bold">Welcome to Our Shop</h1>
            <p class="lead fw-medium">Discover amazing products at unbeatable prices.</p>
            <a href="#" class="btn text-uppercase fw-medium btn-custom-primary btn-lg">Shop Now</a>
        </div>
    </section>

    <!-- Featured Products section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Featured Products</h2>
            <div class="row">
                <?php while ($product = mysqli_fetch_assoc($featured)) : ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?= $product['image']; ?>" class="card-img-top" alt="<?= $product['title']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $product['title']; ?></h5>
                                <p class="card-text"><?= $product['description']; ?></p>
                                <p class="card-text"><strong>Price: </strong>$<?= $product['prices']; ?></p>
                                <a href="#" class="btn fw-medium btn-dark">Buy Now</a>
                                <a href="#" class="btn fw-medium btn-more">More</a>
                            </div>
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
