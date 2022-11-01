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
        <style>
            body{
                background: #f1f5d3;
            }
        </style>
    </head>
    <body> 
    <div class= "container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include('NavBarFoodMenu.php'); ?>
            </div>  
            </div>
        </div>
<p><strong>
<div class="alert alert-primary" role="alert">
<?php
use LDAP\Result;
 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?></div></p>
<?php
$mysqli = require __DIR__ . "/database_food.php";
$sql = "SELECT * from pizza";
if($result = $mysqli->query($sql)){
    while ($row = $result->fetch_assoc()){
?>
<div class="card bg-info" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">
        <?php
        echo $row["Name_Food"];
        ?></h5>
    <p class="card-text">Price: <?php 
        echo $row["Price"];
    ?></p>
  </div>
</div>
<?php
    }
}
?>
<br>
<?php
$mysqli = require __DIR__ . "/database_food.php";
$sql = "SELECT * from desert";
if($result = $mysqli->query($sql)){
    while ($row = $result->fetch_assoc()){
?>
<div class="card bg-success" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">
        <?php
        echo $row["Name_Food"];
        ?></h5>
    <p class="card-text">Price: <?php 
        echo $row["Price"];
    ?></p>
  </div>
</div>
<?php
    }
}
?>

<br>
<?php
$mysqli = require __DIR__ . "/database_food.php";
$sql = "SELECT * from bauturi";
if($result = $mysqli->query($sql)){
    while ($row = $result->fetch_assoc()){
?>
<div class="card bg-success" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">
        <?php
        echo $row["Name_Food"];
        ?></h5>
    <p class="card-text">Price: <?php 
        echo $row["Price"];
    ?></p>
  </div>
</div>
<?php
    }
}
?>

<br>
<?php
$mysqli = require __DIR__ . "/database_food.php";
$sql = "SELECT * from fripturi";
if($result = $mysqli->query($sql)){
    while ($row = $result->fetch_assoc()){
?>
<div class="card bg-success" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">
        <?php
        echo $row["Name_Food"];
        ?></h5>
    <p class="card-text">Price: <?php 
        echo $row["Price"];
    ?></p>
  </div>
</div>
<?php
    }
}
?>



</body>
</html>