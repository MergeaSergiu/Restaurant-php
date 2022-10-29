<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body> 
    <div class= "container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include('NavBarAdmin.php'); ?>
            </div>  
            </div>
        </div>
        <p><strong><?php
use LDAP\Result;
 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?></p>

<div class="card" style="width: 18rem;">
  <img src="./imagini/poza8.jpg" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">Latest Info</h5>
    <p class="card-text">Already <?php
    $mysqli = require __DIR__ . "/database.php";
    $count = 0;
    $sql = "SELECT * FROM user";
    $result = $mysqli->query($sql);
    if($result){
    $row = mysqli_num_rows($result);
     printf($row);
    }
    ?> customers has created an account.<br>
       Already <?php 
       $mysqli = require __DIR__ . "/res-lib.php";
       $count2 = 0;
       $sql2 = "SELECT * FROM res_rezervari";
       $result2 = $mysqli->query($sql2);
       if($result2){
       $row2 = mysqli_num_rows($result2);
        printf($row2);
       }
    ?> reservations where made. </p>
  </div>
  <div class="card-body">
    <a href="SQL_Reservation_Display.php" class="card-link">User Page</a>
    <a href="SQL_User_Display.php" class="card-link">Reservation Page</a>
  </div>
</div>

</body>
</html>
