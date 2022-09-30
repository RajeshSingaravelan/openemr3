<?php 
 
 require_once("../../globals.php");
//  use PHPMailer\PHPMailer\PHPMailer;
//  use PHPMailer\PHPMailer\Exception;

// Fetch records from database 
$query = "SELECT * FROM form_doctor_details"; 
$result=sqlStatement($query);

// echo $res['fname'];
// if(sqlFetchArray($query)){ 
    $delimiter = ","; 
    $filename = "doctor_details_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('ID', 'FIRST NAME', 'LAST NAME', 'Speciality', 'Clinic Name'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while ($row = sqlFetchArray($result)){ 
        // $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['id'], $row['fname'], $row['lname'], $row['speciality'], $row['clinic_name']); 
       
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 


   
// } 


exit; 



 
?>