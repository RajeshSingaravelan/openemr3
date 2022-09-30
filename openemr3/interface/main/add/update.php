<?php


require_once("../../globals.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM form_sample WHERE id=$id";
    $result = sqlStatement($sql);

    $data = sqlFetchArray($result);


echo $data['fname'];

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $fname = implode(',', $_POST['fname']);
        $firstname = $_POST['firstname'];
        $date=date('Y-m-d', strtotime(str_replace('/', '-', $_POST['date'])));
        $gender = $_POST['gender'];
        $sql = "update form_sample set id=$id,name= '$name ',fname=' $fname',firstname='$firstname',date='$date',gender='$gender' where id=$id";


        $result = sqlStatement($sql);
       

        if ($result) {
            // echo "Data updated successfully";
            header('location:sample.php');
        } else {
            echo "Error:";
        }
    }
}
// $res = "SELECT id, fname FROM form_doctor_details";
// $rows = sqlStatement($res);

?>


















<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container">
    <div class="title">
        <title>Update</title>
        <form action="" method="POST">
            <label>Name:</label>
            <input type="text" id="name" class="form-control" name="name" value="<?php echo $data['name']; ?>">


            <div class="mb-3">
                <label class="form-label"> Name List</label>

                <select class="fname form-control" name="fname[]" multiple="multiple" >

                    <?php
                    $fname = explode(",",$data['fname']);
                   
                    $result = sqlStatement("SELECT * FROM form_doctor_details");
                   
                    $i = 0;
                    while ($res = sqlFetchArray($result)) {
                        
                        if (in_array($res["fname"],array_map('trim', $fname)))
                        
                            $str= "selected";
                        else
                            $str = "";
                    ?>
                        <option value="<?= $res["fname"]; ?>" <?php echo $str; ?>><?= $res["fname"]; ?></option>
                    <?php
                        $i++;
                    }
                    ?>
                </select>

                
            </div>
            <?php 
                    //     print_r($fname);
                    //     $result = sqlStatement("SELECT * FROM form_doctor_details");
                    //     while ($res = sqlFetchArray($result)) {
                    //     // echo $res['fname'];
                    // //    echo strlen($fname[0],$res['fname']);
                    //     $data= in_array(($res['fname']),array_map('trim', $fname));
                    //     echo $data;

                    //     }
?>
 
              <div class="mb-3 age">
                <label class="form-label"> First Name </label>
                <select class="f_name form-control" name="firstname" >
                <?php
                    $firstname = explode(",", $data["firstname"]);
                    
                    $result = sqlStatement("SELECT * FROM form_doctor_details");
                   
                    while ($row = sqlFetchArray($result)) {
                        if (in_array($row["fname"], $firstname))
                            $str_flag = "selected";
                        else
                            $str_flag = "";
                    ?>
                        <option value="<?= $row["fname"]; ?>" <?php echo $str_flag; ?>><?= $row["fname"]; ?></option>
                    <?php
                        
                    }
                    ?> 
                </select>
            </div>  
            
<?php


?>
 <div class="mb-3 Date">
        <label class="form-label">Date</label>
        <input type="text" class="form-control" name="date" id="datepicker" value="<?php echo $data['date']?>"required>

      </div>

      <div class="mb-3 Gender">
        <label class="form-label"> Gender</label>
        <input type="radio" name="gender" value="male" checked> Male
        <input type="radio" name="gender" value="female" checked> Female
      </div>

            <button class="submit" name="submit" value="submit">Submit</button>
        </form>
    </div>
   


</div>
<script>
    $(document).ready(function() {
        $('.fname').select2();


        $(".f_name").select2();
        // $(".f_name").select2({
        //     ajax: {
        //         url: "select.php",
        //         type: "post",
        //         dataType: 'json',
        //         delay: 250,
        //         data: function(params) {
        //             return {
        //                 searchTerm: params.term // search term
        //             };
        //         },
        //         processResults: function(response) {
        //             return {
        //                 results: response
        //             };
        //         },
        //         cache: true
        //     }
        // });


    });

    $("#datepicker").datepicker({
    dateFormat: 'dd-mm-yy'
  });
</script>