<?php

require_once("../../globals.php");


$sql = "select * from patient_records  left join doctor_records on doctor_records.p_id=patient_records.p_id";
$res = sqlStatement($sql);
// echo $res;
?>












<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


<table class="table">
  <thead>
    <tr>
      <!-- <th scope="col">Id</th> -->
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">Address</th>
      <th scope="col">Mobile No</th>
      <th scope="col">Gender</th>
      <th scope="col">Degree</th>
      <th scope="col">University</th>
      <th scope="col">Height</th>
      <th scope="col">Weight</th>
      <th scope="col">Blood Group</th>
      <th scope="col">Father Name</th>
      <th scope="col">Mother Name</th>
      <th scope="col">Clinic Name</th>
    </tr>
  </thead>
  <tbody>
    <?php


    while ($row = sqlFetchArray($res)) {

    ?>
      <tr>

        <!-- <th><?php echo $row['p_id']; ?></th> -->

        <th><?php echo $row['name']; ?></th>
        <th><?php echo $row['age']; ?></th>
        <th><?php echo $row['address']; ?></th>
        <th><?php echo $row['mobileno']; ?></th>
        <th><?php echo $row['gender']; ?></th>
        <th><?php echo $row['degree']; ?></th>
        <th><?php echo $row['university']; ?></th>
        <th><?php echo $row['height']; ?></th>
        <th><?php echo $row['weight']; ?></th>
        <th><?php echo $row['bloodgroup']; ?></th>
        <th><?php echo $row['fathername']; ?></th>
        <th><?php echo $row['mothername']; ?></th>
        <th><?php echo $row['clinic_name']; ?></th>

      </tr> <?php }



            ?>
  </tbody>
</table>
