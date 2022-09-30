
<?php

require_once("../../globals.php");


$image_temp=$_FILES['image']['name'];
print_r($image_temp);
$targetDir = "./uploads/";
$targetFilePath = $targetDir . $_FILES["image"]["name"];

// move_uploaded_file($image_temp, "./uploads/ ". $_FILES["image"]["name"]);
if (move_uploaded_file($_FILES['image']['tmp_name'] , $targetFilePath)) {
          echo "  Image uploaded successfully!";
      } else {
          echo " Failed to upload image!";
      }
$fname = $_POST['fname'];

$lname = $_POST['lname'];

$speciality = $_POST['speciality'];

$clinic_name = $_POST['clinic_name'];
$date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['date'])));
$image = $_FILES["image"]["name"];

$sql = "INSERT INTO form_doctor_details (fname,lname,speciality,clinic_name,date,image) VALUES ('$fname','$lname','$speciality', '$clinic_name','$date','$image')";

$result = sqlStatement($sql);



if ($result == TRUE) {

  echo "New record created successfully.";
} else {

  echo "Error:";
}




?>