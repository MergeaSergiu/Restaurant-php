
<?php
include('top.php');
?>

<div class= "container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php include('NavbarResData.php'); ?>
        </div>  
    </div>
</div>

<?php

use LDAP\Result;

 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Reservation Data Display</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body style = "margin:50px;">
        <h1>List of Reservation</h1>
        <br>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">Res. Date</th>
				<th scope="col">Start Hour</th>
				<th scope="col">Nr.Persoane</th>
				<th scope="col">Feluri Mancare</th>
				<th scope="col">Email</th>
                </tr>
            </thead>
    <tbody>
<?php 
    $mysqli = require __DIR__ . "/res-lib.php";
  $sql = "SELECT * from res_rezervari";
  if($result = $mysqli->query($sql)){

  while ($row = $result->fetch_assoc()){
    echo "<tr>
        <td>" . $row["res_date"] . "</td>
        <td>" . $row["res_ora"] . "</td>
        <td>" . $row["nr_persoane"] . "</td>
        <td>" . $row["feluri_mancare"] . "</td>
        <td>" . $row["email"] . "</td>
        </tr>";
  }

  $result->free();
}
?> 
            </tbody>
        </table>
    </body>
</html>