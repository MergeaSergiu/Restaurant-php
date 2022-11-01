<?php 

$mysqli = require __DIR__ . "/res-lib.php";
require __DIR__ ."/res-lib.php";
if(isset($_POST['res_delete']))
{
    $res_id = $_POST['res_delete'];

    $sql = "DELETE FROM res_rezervari WHERE res_id = '$res_id' ";
    $result = $mysqli->query($sql);

    if($result)
    {
        header("Location:UserProfile.php");
    }
    else
    {
        die("Nu s-a anulat rezervarea");
        
    }
}



?>