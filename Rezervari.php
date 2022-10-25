
<?php

session_start();

if(empty($_POST["res_date"])){
    die("A valid data is required");
}

if ( empty($_POST["res_ora"])){
    die("A valid hour is required");
    
}

if($_POST["nr_persoane"] <0  || $_POST["nr_persoane"] >10 ) {
    die("A valid number of person");
    
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("Valid email is required");
}


if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["user_name"])){

$mysqli = require __DIR__ . "/database.php";
$sql = sprintf("SELECT * FROM user 
                WHERE email = '%s' ",
                    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user){
        if($user["name"] === $_SESSION["user_name"]){
        
    $mysqli2 = require __DIR__ . "/res-lib.php";
    
    $sql2 = "INSERT INTO res_rezervari (res_date,res_ora,nr_persoane,feluri_mancare,email) 
               VALUES(?,?,?,?,?)";
    $stmt = $mysqli->stmt_init();
    
    if( !$stmt->prepare($sql2)){
       die("SQL error: " . $mysqli2->error);
    }
    
    $stmt->bind_param("sssss",
                   $_POST["res_date"],
                   $_POST["res_ora"],
                   $_POST["nr_persoane"],
                   $_POST["feluri_mancare"],
                   $_POST["email"]);
    
    if($stmt->execute()){
        echo "Rezervare cu success";
        $stmt->close();  
    }
}
    else{
        
        header("Location: Rezervari_page.php");
        
    }
}else{
        #echo "<script> alert('Userul curent nu corespunde cu emailul introduse .Incercati alt email')</script>";
        header("Location: Rezervari_page.php");
         
    }
    
}

else{
    die("Ceva nu a functionat");
}


?>
