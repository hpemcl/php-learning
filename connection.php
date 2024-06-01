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