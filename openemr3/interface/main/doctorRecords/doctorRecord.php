<?php


require_once("../../globals.php");

if (isset($_POST['submit'])) {

        $p_id = $_POST['p_id'];
    
        $dname = $_POST['dname'];

        $clinic_name=$_POST['clinic_name'];

        $sql = "INSERT INTO doctor_records (p_id,dname,clinic_name) VALUES ('$p_id','$dname','$clinic_name')";
        
        $result=sqlStatement($sql);
        // echo $result;

        if ($result == TRUE) {

                    echo "New record created successfully.";
            
                  }else{
            
                    echo "Error:";
            
                  }
}


$sql = "select * from doctor_records";
$res = sqlStatement($sql);
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






<div class="container">
  <div class="title">
    <title>ADDING</title>

    <form action="" method="POST" id="myform" >
      <div class="mb-3 fname">
        <label class="form-label"> P_id</label>
        <select class="p_id form-control" name="p_id" id="p_id">
                <option value="">Select</option>
                    <?php $first_row = sqlStatement("SELECT * FROM patient_records");
                    while ($first_res = sqlFetchArray($first_row)) {
                    ?>
                        <option value="<?= $first_res["p_id"]; ?>"><?= $first_res["p_id"]; ?></option>
                    <?php } ?>
                </select> 
      </div>

      <div class="mb-3 name">
        <label class="form-label"> Name</label>
        <input type="text" class="form-control" name="dname" id="dname" required>
      </div>
      <div class="mb-3 clinic_name">
        <label class="form-label">Clinic Name</label>
        <input type="text" class="form-control" name="clinic_name" id="clinic_name" required>
      </div>

      

      <button type="submit" value="submit" name="submit" class="btn btn-success" id="submit">Submit</button>
<a href="doctor_leftjoin.php" class="btn btn-success">Left join</a>
    </form>
  </div>

 

  
  <table class="table table-striped result " id="table">

    <thead>

      <tr>

        <th>ID</th>

        <th>P_ID</th>
        <th>Name</th>
        <th>Clinic Name</th>
        
      </tr>

    </thead>

    <tbody>

      <?php
      

      while ($row = sqlFetchArray($res)) {
         
        
      ?>

        <tr>

          <th><?php echo $row['dr_id']; ?></th>

          <th><?php echo $row['p_id']; ?></th>
          <th><?php echo $row['dname']; ?></th>
          <th><?php echo $row['clinic_name']; ?></th>
        
        </tr> <?php }



              ?>
    </tbody>

  </table>

</div>