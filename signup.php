<?php


$a=0;
if(isset($_POST["signup_button"])){
    $a=0;

$email = $_POST["email"];
$error = "";

if(empty($_POST["name"])){
    $error = "Invalid Name";
    $a=1;
}

else if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
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
    $a=1;
}
else{

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

 $mysqli = require __DIR__ . "/database.php";

 require __DIR__ ."/database.php";
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
        session_start();
      header("Location:login.php");
      $stmt->close();
} else {
    $error =  "Nu s-a inregistrat contul";
    $a=1;
}

}else{
    $error = "Email already exist";
    $a=1;
}

}

if($a===1) { ?>
<div class="alert">
  <span class="closebtn">&times;</span>  
  <strong>Danger!</strong> <?php echo $error; $a=0;?>
</div>
<?php
}

}?>

<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SignUp</title>
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
                <?php include('Navbar.php'); ?>
            </div>  
            </div>
        </div>

        <div class="container vh-100">
            <div class = "row justify-content-center">
                <div class ="card w-70">
                    <div class="card-header text-center">
                <h2>Sign Up</h2>
                    </div>
                <div class="card-body">
        <form action="" method="post" novalidate>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" ide="name" name="name">
            </div>

            <div class="form-group">
                <label for="email">Email Adress</label>
                <input type="email" id="email" name="email"> 
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation"
                name="password_confirmation">
            </div>

            <button class="btn btn-success" name="signup_button">Sign Up</button>
        </form>
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