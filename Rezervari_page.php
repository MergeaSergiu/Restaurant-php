
<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rezervare Masa</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <h1>Rezerva Masa</h1>
        <form action="Rezervari.php" method="post">
            <div>
                <label for="res_date">Data</label>
                <input type="date" id="res_date" name="res_date">
            </div>
            <div>
                <label for="res_ora">Ora Rezervare</label>
                <input type="time" id="res_ora" name="res_ora" > 
            </div>

            <div>
                <label for="nr_persoane">Numar Persoane</label>
                <input type="number" id="nr_persoane" name="nr_persoane">
            </div>

            <div>
                <label for="feluri_mancare">Meniul dorit</label>
                <input type="text" id="feluri_mancare" name="feluri_mancare">
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <button>Creeaza Rezervare</button>
        </form>
    </body>
</html>
