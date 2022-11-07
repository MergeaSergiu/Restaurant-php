<?php
session_start();
$mysqli = require __DIR__ . "/database.php";
if(isset($_POST['edit_button'])){
    $user_id = $_POST['user_id'];
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_pass = $_POST['password'];

    
    $password_hash = password_hash($user_pass, PASSWORD_DEFAULT);

    $query = "UPDATE user SET name='$user_name', email= '$user_email', password_hash ='$password_hash'
        WHERE id='$user_id'";
    
    $query_run = $mysqli->query($query);

    if($query_run){
        header("Location:SQL_User_Display.php");
        exit(0);
    }

}

?>