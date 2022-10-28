<?php 

$mysqli = require __DIR__ . "/res-lib.php";
require __DIR__ ."/res-lib.php";
if(isset($_POST['deletedata']))
{
    $id = $_POST["delete_id"];

    $sql = "DELETE FROM res_rezervari WHERE res_id = '$id' ";
    $result = $mysqli->query($sql);

    if($result)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:SQL_Reservation_Display.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}



?>