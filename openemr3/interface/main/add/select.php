<?php


require_once("../../globals.php");

if(!isset($_POST['searchTerm'])){
    // $json = [];
 }else{
     $search = $_POST['searchTerm'];
     // $sql="SELECT id, doctor_name FROM doctor WHERE doctor_name LIKE '%".$search."%'LIMIT 10";
     $sql = "SELECT * FROM form_doctor_details WHERE fname LIKE '%".$_POST["searchTerm"]."%'";
     $result = sqlStatement($sql);
     // $json = [];
 
     // while($row =sqlFetchArray()){
     //     $json[] = ['id'=>$row['id'], 'doctor_name'=>$row['doctor_name']];
     // }
 }
 $response = array();
 while($row=sqlFetchArray($result))
 {
    $response[]=array(
                "id" => $row['id'],
                "text" => $row['fname']
             );
 }
//  foreach($result as $row){
//      $response[] = array(
//         "id" => $row['id'],
//         "text" => $row['fname']
//      );
//   }
 echo json_encode($response);
?>