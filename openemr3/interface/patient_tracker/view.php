
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
</html>
<?php 
require_once "../globals.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
$sql="SELECT * FROM form_doctor_details WHERE id=$id";
$result=sqlStatement($sql);
// echo $result;
$res=sqlFetchArray($result);
// echo $res['fname'];
}
?>

<table class="table">
  <thead>
    <tr>
    <th scope="col">#</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Speciality</th>
      <th scope="col">Clinic Name</th>
      <!-- <th scope="col">Action</th> -->
    </tr>
  </thead>
  <tbody>
  <?php
                
               
             
                     ?>
                <tr>
                  <th scope="row"><?php echo $res['id']; ?></th>
                  <td><?php echo $res['fname']; ?></td>
                  <td><?php echo $res['lname']; ?></td>
                  <td><?php echo $res['speciality']; ?></td>
                  <td><?php echo $res['clinic_name']; ?></td>
                 
                </tr>
                 
  </tbody>
</table>