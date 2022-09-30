<?php


require_once("../../globals.php");




if(isset($_POST["From"], $_POST["to"])) {

   
  

    // echo $_POST["From"];
    // echo $_POST["to"];
    $reportData = ""; 
    $query = "SELECT * FROM form_doctor_details WHERE date BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'";
    $result = sqlStatement($query);
    // echo $result;
   

    $reportData .='
    <table class="table table-bordered">
    <tr>
    <th width="1%">First Name</th>
    <th width="1%">Last Name</th>
    <th width="1%">Speciality</th>
    <th width="1%">Clinic Name</th>
    <th width="1%">Date</th>
    <th width="1%">Image</th>
    </tr>';
   
    while($row = sqlFetchArray($result))
    {
        $imgURL ='../doctor_details/uploads/' . $row['image'];
      
      
       
        $reportData .='
        <tr>
            <td>'.$row["fname"].'</td>
            <td>'.$row["lname"].'</td>
            <td>'.$row["speciality"].'</td>
            <td>'.$row["clinic_name"].'</td>
            <td>'.$row["date"].'</td>
            <td><img src="' . $imgURL . '"  width="50px">'.'</td>
            </tr>';
          
    }
    $reportData .= '</table>';
    echo $reportData;

}
 
?>

