<?php
include('top.php');
?>
<p><strong>
<?php
use LDAP\Result;
 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?></p>
<!DOCTYPE html>
<html>
    <head>
        <title>User Data Display</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
    <div class= "container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include('NavbarProfile.php'); ?>
            </div>  
            </div>
        </div>
    <h1> Datele contului</h1>
    <br>
    <table class="table table-striped table-dark">
        <thead>
            <tr>    
                <th>Name</th>
                <th>Email</th>
            </tr>
    </thead>
    <tbody>
<?php 
    $mysqli = require __DIR__ . "/database.php";
    $username= $_SESSION['user_name'];
    echo "<br>"; 
   if(isset($_SESSION["user_name"])){

  $sql = "SELECT * from user WHERE  name = '$username' ";
 
  if($result = $mysqli->query($sql)){
    while ($row = $result->fetch_assoc()){
      echo "<tr>
      <td>" . $row["name"] . "</td>
      <td>" . $row["email"] . "</td>
      </tr>";
    }
    $result->free();

  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();

  $result->free();
    }
  }
   
?>
</tbody>
  </table>

  <table class="table table-striped table-dark">
        <thead>
            <tr>    
                <th>Res.Date</th>
                <th>Start Hour</th>
                <th>Nr.Persoane</th>
            </tr>
    </thead>
    <tbody>
    <?php 
    $mysqli2 = require __DIR__ . "/res-lib.php";
    $sql2 = "SELECT * from res_rezervari WHERE  email = '{$user["email"]}' ";
    if($result2 = $mysqli->query($sql2)){

        while ($row = $result2->fetch_assoc()){
    echo "<tr>
      <td>" . $row["res_date"] . "</td>
      <td>" . $row["res_ora"] . "</td>
      <td>" . $row["nr_persoane"] . "</td>
      </tr>";
    }
  $result2->free();
  
  }
?>
      </tbody>
    </table>
  </body>
</html>



    


