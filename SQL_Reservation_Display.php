<?php
include('top.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reservation Data Display</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    </head>
    <body>
    <div class= "container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php include('NavbarResData.php'); ?>
        </div>  
    </div>
</div>
<p><strong>
<?php
use LDAP\Result;
 session_start();
 echo "Welcome " . $_SESSION['user_name'];
?></p>
        <h1>List of Reservation</h1>

<!-- DELETE POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Restaurant Reservation </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deleteReservation.php" method="POST">

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


<div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="Rezervari_admin.php" method="post">
        <div class="modal-body">
           <div class="form-group">
            
           <label for="res_date">Data</label>
                <input type="date" id="res_date" name="res_date" placeholder="Enter Date...">
            </div>

            <div class="form-group">
            <label for="res_ora">Ora Rezervare</label>
                <input type="time" id="res_ora" name="res_ora" placeholder="Enter a Hour..."> 
            </div>

            <div class="form-group">
            <label for="nr_persoane">Numar Persoane</label>
                <input type="number" id="nr_persoane" name="nr_persoane" placeholder="Enter No. Persons...">
            </div>

            <div class="form-group">
            <label for="feluri_mancare">Meniul dorit</label>
                <input type="text" id="feluri_mancare" name="feluri_mancare" placeholder="Enter Food...">
            </div>

            <div class="form_group">
            <label for="feluri_mancare">Meniul dorit</label>
                <input type="email" id="email" name="email" placeholder="Enter Email...">
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
                  
        <th scope="col">ID Res.</th>
        <th scope="col">Res. Date</th>
				<th scope="col">Start Hour</th>
				<th scope="col">Nr.Persoane</th>
				<th scope="col">Feluri Mancare</th>
				<th scope="col">Email</th>
        <th scope="col">Delete</th>
                </tr>
            </thead>
<?php 
  $mysqli = require __DIR__ . "/res-lib.php";
  $sql = "SELECT * from res_rezervari";
  if($result = $mysqli->query($sql)){ 
  while ($row = $result->fetch_assoc()){ 
    ?>
    <tbody>
   <tr>
        <td><?php echo $row["res_id"]; ?> </td>
        <td><?php echo $row["res_date"] ?> </td>
        <td><?php echo $row["res_ora"] ?> </td>
        <td><?php echo $row["nr_persoane"] ?> </td>
        <td><?php echo $row["feluri_mancare"] ?> </td>
        <td><?php echo $row["email"]?></td>
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