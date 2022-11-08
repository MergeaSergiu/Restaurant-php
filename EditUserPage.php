<?php
session_start();
$a=0;
$error = "";
if(isset($_POST['edit_button'])){
    $mysqli = require __DIR__ . "/database.php";
    $a=0;
    $user_id = $_POST['user_id'];
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_pass = $_POST['password'];
if(empty($_POST['name'])){
        $error = "Invalid Name";
        $a=1;
}
else if ( ! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $error = "Valid email is required";
        $a=1;
    }
else if(strlen($_POST['password']) < 8) {
         $error = "Password must be at least 8 characters";
         $a=1;
    }
else if( ! preg_match("/[a-z]/i", $user_pass)){
        $error = "Password must contain at least one letter";
        $a=1;
    }
 else if( ! preg_match("/[0-9]/", $user_pass)){
        $error = "Password must contain at least one number";
        $a=1;
    }
else{
    $password_hash = password_hash($user_pass, PASSWORD_DEFAULT);

    $query = "UPDATE user SET name='$user_name', email= '$user_email', password_hash ='$password_hash'
        WHERE id='$user_id'";
    
    $query_run = $mysqli->query($query);

    if($query_run){
        header("Location:SQL_User_Display.php");
        exit(0);
    }
    }
}

if($a===1) { ?>
    <div class="alert">
      <span class="closebtn">&times;</span>  
      <strong><?php echo $error; $a=0;?> </strong>
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
                <h2>Edit User</h2>
                    </div>
                <div class="card-body">
        <?php
        if(isset($_GET['id']))
        {   
            $mysqli = require __DIR__ . "/database.php";
            $user_id = $_GET['id'];
            $users = "SELECT * FROM user where id='$user_id'";
            $user_run = $mysqli->query($users);

            if(mysqli_num_rows($user_run) > 0)
            {
                    foreach($user_run as $user){
                        ?>
            <form action="" method="POST">
                <input type="hidden" name="user_id" value="<?=$user['id'];?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?=$user['name'];?>">
            </div>

            <div class="form-group">
                <label for="email">Email Adress</label>
                <input type="email" id="email" name="email" value="<?=$user['email'];?>"> 
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <button type="submit" class="btn btn-success" name="edit_button">Edit</button>           
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