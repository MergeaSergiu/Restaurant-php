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
<?php
use LDAP\Result;
 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?></p>
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
      <form action="Add_Food_Admin.php" method="post" >
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
        <table class="table table-striped table-dark">
            <thead>
                <tr> 
        <th scope="col">ID_Food.</th>
        <th scope="col">Food</th>
        <th scope="col">Price</th>
        <th scope="col">Delete</th>
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
    </tr>
        <?php
  }
  $result->free();
}
?> 
            </tbody>
            <br>
        </table>

        <table class="table table-striped table-dark">
            <thead>
                <tr> 
        <th scope="col">ID_Food</th>
        <th scope="col">Food</th>
        <th scope="col">Price</th>
        <th scope="col">Delete</th>
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
    </body>
</html>