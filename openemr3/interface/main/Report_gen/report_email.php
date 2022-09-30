<?php 
require_once("../../globals.php");

include "class.phpmailer.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$filename = "Report_gen.csv";
// $mail = new PHPMailer;
function create_cvs_from_db($sql)
{
    if(isset($_POST["From"], $_POST["to"])) {
        // echo $_POST["From"];
$csv = fopen('php://temp/maxmemory:' . (5 * 1024 * 1024), 'r+');

    // add the headers
    fputcsv($csv,  array('ID', 'FIRST NAME', 'LAST NAME', 'Speciality', 'Clinic Name','Date'));
    // the loop
    $sql="SELECT * FROM form_doctor_details WHERE date BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'";
 $res=sqlStatement($sql);
 
    while ($row = sqlFetchArray($res)) {
        $id = $row['id'];
        $fname = $row['fname'];
        $lname=$row['lname'];
        $speciality= $row['speciality'];
        $clinic_name=$row['clinic_name'];
        $date=$row['date'];
        // creates a valid csv string
        fputcsv($csv, array($id, $fname,$lname,$speciality,$clinic_name,$date));

    }

    rewind($csv);
    // return the the written data
    return stream_get_contents($csv);
}
  }
$mail = new PHPMailer;

$mail->SMTPDebug = true;
$mail->SMTPAuth = true;
$mail->CharSet = 'utf-8';
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '465';
$mail->Username = 'rajesh.s@zeoner.com';
$mail->Password = 'Rajesh@92!';
$mail->Mailer = 'smtp';
$mail->From = 'rajesh.s@zeoner.com';
$mail->FromName = 'Rajesh S';
$mail->Sender = 'rajesh.s@zeoner.com';
$mail->Priority = 3;

//To us
$mail->AddAddress('rajesh.s@zeoner.com');
//To Applicant
// $mail->AddAddress($email, $first_name.''.$last_name);
$mail->IsHTML(true);

// $last_4_digits = substr($card_num, -4);
//build email contents

$mail->Subject = 'Application From ';
$my_path ="../../report_email/report_gen.csv";

$mail->addStringAttachment(create_cvs_from_db($sql),$filename);

// $sql="select * from form_doctor_details";
// $res=sqlStatement($sql);


// $body = "<html>
//         <head>
//         <title></title>
//          <style>
//     table {
//     border-collapse: collapse;
//     width: 100%;
// }

// th, td {
//   border: 1px solid #ddd;
//     text-align: left;
//     padding: 8px;
//     color:black
// }

// tr:nth-child(even){background-color: #f2f2f2}

// th {
//     background-color: #4CAF50;
//     color: white;
// }
// </style>
// </head>
// <body>
  
 
//        <table>
//       <thead>
//         <tr>
//           <th>id</th>
//           <th>First Name</th>
//           <th>Last Name</th>
//           <th>Speciality</th>
//           <th>Clinic Name</th>
          
//         </tr>
//       </thead>
//       <tbody>";

       
//         while ($row = sqlFetchArray($res)) {

     
//           $body.= "<tr> 
//       <td>".$row['id']."</td>
//       <td>".$row['fname']."</td>
//       <td>".$row['lname']."</td>
//       <td>".$row['speciality']."</td>
//       <td>".$row['clinic_name']."</td>
    
//       </tr>";  

            
//          }
    
//         $body.="</tbody></table></body></html>";

//         // $body.='Content-Disposition: attachment; filename="' . $my_path . '";';
$mail->Body="hai";

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

?>