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
        <?php
use LDAP\Result;
 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?>

</body>
</html>
