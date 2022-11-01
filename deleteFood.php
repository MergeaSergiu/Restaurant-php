<?php 

$mysqli = require __DIR__ . "/database_food.php";
if(isset($_POST['delete_food']))
{
    $id = $_POST["delete_id"];
    $table_name= $_POST["Food_Type"];
    if($table_name === 'desert' || $table_name === 'bauturi' || $table_name == 'pizza' || $table_name == 'fripturi'){
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
        header("Location:SQL_Food_Menu_Display.php");
    }
}else {
   header("Location: SQL_Food_Menu_Display.php");
}

}


?>