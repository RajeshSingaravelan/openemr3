<?php

require_once("../globals.php");
if(isset($_POST["hidden_status"]))
{
    $status=$_POST['hidden_status'];



$sql = "INSERT INTO facility(status) VALUES ('".$status."')";

$result=sqlStatement($sql);
echo $result;
}
?>