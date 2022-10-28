<?php 

$mysqli = require __DIR__ . "/database.php";
require __DIR__ ."/database.php";
if(isset($_POST['deletedata']))
{
    $id = $_POST["delete_id"];

    $sql = "DELETE FROM user WHERE id = '$id' ";
    $result = $mysqli->query($sql);

    if($result)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:SQL_User_Display.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}



?>