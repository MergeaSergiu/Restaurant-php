<?php
session_start();
$a=0;
$error = "";
if(isset($_POST['insertdata'])){

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

$mysqli = require __DIR__ . "/database.php";

$count = 0;
$sql2 = "SELECT * FROM user WHERE email = '$email'";

$rscheck = $mysqli->query($sql2);
$count = mysqli_num_rows($rscheck);
if($count === 1){        
    $mysqli2 = require __DIR__ . "/res-lib.php";
    
    $sql = "INSERT INTO res_rezervari (res_date,res_ora,nr_persoane,email) 
               VALUES(?,?,?,?)";

    $stmt = $mysqli2->stmt_init();
    
    if( ! $stmt->prepare($sql)){
       die("SQL error: " . $mysqli2->error);
    }
    
    $stmt->bind_param("ssss",
                   $_POST["res_date"],
                   $_POST["res_ora"],
                   $_POST["nr_persoane"],
                   $_POST["email"]);
    
    if($stmt->execute()){
     header("SQL_Reservation_Display.php");
     $error = "Rezervarea a fost efectuata cu succes";
     $a=2;
      $stmt->close();
    }
    else {
        $error = "Nu s-a inregistrat contul";
        $a=1;
    }
}else{
    $error = "Nu exista acest user";
    $a =1;
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
else if($a == 2) {?>
    <div class="alert2">
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
        <title>Reservation Data Display</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
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

.alert2 {
  padding: 20px;
  background-color: #04AA6D;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}

.alert2.success {background-color: #04AA6D;}
.alert2.info {background-color: #2196F3;}
.alert2.warning {background-color: #ff9800;}

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

    <body>
    <div class= "container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php include('NavbarResData.php'); ?>
        </div>  
    </div>
</div>
<p><strong>
<div class="alert alert-primary" role="alert">
<?php
use LDAP\Result;
 echo "Welcome " . $_SESSION['user_name'];
?></div></p>
        <h1>List of Reservation</h1>

<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Restaurant Reservation </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deleteReservation.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<!-- ADD POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" >
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

            <div class="form_group">
            <label for="email">Email Adress</label>
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
  Add Reservation
</button>

        <br>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                  
        <th scope="col">ID Res.</th>
        <th scope="col">Res. Date</th>
				<th scope="col">Start Hour</th>
				<th scope="col">Nr.Persoane</th>
				<th scope="col">Email</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
                </tr>
            </thead>
<?php 
  $mysqli = require __DIR__ . "/res-lib.php";
  $sql = "SELECT * from res_rezervari";
  if($result = $mysqli->query($sql)){ 
  while ($row = $result->fetch_assoc()){ 
    ?>
    <tbody>
   <tr>
        <td><?php echo $row["res_id"]; ?> </td>
        <td><?php echo $row["res_date"] ?> </td>
        <td><?php echo $row["res_ora"] ?> </td>
        <td><?php echo $row["nr_persoane"] ?> </td>
        <td><?php echo $row["email"]?></td>
        <td><button type="button" class="btn btn-danger deletebtn">Delete </button> </td>
        <td><a href="EditResPage.php?res_id=<?=$row["res_id"];?>" class="btn btn-success">Edit</td> 
    </tr>
        <?php
  }
  $result->free();
}
?> 
            </tbody>
        </table>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>

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