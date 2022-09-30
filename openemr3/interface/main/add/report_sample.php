<?php


require_once("../../globals.php");




if(isset($_POST["From"], $_POST["to"])) {
    // echo $_POST["From"];
    // echo $_POST["to"];
    $reportData = ""; 
    $query = "SELECT * FROM form_sample WHERE date BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'";
    $result = sqlStatement($query);
    // echo $result;
   

    $reportData .='
    <table class="table table-bordered">
    <tr>
    <th width="1%">Name</th>
    <th width="1%">Name List</th>
    <th width="1%">First Name</th>
    <th width="1%">Date</th>
   
    </tr>';
   
    while($row = sqlFetchArray($result))
    {
        // $imgURL ='../doctor_details/uploads/' . $row['image'];
      
       
       
        $reportData .='
        <tr>
            <td>'.$row["name"].'</td>
            <td>'.$row["fname"].'</td>
            <td>'.$row["firstname"].'</td>
            <td>'.$row["date"].'</td>
           
            </tr>';

    }
    }
    $reportData .= '</table>';
    echo $reportData;


 
?>

