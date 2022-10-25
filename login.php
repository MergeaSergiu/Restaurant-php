<?php
$is_invalid = false;
$gasit =false;

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM user 
                    WHERE email = 'adminsergiu@gmail.com' ",
                    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user){
        if(password_verify($_POST["password"], $user["password_hash"])){
            
            session_start();

            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            $gasit = true;
            header("Location: AdminPage.php");
            exit;
        }

    $is_invalid = true;
 
if($gasit == false){
    $is_invalid = false;

    $sql = sprintf("SELECT * FROM user 
                    WHERE email = '%s' ",
                    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user){
        if(password_verify($_POST["password"], $user["password_hash"])){
            
            session_start();

            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];

            header("Location: Rezervari_page.php");
            exit;
        }
    }
    $is_invalid = true;
    }
    }
}

?>

<?php
include('top.php');
?>
    <div class= "container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <?php include('Navbar.php'); ?>
            </div>  
            </div>
        </div>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
        <div class="container">
            <div class=" row justify-content-cneter" >
                <div class ="card w-70">
                        <div class="card-header text-center">
                        <h1>Login Form</h1>
        <?php if($is_invalid): ?>
            <em>Invalid login </em>
        <?php endif; ?>   
                    </div>
                <div class="card-body">
        <form method="post">
            <div class="form-group">
        <label for="email">Email Adress</label>
        <input type="email" name="email" id="email"
            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            </div>
            <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        </div>
        <button class="btn btn-success">Login</button>

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