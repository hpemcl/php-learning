<?php

function check_login($con)
{
    if(isset($_SESSION['user_id']))
    {
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id ='$id' limit 1";

        $result = mysqli_query($con,$query);
        //hvis result er positiv, så er mysqli_num_rows af result er større end 0, så er vi klaret
        if($result && mysqli_num_rows($result) > 0)
        {
            //associative arrays
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login
    header("Location: login.php");
    //to make sure that the code dies
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

    for
}