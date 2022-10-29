<?php

$table_name= $_POST["Food_Type"];
$food_name= $_POST["Name_Food"];


if(isset($_POST['insertfood'])){

    $mysqli = require __DIR__ . "/database_food.php";
    
    $count = 0;
    $sql2 = "SELECT * FROM $table_name WHERE Name_Food = '$food_name' ";
    
    $rscheck = $mysqli->query($sql2);
    $count = mysqli_num_rows($rscheck);
    if($count === 0){        
        
        $sql = "INSERT INTO $table_name (Name_Food,Price) 
                   VALUES(?,?)";
    
        $stmt = $mysqli->stmt_init();
        
        if( !$stmt->prepare($sql)){
           die("SQL error: " . $mysqli->error);
        }
        
        $stmt->bind_param("ss",
                       $_POST["Name_Food"],
                       $_POST["Price"]
    );
        
        if($stmt->execute()){
         header("SQL_Food_Menu_Display.php");
          $stmt->close();
        }
        else {
            echo "Nu s-a inregistrat mancarea";
        }
    }
    
    }else{
        echo "Mancarea exista deja";
    }
    
    ?>