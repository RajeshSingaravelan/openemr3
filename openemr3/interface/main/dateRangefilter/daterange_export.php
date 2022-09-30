<?php


require_once("../../globals.php");




if(isset($_POST["From"], $_POST["to"])) {
    $delimiter = ","; 
    $file_name = 'Report Data.csv';
  

  $file = fopen('php://output', 'w');

  $header = array('ID', ' NAME', 'NAME LIST','FIRST NAME', 'DATE');

  fputcsv($file, $header,$delimiter);

   
    $query = "SELECT * FROM form_sample WHERE date BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'";
    $result = sqlStatement($query);
   
   
    while($row = sqlFetchArray($result))
    {
        // $imgURL ='../doctor_details/uploads/' . $row['image'];
      
        $data = array($row['id'], $row['name'], $row['fname'], $row['firstname'], $row['date'],);
       
        
            fputcsv($file, $data,$delimiter);
    }
  
    }
   
    fseek($file, 0); 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $file_name . '";'); 
     
    fpassthru($file); 
    exit; 









 
?>

