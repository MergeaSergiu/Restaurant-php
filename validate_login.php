<?php
$gasit =false;

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE email = '{$_POST["email"]}'" ;

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user){
        if(password_verify($_POST["password"], $user["password_hash"]) && $user["email"] === "adminsergiu@gmail.com"){
            
            session_start();

            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];

            header("Location: AdminPage.php");
            exit;
        }

else if(password_verify($_POST["password"], $user["password_hash"]) &&  $user["email"] !== "adminsergiu@gmail.com") {
            session_start();

            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];

            header("Location: Rezervari_page.php");
            exit;
        }
    }
}