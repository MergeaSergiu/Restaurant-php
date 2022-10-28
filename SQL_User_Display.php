<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Data Display</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body >
    <div class= "container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php include('NavbarUserDataPage.php'); ?>
        </div>  
    </div>
</div>
<p><strong>
<?php
 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?></p>
    <h1> List of Users</h1>
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
    $sql = "SELECT * from user";
    if($result = $mysqli->query($sql)){

  while ($row = $result->fetch_assoc()){
    echo "<tr>
    <td>" . $row["name"] . "</td>
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