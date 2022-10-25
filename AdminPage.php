
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
        <script src="/js/validation.js" defer></script>
    </head>
    <body>
    <?php
include('top.php');
?>
    <div class= "container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include('NavBarAdmin.php'); ?>
            </div>  
            </div>
        </div>
        <p><strong>
<?php
use LDAP\Result;
 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?></p>

</body>
</html>
