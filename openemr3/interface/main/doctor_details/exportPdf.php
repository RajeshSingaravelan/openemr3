<?php 
 
 require_once("../../globals.php");


$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$html='<table border="1">
<tr>
<td width="20" height="30">cell 1</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
</tr>
<tr>
<td width="20" height="30">cell 3</td><td width="200" height="30">cell 4</td>
</tr>
</table>';
// $pdf->Cell($html);
// $pdf->Ln();
// $pdf->Ln();
// $pdf->SetFont('times','B',10);
// $pdf->Cell(25,7,"ID",1);
// $pdf->Cell(30,7,"First Name",1);
// $pdf->Cell(40,7,"Last Name",1);
// $pdf->Cell(30,7,"Speciality",1);
// $pdf->Cell(30,7,"Clinic Name",1);
// $pdf->Ln();
// $pdf->Cell(450,7,"----------------------------------------------------------------------------------------------------------------------------------------------------------------------");
// $pdf->Ln();

       
        $sql = "select * from form_doctor_details";
        $result = sqlStatement($sql);
    
        while($row = sqlFetchArray($result))
        {
            
           
            
            $pdf->Cell(25,7,$row['id'],1);
            $pdf->Cell(30,7,$row['fname'],1);
            $pdf->Cell(40,7,$row['lname'],1);
            $pdf->Cell(30,7,$row['speciality'],1);
            $pdf->Cell(30,7, $row['clinic_name'],1);
            $pdf->Ln(); 
            
        }
        

        $pdf->Output(); 



?>