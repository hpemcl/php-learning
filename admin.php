<?php
session_start();
include("connection.php");
include("functions.php");

// Check if the user is logged in
$user_data = check_login($con);

// Check if the user is an admin
if ($user_data['admin'] != 1) {
    header("Location: index.php");
    die;
}

// Handle product addition
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_product'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $brandname = $_POST['brandname'];
    $description = $_POST['description'];
    $featured = $_POST['featured'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            if (!empty($title) && !empty($price) && !empty($brandname)) {
                $query = "INSERT INTO products (title, prices, brandname, image, description, featured) VALUES ('$title', '$price', '$brandname', '$target_file', '$description', '$featured')";
                mysqli_query($con, $query);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file was uploaded or there was an error with the upload.";
    }
}

// Handle brand addition
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_brand'])) {
    $brandname = $_POST['brandname'];

    if (!empty($brandname)) {
        $query = "INSERT INTO brands (brandname) VALUES ('$brandname')";
        mysqli_query($con, $query);
    }
}

// Handle product deletion
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    $query = "DELETE FROM products WHERE id = '$product_id'";
    mysqli_query($con, $query);
}

// Handle all products deletion
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_all_products'])) {
    $query = "DELETE FROM products";
    mysqli_query($con, $query);
}

// Fetch products and brands from database
$products = mysqli_query($con, "SELECT * FROM products");
$brands = mysqli_query($con, "SELECT * FROM brands");

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles.css">

    <style>
        .image-admin{
            width: 20% !important;
            height: 20% !important;
            object-fit: cover !important;
        }
    </style>
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
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-5">Admin Page</h1>
        
        <!-- Add Product Form -->
        <h2>Add Product</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="add_product" value="1">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="brandname" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brandname" name="brandname" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="featured" class="form-label">Featured</label>
                <select class="form-control" id="featured" name="featured">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>

        <!-- Add Brand Form -->
        <h2 class="mt-5">Add Brand</h2>
        <form method="post">
            <input type="hidden" name="add_brand" value="1">
            <div class="mb-3">
                <label for="brandname" class="form-label">Brand Name</label>
                <input type="text" class="form-control" id="brandname" name="brandname" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Brand</button>
        </form>

        <!-- Display Products -->
        <h2 class="mt-5">Products</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($product = mysqli_fetch_assoc($products)): ?>
                <tr>
                    <td><?= $product['title'] ?></td>
                    <td><?= $product['prices'] ?></td>
                    <td><?= $product['brandname'] ?></td>
                    <td><img class="image-admin" src="<?= $product['image'] ?>"></td>
                    <td><?= $product['description'] ?></td>
                    <td><?= $product['featured'] ?></td>
                    <td>
                        <form method="post" class="d-inline">
                            <input type="hidden" name="delete_product" value="1">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <form method="post">
            <input type="hidden" name="delete_all_products" value="1">
            <button type="submit" class="btn btn-danger">Delete All Products</button>
        </form>

        <!-- Display Brands -->
        <h2 class="mt-5">Brands</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Brand Name</th>
                </tr>
            </thead>
            <tbody>
                <?php while($brand = mysqli_fetch_assoc($brands)): ?>
                <tr>
                    <td><?= $brand['brandname'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>


