<?php

$email = $_POST["email"];

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

if(isset($_POST['insertdata'])){

$mysqli = require __DIR__ . "/database.php";

$count = 0;
$sql2 = "SELECT * FROM user WHERE email = '$email'";

$rscheck = $mysqli->query($sql2);
$count = mysqli_num_rows($rscheck);
if($count === 1){        
    $mysqli2 = require __DIR__ . "/res-lib.php";
    
    $sql = "INSERT INTO res_rezervari (res_date,res_ora,nr_persoane,email) 
               VALUES(?,?,?,?,?)";

    $stmt = $mysqli2->stmt_init();
    
    if( !$stmt->prepare($sql)){
       die("SQL error: " . $mysqli2->error);
    }
    
    $stmt->bind_param("sssss",
                   $_POST["res_date"],
                   $_POST["res_ora"],
                   $_POST["nr_persoane"],
                   $_POST["email"]);
    
    if($stmt->execute()){
     header("SQL_Reservation_Display.html");
      $stmt->close();
    }
    else {
        echo "Nu s-a inregistrat contul";
    }
}

}else{
    echo "Email does not exist";
}

?>