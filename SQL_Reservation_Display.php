
<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reservation Data Display</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
    <div class= "container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php include('NavbarResData.php'); ?>
        </div>  
    </div>
</div>
<p><strong>
<?php
use LDAP\Result;
 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?></p>
        <h1>List of Reservation</h1>

<div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="Rezervari_admin.php" method="post">
        <div class="modal-body">
           <div class="form-group">
           <label for="res_date">Data</label>
                <input type="date" id="res_date" name="res_date" placeholder="Enter Date...">
            </div>

            <div class="form-group">
            <label for="res_ora">Ora Rezervare</label>
                <input type="time" id="res_ora" name="res_ora" placeholder="Enter a Hour..."> 
            </div>

            <div class="form-group">
            <label for="nr_persoane">Numar Persoane</label>
                <input type="number" id="nr_persoane" name="nr_persoane" placeholder="Enter No. Persons...">
            </div>

            <div class="form-group">
            <label for="feluri_mancare">Meniul dorit</label>
                <input type="text" id="feluri_mancare" name="feluri_mancare" placeholder="Enter Food...">
            </div>

            <div class="form_group">
            <label for="feluri_mancare">Meniul dorit</label>
                <input type="email" id="email" name="email" placeholder="Enter Email...">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
      </div>    
    </form>  
    </div>
    </div>
  </div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddUser">
  Add Data
</button>
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