
<?php

require_once("../../globals.php");
$param = $_GET['query'];
$json = [];
$query = "SELECT * FROM form_doctor_details WHERE fname LIKE '%".$param."%'";
$result = sqlStatement($query); 
while($row = sqlFetchArray($result)){
    $json[] = ['id'=>$row['id'], 'fname'=>$row['fname']];
}
echo json_encode($json);
?>
