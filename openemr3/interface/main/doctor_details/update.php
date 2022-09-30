<?php
require_once("../../globals.php");

if (isset($_GET['id'])) {
$id = $_GET['id'];
$sql="SELECT * FROM form_doctor_details WHERE id=$id";
$result=sqlStatement($sql);

$res=sqlFetchArray($result);
//echo $res['patient_name'];
$targetDir = "./uploads/";

$fileName = basename($_FILES["image"]["name"]);
echo $fileName;
$targetFilePath = $targetDir . $fileName;

$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


if(isset($_POST['submit']))
{
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $speciality=$_POST['speciality'];
    $clinic_name = $_POST['clinic_name'];
    $clinic_name = $_POST['clinic_name'];
    $date=date('Y-m-d', strtotime(str_replace('/', '-', $_POST['date'])));
    $image=$_FILES['image']['name'];
    $image_temp=$_FILES['image']['name'];

    if($image_temp != "")
    {
      move_uploaded_file($image_temp , "./uploads/$image");
    $sql="update form_doctor_details set id=$id,fname= '$fname ',lname=' $lname',speciality='$speciality',clinic_name='$clinic_name',date='$date', image='$image' where id=$id";
  }
  else{
    $sql="update form_doctor_details set id=$id,fname= '$fname ',lname=' $lname',speciality='$speciality',clinic_name='$clinic_name',date='$date' where id=$id";
  }
    $result=sqlStatement($sql);
   
    if($result)
    {
        // echo "Data updated successfully";
        header('location:doctor_details.php');
    }
    else{
        echo "Error:";
    }
    if (move_uploaded_file($_FILES['image']['tmp_name'] , $targetFilePath)) {
      echo "  Image uploaded successfully!";
  } else {
      echo " Failed to upload image!";
  }
}
// else (isset($_POST['submit'])&& !empty($_FILES["image"]["name"]))
// {

// }
}
?>
 <html>
   <head>
<title>Update</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<style>
    .age{
        margin-top: 5px;
        margin-bottom: 5px;
    }
    /* table, tr, th {
  border:1px solid black;
} */

</style>
    </head>
    <body>
        <div class="container col-md-8 mt-3">
        <form action="" method="POST"  enctype="multipart/form-data">
  <div class="mb-3 fname">
    <label  class="form-label">First Name</label>
    <input type="text" class="form-control"  name="fname" id="fname"  value="<?php echo $res['fname']; ?>" required >

  </div>
  <div class="mb-3 lname">
    <label  class="form-label">Last Name</label>
    <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $res['lname']; ?>"required>
  </div>
  <div class="mb-3 speciality">
    <label  class="form-label">Speciality</label>
    <input type="text" class="form-control" name="speciality" id="speciality"value="<?php echo $res['speciality']; ?> "required>
  </div>
  <div class="mb-3 speciality">
    <label  class="form-label">Speciality</label>
    <input type="text" class="form-control" name="speciality" id="speciality"value="<?php echo $res['speciality']; ?> "required>
  </div>
  <div class="mb-3 clinic_name">
    <label  class="form-label">Clinic Name</label>
    <input type="text" class="form-control" name="clinic_name" id="clinic_name" value="<?php echo $res['clinic_name']; ?>"required>
  </div>
  <div class="mb-3 Date">
    <label  class="form-label">Date</label>
    <input type="text" class="form-control" name="date" id="datepicker"  value="<?php echo $res['date']?>"required>
    
  </div>
  <div class="mb-3 Image">
    <label  class="form-label">Image</label>
    <input type="file"  id="image" name="image" />
   <?php $imgURL='../doctor_details/uploads/'.$res['image'];?>
   <img src="<?php echo $imgURL; ?> " width="50px";>
  </div>

  <button type="submit"  value="submit" name="submit" class="btn btn-success">Submit</button>
</form>
<script>
  $( "#datepicker" ).datepicker(
    { dateFormat: 'dd-mm-yy' }
  );
  </script>
    </body>
</html>

