<?php 

$mysqli = require __DIR__ . "/database_food.php";
require __DIR__ ."/database_food.php";
if(isset($_POST['delete_food']))
{
    $id = $_POST["delete_id"];
    $table_name= $_POST["Food_Type"];

    $sql = "DELETE FROM $table_name WHERE ID_Food = $id ";
    $result = $mysqli->query($sql);

    if($result)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:SQL_Food_Menu_Display.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}



?>