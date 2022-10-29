<?php

session_start();

if(empty($_POST["res_date"])){
    die("A valid data is required");
}
else if( strtotime($_POST["res_date"]) < strtotime("now")){
    die("Data nu este valabila");
}

else if( empty($_POST["res_ora"])){
    die("A valid hour is required");
}

else if($_POST["nr_persoane"] <1  || $_POST["nr_persoane"] >10 ) {
    die("A valid number of person");
}

else if ( !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("A Valid email is required");
}

else if( empty($_POST["email"])){
    die("An email is required");
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
        $stmt->close();  
    }
}
    else{
        die("Nu este userul curent");
        
    }
}else{
        
        die("Rezervarea nu a functionat");
         
    }
    
}

else{
    die("Ceva nu a functionat");
}


?>
