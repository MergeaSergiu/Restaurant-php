<?php

$host = "localhost:3307";
$dbname = "food_menu";
$username = "root";
$password = "";

$mysqli = new mysqli(hostname: $host,
                    username:$username,
                    password: $password,
                    database: $dbname);

if($mysqli->connect_errno){
    die("Connect error: " . $mysqli->connect_error);
}

return $mysqli;
