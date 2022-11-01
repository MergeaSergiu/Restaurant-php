<?php
session_start();
$error = "";
$a=0;

if(isset($_POST['login'])){
    $a =0;
    $email = $_POST['email'];
    $password = $_POST['password'];

if(empty($email)){
    $error = "A valid email is required"; 
    $a=1;

}
else if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $error = "A valid email is required"; 
    $a=1;
}

else if(strlen($_POST["password"]) < 8) {
    $error = "Password must be at least 8 characters";
    $a=1;
}
else {

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE email = '{$_POST["email"]}'" ;

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user){
        if(password_verify($_POST["password"], $user["password_hash"]) && $user["email"] === "adminsergiu@gmail.com"){
            
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            header("Location: AdminPage.php");
        }

        else if(password_verify($_POST["password"], $user["password_hash"]) &&  $user["email"] !== "adminsergiu@gmail.com") {
            
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            header("Location: Rezervari_page.php");
        }
        else if( !password_verify($_POST["password"], $user["password_hash"])){
            $error = "User-ul nu exista in baza de date";
            $a =1;
        }
    }
    else{

        $error = "This user doesn't exist";
        $a =1;
    }
}
if($a === 1) {?>
    <div class="alert">
      <span class="closebtn">&times;</span>  
      <strong><?php echo $error; ?></strong>
    </div>
    <?php
 } 
}
?>
<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <link rel="stylesheet" href="./css/style.css">
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
            <div class=" row justify-content-center" >
                <div class ="card w-70">
                    <div class="card-header text-center">
                    <h1> Login Form <h1>
                </div>
            <div class="card-body">
        <form action="" method= "post">
            <div class="form-group">
                <label for="email">Email Adress</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
        <button class="btn btn-success" name="login">Login</button>
    </form>
        </div>
                <div class="card-footer text-right">
                    <small>&copy; Restaurant App</small>
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
