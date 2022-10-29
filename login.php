<?php

$mysqli = require __DIR__ . "/database.php";
require __DIR__ ."/database.php";

    $is_invalid = false;
    $email=$_POST["email1"];
    $pass=$_POST["password1"];

    $sql = "SELECT * FROM user WHERE email= '$email' AND password = '$pass'";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if($user){
        if( $email == "adminsergiu@gmail.com" && password_verify($_POST["password"], $user["password_hash"])){
            session_start();
            $_SESSION["user_name"] = $user["name"];
            header("Location: AdminPage.php");
        }

        else{
            header("Location:Rezervari_page");
        }

    }
    else{
        echo "Contul nu exista";
    }

?>

<?php
include('top.php');
?>
    <div class= "container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include('Navbar.php'); ?>
            </div>  
            </div>
        </div>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <div class="container">
            <div class=" row justify-content-center" >
                <div class ="card w-70">
                        <div class="card-header text-center">
                        <h1>Login Form</h1>
        <?php if($is_invalid): ?>
            <em>Invalid login </em>
        <?php endif; ?>   
                    </div>
                <div class="card-body">
        <form method="post">
            <div class="form-group">
        <label for="email">Email Adress</label>
        <input type="email" name="email1" id="email1"
            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            </div>
            <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password1" id="password1">
        </div>
        <button class="btn btn-success">Login</button>

        </form>
                </div>
                <div class="card-footer text-right">
                    <small>&copy; Restaurant App</small>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>