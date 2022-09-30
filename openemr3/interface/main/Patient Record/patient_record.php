<?php


require_once("../../globals.php");



if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $age = $_POST['age'];
  $address = $_POST['address'];
  $mobileno = $_POST['mobileno'];
  $gender = $_POST['gender'];
  $degree = $_POST['degree'];
  $university = $_POST['university'];
  $height = $_POST['height'];
  $weight = $_POST['weight'];
  $bloodgroup = $_POST['bloodgroup'];
  $fathername = $_POST['fathername'];
  $mothername = $_POST['mothername'];
  $sql = "INSERT INTO patient_records (name,age,address,mobileno,gender,degree,university,height,weight,bloodgroup,fathername,mothername) VALUES ('$name', '$age','$address',' $mobileno', '$gender',' $degree ',' $university','$height', '$weight','$bloodgroup', '$fathername','$mothername')";
  $result = sqlStatement($sql);
  if ($result == TRUE) {

    echo "New record created successfully.";
  } else {

    echo "Error:";
  }
}

$sql = "select * from patient_records";
$res = sqlStatement($sql);



if (isset($_POST['importSubmit'])) {
  $fileMimes = array(
    'text/x-comma-separated-values',
    'text/comma-separated-values',
    'application/octet-stream',
    'application/vnd.ms-excel',
    'application/x-csv',
    'text/x-csv',
    'text/csv',
    'application/csv',
    'application/excel',
    'application/vnd.msexcel',
    'text/plain'
  );

  $csv_file = $_FILES['csv']['tmp_name'];
  print_r($csv_file);

  if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes)) {


    $csvFile = fopen($_FILES['file']['tmp_name'], 'r');



    fgetcsv($csvFile);

    
    while (($getData = fgetcsv($csvFile, 1000, ",")) !== FALSE) {
      echo $getData[0];
      $un_id=$getData[0];
      $name = $getData[1];
      $age = $getData[2];
      $address = $getData[3];
      $mobileno = $getData[4];
      $gender = $getData[5];
      $degree = $getData[6];
      $university = $getData[7];
      $height = $getData[8];
      $weight = $getData[9];
      $bloodgroup = $getData[10];
      $fathername = $getData[11];
      $mothername = $getData[12];

      $prevQuery = "SELECT p_id FROM patient_records WHERE un_id = '".$getData[0]."'";
      $prevResult = sqlStatement($prevQuery);
     
  // print_r( $prevResult['un_id'] );
  
      if($prevResult->rowCount()>0){
        
        sqlStatement("UPDATE patient_records SET name = '".$name."', age = '".$age."', address = '".$address."',gender = '".$gender."',degree = '".$degree."', university = '".$university."',height = '".$height."',weight = '".$weight."',bloodgroup = '".$bloodgroup."',fathername = '".$fathername."',mothername = '".$mothername."' WHERE mobileno = '".$mobileno."'");
    }
    
    else{
   
      $sql = "INSERT INTO patient_records (un_id,name,age,address,mobileno,gender,degree,university,height,weight,bloodgroup,fathername,mothername) 
      VALUES ('$un_id','$name', '$age','$address',' $mobileno', '$gender',' $degree ',' $university','$height', '$weight','$bloodgroup', '$fathername','$mothername')";
      $result = sqlStatement($sql);
    }
       
    
    }
  }


  fclose($csvFile);

  header("Location: patient_record.php");
}

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


<style>
  #myform fieldset:not(:first-of-type) {
    display: none;
  }
</style>
<div class="container">

  <form action="" method="POST" id="myform" enctype="multipart/form-data">
    <title>Patient Record </title>
    <fieldset>
      <h2> Patient Information</h2>

      <div class="from-group">

        <label class="form-label"> Name</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>

      <div class="from-group">
        <label class="form-label"> Age</label>
        <input type="text" class="form-control" name="age" id="age">
      </div>
      <div class="from-group">
        <label class="form-label"> Address</label>
        <input type="text" class="form-control" name="address" id="address">
      </div>
      <div class="from-group">
        <label class="form-label"> Mobile No</label>
        <input type="text" class="form-control" name="mobileno" id="mobileno">
      </div>

      <div class="from-group">
        <label class="form-label"> Gender</label>
        <input type="radio" name="gender" value="male" checked> Male
        <input type="radio" name="gender" value="female" checked> Female
      </div>
      <button type="button" name="patient_information" id="patient_information" class="btn btn-info btn-lg next">Next</button>


    </fieldset>



    <fieldset>
      <h2> Education Details</h2>

      <div class="from-group">

        <label class="form-label"> Degree</label>
        <input type="text" class="form-control" name="degree" id="degree">
      </div>

      <div class="from-group">
        <label class="form-label"> University</label>
        <input type="text" class="form-control" name="university" id="university">
      </div>

      <button type="button" name="education_details" id="education_details" class="btn btn-info btn-lg previous  mt-8>">Previous</button>
      <button type="button" name="education_details" id="education_details" class="btn btn-info btn-lg next">Next</button>


    </fieldset>



    <fieldset>
      <h2>Medical Record</h2>

      <div class="from-group">

        <label class="form-label"> Height</label>
        <input type="text" class="form-control" name="height" id="height">
      </div>

      <div class="from-group">
        <label class="form-label"> Weight</label>
        <input type="text" class="form-control" name="weight" id="weight">
      </div>
      <div class="from-group">
        <label class="form-label"> Blood Group</label>
        <input type="text" class="form-control" name="bloodgroup" id="bloodgroup">
      </div>

      <button type="button" name="education_details" id="education_details" class="btn btn-info btn-lg previous  mt-8>">Previous</button>
      <button type="button" name="education_details" id="education_details" class="btn btn-info btn-lg next">Next</button>


    </fieldset>


    <fieldset>
      <h2>Parents Details</h2>

      <div class="from-group">

        <label class="form-label"> Father Name</label>
        <input type="text" class="form-control" name="fathername" id="fathername">
      </div>

      <div class="from-group">
        <label class="form-label"> Mother Name</label>
        <input type="text" class="form-control" name="mothername" id="mothername">
      </div>

      <button type="button" name="education_details" id="education_details" class="btn btn-info btn-lg previous  mt-8>">Previous</button>
      <button type="submit" value="submit" name="submit" class="btn btn-success" id="submit" onclick="onSubmit()">Submit</button>


    </fieldset>


    <input type="file" name="file" />
    <button type="submit" class="btn btn-primary" name="importSubmit" value="upload">IMPORT</button>
  </form>


</div>





<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
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

    </tr>
  </thead>
  <tbody>
    <?php


    while ($row = sqlFetchArray($res)) {

    ?>
      <tr>

        <th><?php echo $row['p_id']; ?></th>

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


      </tr> <?php }



            ?>
  </tbody>
</table>


<script>
  $(document).ready(function() {
    //   var current = 0,
    //   current_step,next_step,steps;
    steps = $("fieldset").length;


    $(".next").click(function() {
      current_step = $(this).parent();
      console.log($(this))
      next_step = $(this).parent().next();
      // console.log(next_step)
      next_step.show();
      current_step.hide();

    });
    $(".previous").click(function() {
      current_step = $(this).parent();
      next_step = $(this).parent().prev();
      next_step.show();
      current_step.hide();

    });

  });


</script>