
<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rezervare Masa</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
        div#container {
            background-color: aqua;
        }
        </style>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <div class= "container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include('NavbarRes.php'); ?>
            </div>  
            </div>
        </div>
    <body>
    <p><strong>
    <?php
    use LDAP\Result;
    session_start();
    echo "Welcome " . $_SESSION['user_name'];
    ?></p>
    <div class="container">
            <div class=" row justify-content-center" >
                <div class ="card w-70">
                        <div class="card-body">

        <h1>Rezerva Masa</h1>
        <form action="Rezervari.php" method="post">
            <div class="form-group">
                <label for="res_date">Data</label>
                <input type="date" id="res_date" name="res_date">
            </div>
            <div class="form-group">
                <label for="res_ora">Ora Rezervare</label>
                <input type="time" id="res_ora" name="res_ora" > 
            </div>

            <div class="form-grup">
                <label for="nr_persoane">Numar Persoane</label>
                <input type="number" id="nr_persoane" name="nr_persoane">
            </div>

            <div class="form- form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <button class ="btn btn-success">Creeaza Rezervare</button>
    </form>
    </div>
    <div class="card-footer text-right">
        <small>&copy; Restaurant App</small>
    </div>
    </div>
    </div>
    </div>
    </body>
</html>
