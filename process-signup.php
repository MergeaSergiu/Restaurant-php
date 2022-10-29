<?php

$email = $_POST["email"];
$error = "";

if(empty($_POST["name"])){
    $error = "Invalid Name";
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $error = "Valid email is required";
}

if(strlen($_POST["password"]) < 8) {
     $error = "Password must be at least 8 characters";
}

if( ! preg_match("/[a-z]/i", $_POST["password"])){
    $error = "Password must contain at least one letter";
}

if( ! preg_match("/[0-9]/", $_POST["password"])){
    $error = "Password must contain at least one number";
}

if( $_POST["password"] !== $_POST["password_confirmation"]) {
    $error = "Passwords do not match";
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

 $mysqli = require __DIR__ . "/database.php";

 require __DIR__ ."/database.php";
$count = 0;
$sql2 = "SELECT * FROM user WHERE email = '$email'";

$rscheck = $mysqli->query($sql2);
$count = mysqli_num_rows($rscheck);
if($count === 0){

    $sql = "INSERT INTO user (name, email, password_hash) 
            VALUES(?,?,?)";

$stmt = $mysqli->stmt_init();

if( ! $stmt->prepare($sql)){
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                $_POST["name"],
                $_POST["email"],
                $password_hash);

if($stmt->execute()){
      header("Rezervari_page.html");
      $stmt->close();
} else {
    $error =  "Nu s-a inregistrat contul";
}

}else{
    $error = "Email already exist";
}
?>