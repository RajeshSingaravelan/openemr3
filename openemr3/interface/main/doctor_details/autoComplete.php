
<?php

require_once("../../globals.php");
// $param = $_GET['query'];
// $param = $_GET['query'];
if(isset($_GET["term"]))
 {
    // $output = '';
    $query = "SELECT * FROM form_doctor_details WHERE fname LIKE '%".$_GET["term"]."%'";
    $result = sqlStatement($query);
    // $output = '<ul class=list-unstyled>';
     $output = array();
         while($row = sqlFetchArray($result))
         {
            //   $doctor_name  .=$row["doctor_name"];
            //   array_push($output, $doctor_name);
           // $output .= '<li>'.$row["doctor_name"];
           $temp_array = array();
           $temp_array['value'] = $row['fname'];
           $output[] = $temp_array;
         }

         echo json_encode($output);
        // $output .= '</ul>';
  }
      ?>