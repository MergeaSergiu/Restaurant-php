<?php

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

if(empty($email)){
    die( "A valid email is required"); 

}
else if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("A valid email is required"); 
}

else if(strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}
else {

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
        }

        else if(password_verify($_POST["password"], $user["password_hash"]) &&  $user["email"] !== "adminsergiu@gmail.com") {
            
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            header("Location: Rezervari_page.php");
        }
        else if( !password_verify($_POST["password"], $user["password_hash"])){
            die("User-ul nu exista in baza de date");
        }
    }
    else{

        die("This user doesn't exist");
    }
}


}
?>