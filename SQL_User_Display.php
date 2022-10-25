
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
                <?php include('NavbarUserDataPage.php'); ?>
            </div>  
            </div>
        </div>
<!DOCTYPE html>
<html>
    <head>
        <title>User Data Display</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
        <script src="/js/validation.js" defer></script>
    </head>
    <body>
    <div>
<?php 
    $mysqli = require __DIR__ . "/database.php";
   echo "List of accounts created at restaurant";
   echo "<br>";
  $sql = "SELECT * from user";
  if($result = $mysqli->query($sql)){

  while ($row = $result->fetch_assoc()){
    $field1name = $row["name"];
    $field2name = $row["email"];
    echo " \n";
    echo "Name: ",'<b>' .$field1name. '</b>', " Email: ", '<b>' .$field2name. '</b><br/>';
  }

  $result->free();
}
?>
</div> 

</body>
</html>