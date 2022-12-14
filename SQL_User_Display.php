<?php
session_start();

$a = 0;
if(isset($_POST['insertdata'])){

$email = $_POST["email"];
$error ="";
$a=0;

if(empty($_POST["name"])){
    $error="A user name is required";
    $a=1;
}

else if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
     $error = "Valid email is required";
     $a=1;
    }

else if(strlen($_POST["password"]) < 8) {
    $error = "Password must be at least 8 characters";
    $a=1;
}

else if( ! preg_match("/[a-z]/i", $_POST["password"])){
    $error = "Password must contain at least one letter";
    $a=1;
}

else if( ! preg_match("/[0-9]/", $_POST["password"])){
    $error = "Password must contain at least one number";
    $a=1;
}

else if( $_POST["password"] !== $_POST["password_confirmation"]) {
    $error = "Passwords do not match";
    $a =1;
}

else{
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

 $mysqli = require __DIR__ . "/database.php";
 $count = 0;
$sql2 = "SELECT * FROM user WHERE email = '$email'";

$rscheck = $mysqli->query($sql2);
$count = mysqli_num_rows($rscheck);
if($count === 0){

    $sql = "INSERT INTO user (name, email, password_hash) 
            VALUES(?,?,?)";

$stmt = $mysqli->stmt_init();

if( ! $stmt->prepare($sql)){
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                $_POST["name"],
                $_POST["email"],
                $password_hash);

if($stmt->execute()){
    header("SQL_User_Display.php");
    $error = "User-ul a fost adaugat";
    $a=2;
      $stmt->close();

} else {
    $error = "Nu s-a inregistrat contul";
    $a=1;
}

}else{
   $error = "Email already exist";
    $a=1;
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
        <title>User Data Display</title>
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
<div class="alert alert-primary" role="alert">
<?php
 echo "Welcome " . $_SESSION['user_name'];
?></div></p>
    <h1> List of Users</h1>

    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete User Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deleteData.php" method="POST">

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

<!-- Modal -->
<div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
      <div class="modal-body">

                <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Name...">
            </div>

            <div class="form-group">
                <label for="email">Email Adress</label>
                <input type="email" id="email" name="email" placeholder="Enter Email..."> 
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password...">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation"
                name="password_confirmation" placeholder="Confirm Password...">
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
                <th scope="col">ID_Cont</th>    
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Delete</th>
                <th scope="col">Edit</th>
            </tr>
    </thead>
    <?php 
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * from user";
    if($result = $mysqli->query($sql)){

  while ($row = $result->fetch_assoc()){?>
    <tbody>
    <tr>
        <td><?php echo $row["id"] ?> </td>
        <td><?php echo $row["name"] ?> </td>
        <td><?php echo $row["email"]?></td>
        <td><button type="button" class="btn btn-danger deletebtn">Delete </button> </td>
        <td><a href="EditUserPage.php?id=<?= $row["id"];?>" class="btn btn-success">Edit</td> 
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