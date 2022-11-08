<?php
session_start();
$a = 0;
$error = "";

if(isset($_POST['insertfood'])){

$table_name= $_POST["Food_Type"];
$food_name= $_POST["Name_Food"];

    if(empty($food_name)){
        $error="A user name is required";
        $a=1;
    }
    else{

    $mysqli = require __DIR__ . "/database_food.php";
    
    $count = 0;
    if($table_name === 'desert' || $table_name === 'bauturi' || $table_name === 'pizza' || $table_name === 'fripturi'){
    $sql2 = "SELECT * FROM $table_name WHERE Name_Food = '$food_name' ";
    
    $rscheck = $mysqli->query($sql2);
    $count = mysqli_num_rows($rscheck);
    if($count === 0){        
        
        $sql = "INSERT INTO $table_name (Name_Food,Price) 
                   VALUES(?,?)";
    
        $stmt = $mysqli->stmt_init();
        
        if( !$stmt->prepare($sql)){
           die("SQL error: " . $mysqli->error);
        }
        
        $stmt->bind_param("ss",
                       $_POST["Name_Food"],
                       $_POST["Price"]
    );
        
        if($stmt->execute()){
         header("SQL_Food_Menu_Display.php");
         $a = 2;
         $error = "Un fel de mancare adaugat cu succes";
          $stmt->close();
        }
        else {
            $error=  "Nu s-a inregistrat mancarea";
            $a = 1;
        }
    }else{
        $error = "Felul de mancare exista deja";
        $a = 1;
    }
}else {
    $error = "Nu exista categoria aceasta";
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
else if($a === 2) {?>
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
        <title>Food Menu</title>
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
    <body>
    <div class= "container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php include('NavbarFoodMenuAdmin.php'); ?>
        </div>  
    </div>
</div>
<p><strong>
<div class="alert alert-primary" role="alert">
<?php
use LDAP\Result;
 echo "Welcome " . $_SESSION['user_name'];
?></div></p>
        <h1>Food Menu</h1>

<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Food </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deleteFood.php" method="POST"> 
                    
                <div class="form-group">
                    <label for="text">Food Type</label>
                <input type="text" id="Food_Type" name="Food_Type" placeholder="Enter Food Type..">

            </div>
                <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="delete_food" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<!-- ADD POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="AddFood" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
           <label for="text">Food Type</label>
                <input type="text" id="Food_Type" name="Food_Type" placeholder="Enter Food Type..">
            </div>
           <div class="form-group">
           <label for="text">Food</label>
                <input type="text" id="Name_Food" name="Name_Food" placeholder="Enter Food...">
            </div>

            <div class="form-group">
            <label for="text">Price</label>
                <input type="text" id="Price" name="Price" placeholder="Enter Price..."> 
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="insertfood" class="btn btn-primary">Save Data</button>
      </div>    
    </form>  
    </div>
    </div>
  </div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddFood">
  Add Food
</button>
        <br>
        <h1> Pizza </h1>
        <table class="table table-striped table-dark">
            <thead>
                <tr> 
        <th scope="col">ID_Food.</th>
        <th scope="col">Food</th>
        <th scope="col">Price</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
                </tr>
            </thead>
<?php 
  $mysqli = require __DIR__ . "/database_food.php";
  $sql = "SELECT * from pizza";
  if($result = $mysqli->query($sql)){ 
  while ($row = $result->fetch_assoc()){ 
    ?>
    <tbody>
   <tr>
        <td><?php echo $row["ID_Food"]; ?> </td>
        <td><?php echo $row["Name_Food"] ?> </td>
        <td><?php echo $row["Price"] ?> </td>
        <td><button type="button" class="btn btn-danger deletebtn">Delete </button> </td>
        <td><a href="EditFoodPagePizza.php?food_id=<?=$row["ID_Food"];?>" class="btn btn-success">Edit</td>
    </tr>
        <?php
  }
  $result->free();
}
?> 
            </tbody>
        </table>
        <h2> Desert </h2>
        <table class="table table-striped table-dark">
            <thead>
                <tr> 
        <th scope="col">ID_Food</th>
        <th scope="col">Food</th>
        <th scope="col">Price</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
                </tr>
            </thead>
<?php 
  $mysqli = require __DIR__ . "/database_food.php";
  $sql = "SELECT * from desert";
  if($result = $mysqli->query($sql)){ 
  while ($row = $result->fetch_assoc()){ 
    ?>
    <tbody>
   <tr>
        <td><?php echo $row["ID_Food"]; ?> </td>
        <td><?php echo $row["Name_Food"] ?> </td>
        <td><?php echo $row["Price"] ?> </td>
        <td><button type="button" class="btn btn-danger deletebtn">Delete </button> </td>
        <td><a href="EditFoodPageDesert.php?food_id=<?=$row["ID_Food"];?>" class="btn btn-success">Edit</td>
    </tr>
        <?php
  }
  $result->free();
}
?> 
            </tbody>
        </table>
        <h3> Bauturi </h3> 
        <table class="table table-striped table-dark">
            <thead>
                <tr> 
        <th scope="col">ID_Food</th>
        <th scope="col">Food</th>
        <th scope="col">Price</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
                </tr>
            </thead>
<?php 
  $mysqli = require __DIR__ . "/database_food.php";
  $sql = "SELECT * from bauturi";
  if($result = $mysqli->query($sql)){ 
  while ($row = $result->fetch_assoc()){ 
    ?>
    <tbody>
   <tr>
        <td><?php echo $row["ID_Food"]; ?> </td>
        <td><?php echo $row["Name_Food"] ?> </td>
        <td><?php echo $row["Price"] ?> </td>
        <td><button type="button" class="btn btn-danger deletebtn">Delete </button> </td>
        <td><a href="EditFoodPageBauturi.php?food_id=<?=$row["ID_Food"];?>" class="btn btn-success">Edit</td>
    </tr>
        <?php
  }
  $result->free();
}
?> 
            </tbody>
        </table>
        <h1> Fripturi </h1>

        <table class="table table-striped table-dark">
            <thead>
                <tr> 
        <th scope="col">ID_Food</th>
        <th scope="col">Food</th>
        <th scope="col">Price</th>
        <th scope="col">Delete</th>
        <th scope="col">Edit</th>
                </tr>
            </thead>
<?php 
  $mysqli = require __DIR__ . "/database_food.php";
  $sql = "SELECT * from fripturi";
  if($result = $mysqli->query($sql)){ 
  while ($row = $result->fetch_assoc()){ 
    ?>
    <tbody>
   <tr>
        <td><?php echo $row["ID_Food"]; ?> </td>
        <td><?php echo $row["Name_Food"] ?> </td>
        <td><?php echo $row["Price"] ?> </td>
        <td><button type="button" class="btn btn-danger deletebtn">Delete </button> </td>
        <td><a href="EditFoodPageFripturi.php?food_id=<?=$row["ID_Food"];?>" class="btn btn-success">Edit</td>
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