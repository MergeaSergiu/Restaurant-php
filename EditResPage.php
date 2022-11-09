<?php 
session_start();
$a=0;
$error = "";
if(isset($_POST['edit_res'])){
    $res_id = $_POST['res_id'];
    $dbformat4= $_POST["res_ora"];
    $dbFormat1 = date('H:i:s', strtotime('10:00 AM'));
    $dbFormat2 = date('H:i:s', strtotime('23:00 PM'));
    $dbFormat3 = date('H:i:s', strtotime($dbformat4));
        $a=0;
$email = $_POST["email"];

if(empty($_POST["res_date"])){
    $error = "A valid data is required";
    $a=1;
}

else if ( empty($_POST["res_ora"])){
    $error = "A valid hour is required";
    $a=1;
}
else if( strtotime($_POST["res_date"]) < strtotime("now")){
  $error ="Data nu este valabila";
  $a=1;
}

else if( strtotime($dbFormat3)  < strtotime($dbFormat1) && strtotime($dbFormat3) >  strtotime($dbFormat2)) { 
  $error = "In acel interval suntem inchisi";
  $a=1;
}

else if($_POST["nr_persoane"] <0  || $_POST["nr_persoane"] >10 ) {
    $error = "A valid number of person";
    $a=1;
}

else if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $error = "Valid email is required";
    $a=1;
}

else{
    $mysqli = require __DIR__ . "/res-lib.php";
    $query = "UPDATE res_rezervari SET res_date='{$_POST["res_date"]}', res_ora = '{$_POST["res_ora"]}' , nr_persoane= '{$_POST["nr_persoane"]}', email='{$_POST["email"]}' 
        WHERE res_id='$res_id'";
    
    $query_run = $mysqli->query($query);

    if($query_run){
        header("Location:SQL_Reservation_Display.php");
        exit(0);
    }

}

}

if($a === 1) {?>
    <div class="alert">
      <span class="closebtn">&times;</span>  
      <strong><?php echo $error; ?></strong>
    </div>
    <?php
    }
?>
<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit User</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <style>
            body{
                background: #f1f5d3;
            }
        </style>
        <style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}

.alert.success {background-color: #04AA6D;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
    </head>
    <body>
    <div class= "container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include('NavBarEditPage.php'); ?>
            </div>  
            </div>
        </div>
        <p><strong>
    <div class="alert alert-primary" role="alert">
      <?php
      echo "Welcome " . $_SESSION['user_name'];
      ?></div></p>
    <h1> Datele contului</h1>
        <div class="container vh-100">
            <div class = "row justify-content-center">
                <div class ="card w-70">
                    <div class="card-header text-center">
                <h2>Edit Reservation</h2>
                    </div>
                <div class="card-body">
        <?php
        if(isset($_GET['res_id']))
        {   
            $mysqli = require __DIR__ . "/res-lib.php";
            $res_id = $_GET['res_id'];
            $reservations = "SELECT * FROM res_rezervari WHERE res_id='$res_id'";
            $reservations_run = $mysqli->query($reservations);

            if(mysqli_num_rows($reservations_run) > 0)
            {
                    foreach($reservations_run as $reservation){
                        ?>
                  <form action="" method="POST" >
        
        <input type="hidden" name="res_id" value="<?=$reservation['res_id'];?>">
           <div class="form-group">
           <label for="res_date">Data</label>
                <input type="date" id="res_date" name="res_date" value="<?=$reservation['res_date'];?>"placeholder="Enter Date...">
            </div>

            <div class="form-group">
            <label for="res_ora">Ora Rezervare</label>
                <input type="time" id="res_ora" name="res_ora" value="<?=$reservation['res_ora'];?>"placeholder="Enter a Hour..."> 
            </div>

            <div class="form-group">
            <label for="nr_persoane">Numar Persoane</label>
                <input type="number" id="nr_persoane" name="nr_persoane" value="<?=$reservation['nr_persoane'];?>"placeholder="Enter No. Persons...">
            </div>

            <div class="form_group">
            <label for="email">Email Adress</label>
                <input type="email" id="email" name="email" value="<?=$reservation['email'];?>"placeholder="Enter Email...">
            </div>
      <button type="submit" class="btn btn-success" name="edit_res">Edit</button>
    </form>  
                        <?php
                    }
            }
            else{
                ?>
                <h4>No record found</h4>
                <?php
            }
        }
        ?>
        </div>
        <div class="card-footer text-right">
                    <small>&copy; Restaurant App</small>
        </div>
        </div>
        </div>
        </div>

        <script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
        </script>

    </body>
</html>