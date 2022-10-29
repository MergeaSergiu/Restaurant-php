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
        <form action="process-signup.php" method="post" novalidate>
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
            <button class="btn btn-success">Sign Up</button>

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