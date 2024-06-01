<?php

session_start();
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //something was posted
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {
            //save to database
            $user_id = random_num(20);
            $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
            
            mysqli_query($query);

            header("Location: login.php");
            die;
        
        } else {
            echo "Please enter some valid information!";
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css">
</head>
<body class="bg-dark">

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
                            <li><a class="dropdown-item fw-medium" href="./login.php">Login</a></li>
                            <li><a class="dropdown-item fw-medium" href="#">Help</a></li>
                            <li><hr class="dropdown-divider"></li>
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

    <!-- Signup Form -->
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="row w-100">
            <div class="col-md-6 mx-auto">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Sign Up</h3>
                        <form method="post">
                            <div class="mb-3 row">
                                <label for="username" class="col-sm-3 col-form-label fw-medium">Username</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="username" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-sm-3 col-form-label fw-medium">Password</label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" id="password" required>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-custom-primary btn-lg">Login</button>
                            </div>
                            <p class="text-center mt-3">Already have an account?
                                <a href="./signup.php" class="fw-medium">Log in</a>
                            </p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
