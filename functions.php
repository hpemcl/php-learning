<?php

function check_login($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);
        // hvis result er positiv, så er mysqli_num_rows af result er større end 0, så er vi klaret
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }
    // Redirect to login if not logged in 
    header("Location: login.php");
    // to make sure that the code dies
    die;
}

function random_num($length)
{
    $text = "";
    if($length < 5)
    {
        $length = 5;
    }

    $len = rand(4,$length);

    for ($i=0; $i < $len; $i++) { 
        $text .= rand(0,9);
    }

    return $text;
}

// Opret en ny administratorbruger
$user_id = random_num(20);
$user_name = 'admin'; 
$password = 'admin123'; 
$admin = true;

$query = "INSERT INTO users (user_id, user_name, password, admin) VALUES ('$user_id', '$user_name', '$password', $admin)";
