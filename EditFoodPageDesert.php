<?php 
session_start();
$a=0;
$error = "";
if(isset($_POST['edit_desert'])){

    if(empty($food_name)){
        $error="A valid name is required";
        $a=1;
    }
    else if(empty($food_price)){
            $error="This field can't be empty";
    }

    else{
        
    $food_id = $_POST['food_id'];
    $mysqli = require __DIR__ . "/database_food.php";
    $query = "UPDATE desert SET  Name_Food='{$_POST["Name_Food"]}', Price='{$_POST["Price"]}'
        WHERE ID_Food='$food_id'";
    
    $query_run = $mysqli->query($query);

    if($query_run){
        header("Location:SQL_Food_Menu_Display.php");
        exit(0);
    }
    else{
        $a=1;
        $error = "Ceva nu a mers bine";
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
        <title>Edit Dish</title>
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
        <div class="container vh-100">
            <div class = "row justify-content-center">
                <div class ="card w-70">
                    <div class="card-header text-center">
                <h2>Edit Dish</h2>
                    </div>
                <div class="card-body">
        <?php
        if(isset($_GET['food_id']))
        {   
            $mysqli = require __DIR__ . "/database_food.php";
            $food_id = $_GET['food_id'];
            $menu = "SELECT * FROM desert WHERE ID_Food='$food_id'";
            $dishes = $mysqli->query($menu);

            if(mysqli_num_rows($dishes) > 0)
            {
                    foreach($dishes as $dish){
                        ?>
                  <form action="" method="POST" >
        
        <input type="hidden" name="food_id" value="<?=$dish['ID_Food'];?>">
           <div class="form-group">
           <label for="text">Food</label>
                <input type="text" id="Name_Food" name="Name_Food" value="<?=$dish['Name_Food'];?>" placeholder="Enter Food...">
            </div>

            <div class="form-group">
            <label for="text">Price</label>
                <input type="text" id="Price" name="Price" value="<?=$dish['Price'];?>" placeholder="Enter Price..."> 
            </div>

      <button type="submit" class="btn btn-success" name="edit_desert">Edit</button>
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