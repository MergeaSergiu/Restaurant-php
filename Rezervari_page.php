<?php

session_start();
$error ="";

if(isset($_POST["button_res"])){

if(empty($_POST["res_date"])){
    $error="Apare eroarea";
}
else if( strtotime($_POST["res_date"]) < strtotime("now")){
    $error ="Data nu este valabila";
}

else if( empty($_POST["res_ora"])){
    $error = "A valid hour is required";
}

else if($_POST["nr_persoane"] <1  || $_POST["nr_persoane"] >10 ) {
    $error = "A valid number of person";
}

else if ( !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $error = "A Valid email is required";
}

else if( empty($_POST["email"])){
    $error = "An email is required";
}

else if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["user_name"])){

$mysqli = require __DIR__ . "/database.php";
$sql = sprintf("SELECT * FROM user 
                WHERE email = '%s' ",
                    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user){
        if($user["name"] === $_SESSION["user_name"]){
        
    $mysqli2 = require __DIR__ . "/res-lib.php";
    
    $sql2 = "INSERT INTO res_rezervari (res_date,res_ora,nr_persoane,email) 
               VALUES(?,?,?,?)";
    $stmt = $mysqli->stmt_init();
    
    if( !$stmt->prepare($sql2)){
       die("SQL error: " . $mysqli2->error);
    }
    
    $stmt->bind_param("ssss",
                   $_POST["res_date"],
                   $_POST["res_ora"],
                   $_POST["nr_persoane"],
                   $_POST["email"]);
    
    if($stmt->execute()){
        header("Location: Rezervari_page.php");
    }
}
    else{
       $error =  "Nu este userul curent";
        
    }
}else{
        $error = "Rezervarea nu a functionat";  
    }
}
else{
    $error = "Ceva nu a functionat";
}

}
?>


<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rezervare Masa</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <style>
            body{
                background: #f1f5d3;
            }
        </style>
    </head>
    <div class= "container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include('NavbarRes.php'); ?>
            </div>  
            </div>
        </div>
    <body>
    <p><strong>
    <?php
    use LDAP\Result;
    echo "Welcome " . $_SESSION['user_name'];
    ?></p>
    <div class="container">
            <div class=" row justify-content-center" >
                <div class ="card w-70">
                        <div class="card-body">
        <h1>Rezerva Masa</h1>
        <p class="error"> <?php echo $error; ?> </p>
        <form action="" method="post">
            <div class="form-group">
                <label for="res_date">Data</label>
                <input type="date" id="res_date" name="res_date">
            </div>
            <div class="form-group">
                <label for="res_ora">Ora Rezervare</label>
                <input type="time" id="res_ora" name="res_ora" > 
            </div>

            <div class="form-grup">
                <label for="nr_persoane">Numar Persoane</label>
                <input type="number" id="nr_persoane" name="nr_persoane">
            </div>

            <div class="form- form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <button class ="btn btn-success" name="button_res">Creeaza Rezervare</button>
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
