<?php

use LDAP\Result;

 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?>

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


<!DOCTYPE html>
<html>
    <head>
        <title>Reservation Data Display</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
        <script src="/js/validation.js" defer></script>
    </head>
    <body>
    <div>
<?php 
    $mysqli = require __DIR__ . "/res-lib.php";
   echo "List of reservations created at restaurant";
   echo "<br>";
  $sql = "SELECT * from res_rezervari";
  if($result = $mysqli->query($sql)){

  while ($row = $result->fetch_assoc()){
    $field1name = $row["res_date"];
    $field2name = $row["res_ora"];
    $field3name = $row["nr_persoane"];
    $field4name = $row["feluri_mancare"];
    $field5name = $row["email"];
    echo " <br>";
    echo "Date: ",'<b>' .$field1name. '</b>', " Start Hour: ", '<b>'.$field2name. '</b>', " Numar Persoane: ", '<b>'.$field3name. '</b>' , " Feluri Mancare: ", '<b>' .$field4name. '</b>', " Email: ", '<b>' .$field5name.'</b><br />';
  }

  $result->free();
}
?>
</div> 

</body>
</html>