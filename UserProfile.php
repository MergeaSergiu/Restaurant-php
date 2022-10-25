<?php
include('top.php');
?>

<div class= "container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include('NavbarProfile.php'); ?>
            </div>  
            </div>
        </div>

        <?php session_start();
        echo "Welcome " . $_SESSION['user_name']?>

<?php 
    $mysqli = require __DIR__ . "/database.php";
    $username= $_SESSION['user_name'];
    echo "<br>"; 
   if(isset($_SESSION["user_name"])){

  $sql = "SELECT * from user WHERE  name = '$username' ";
 
  if($result = $mysqli->query($sql)){
    echo "Datele contului";
   echo "<br>";
  while ($row = $result->fetch_assoc()){
    $field1name = $row["email"];
    echo "Email: ",'<b>' .$field1name. '</b><br/>';
  }

  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();

  $result->free();
    }

    $mysqli2 = require __DIR__ . "/res-lib.php";
    $sql2 = "SELECT * from res_rezervari WHERE  email = '{$user["email"]}' ";
    echo "<br>";
    if($result2 = $mysqli->query($sql2)){
    echo "Datele rezervarilor:";
   echo "<br>";
  while ($row = $result2->fetch_assoc()){
    $field1name = $row["res_date"];
    $field2name = $row["res_ora"];
    $field3name = $row["nr_persoane"];
    $field4name = $row["feluri_mancare"];
    echo "Data: ",'<b>' .$field1name. '</b>' , " Ora: ", '<b>' .$field2name. '</b>',  " Nr_Persoane: ", '<b>' .$field3name. '</b>', " Feluri_Mancare: ", '<b>' .$field4name. '</b><br/>';
  }

  $result2->free();
    
  }
}
?>


    


