<?php

use Zend\Http\Header\Location;

require_once("../../globals.php");


$id = $_POST['id'];
$sql="DELETE FROM form_doctor_details WHERE id=$id";
 $result=sqlStatement($sql);
 


?>
