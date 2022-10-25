<!DOCTYPE html>
<html>
    <head>
        <title>SignUp</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
        <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
        <script src="/js/validation.js" defer></script>
    </head>
    <body>
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
        <h1>SignUp</h1>
        <form action="process-signup.php" method="post" novalidate>
            <div>
                <label for="name">Name</label>
                <input type="text" ide="name" name="name">
            </div>

            <div>
                <label for="email">email</label>
                <input type="email" id="email" name="email"> 
            </div>

            <div>
                <label for="password">password</label>
                <input type="password" id="password" name="password">
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation"
                name="password_confirmation">
            </div>
            <button>Sign Up</button>

        </form>
    </body>
</html>