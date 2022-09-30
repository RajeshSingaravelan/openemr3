<?php


require_once("../../globals.php");

// use OpenEMR\Common\Csrf\CsrfUtils;
// use OpenEMR\Common\Logging\EventAuditLogger;
// use OpenEMR\Core\Header;
// use OpenEMR\OeUI\OemrUI;

// $targetDir = "../doctor_details/uploads/";

// $fileName = basename($_FILES["image"]["name"]);
// echo $fileName;
// $targetFilePath = $targetDir . $fileName;

// $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

//  if (isset($_POST['submit'])&& !empty($_FILES["image"]["name"])) {

//     $fname = $_POST['fname'];

//     $lname = $_POST['lname'];

//    $speciality = $_POST['speciality'];

//     $clinic_name = $_POST['clinic_name'];
//     $date=date('Y-m-d', strtotime(str_replace('/', '-', $_POST['date'])));

//     $allowTypes = array('jpg','png','jpeg','gif','pdf');
//     // if(move_uploaded_file ($_FILES['image']['tmp_name'] , $targetFilePath))
//     //     // Upload file to server
//     //   { 

//     $sql = "INSERT INTO form_doctor_details (fname,lname,speciality,clinic_name,date,image) VALUES ('$fname','$lname','$speciality', '$clinic_name','$date','$fileName')";
//     // echo $sql;
//     $result=sqlStatement($sql);
//     if ($result == TRUE) {

//         echo "New record created successfully.";

//       }else{

//         echo "Error:";

//       }
//       if (move_uploaded_file($_FILES['image']['tmp_name'] , $targetFilePath)) {
//         echo "  Image uploaded successfully!";
//     } else {
//         echo " Failed to upload image!";
//     }
//     // }

// }
/*Left Join Table*/
// $sql = "select * from form_sample left join form_doctor_details on  c.id=form_sample.id";

$sql = "select * from form_doctor_details";
$res = sqlStatement($sql);

//  if (isset($_GET['id'])) {
//     $id = $_GET['id'];

//  $sql="DELETE FROM form_doctor_details WHERE id=$id";
//  $result=sqlStatement($sql);

//  if ($result == TRUE) {
//     header('Location:doctor_details.php');
//     // echo "Record deleted successfully.";

// }else{


//     echo "Error:" ;

// }
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
// $sql="update from form_doctor_details where id=$id";
// $res=sqlStatement($sql);
// echo $res;
// }
//  }





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
  .ui-autocomplete-row
      {
        padding:8px;
        background-color: #f4f4f4;
        border-bottom:1px solid #ccc;
        font-weight:bold;
      }
      .ui-autocomplete-row:hover
      {
        background-color: #ddd;
      }
  </style>

<div class="container">
  <div class="title">
    <title>ADDING</title>

    <form action="" method="POST" id="myform" enctype="multipart/form-data">
      <div class="mb-3 fname">
        <label class="form-label">First Name</label>
        <input type="text" class="form-control" name="fname" id="fname" required>
        <div id="nameList"></div>  
      </div>

      <div class="mb-3 lname">
        <label class="form-label">Last Name</label>
        <input type="text" class="form-control" name="lname" id="lname" required>
      </div>
      <div class="mb-3 speciality">
        <label class="form-label">Speciality</label>
        <input type="text" class="form-control" name="speciality" id="speciality" required>
      </div>

      <div class="mb-3 clinic_name">
        <label class="form-label">Clinic Name</label>
        <input type="text" class="form-control" name="clinic_name" id="clinic_name" required>
      </div>
      <div class="mb-3 Date">
        <label class="form-label">Date</label>
        <input type="text" class="form-control" name="date" id="datepicker" required>

      </div>
      <!-- <div class="mb-3 multiselect">
        <select class="fname form-control" name="fname" multiple="multiple">
       
        </select>
      </div> -->
      <div class="mb-3 Image">
        <label class="form-label">Image</label>
        <input type="file" id="image" name="image" />

      </div>

      <button type="submit" value="submit" name="submit" class="btn btn-success" id="submit">Submit</button>

    </form>
  </div>

 

  <div class="col-md-12 head ">
    <div class="float-right">
      <a href="exportData.php" class="btn btn-success ml-2"> Export</a>
    </div>
  </div>
  <!-- <div class="col-md-12 head">
    <div class="float-right">
        <a href="exportPdf.php" class="btn btn-success"> PDF</a>
    </div>
</div>
</div> -->
  <!-- <div class="col-md-12 head ">
    <div class="float-right">
        <a href="email.php" class="btn btn-success" > Email</a>
    </div>
</div> -->

  <div class="col-md-12 head  ">
    <div class="float-right">
      <button class="btn btn-success mb-4" onclick="email()"> Email</button>
    </div>
  </div>
  <table class="table table-striped result " id="table">

    <thead>

      <tr>

        <th>ID</th>

        <th>First Name</th>
        <th>Last Name</th>
        <th>Speciality</th>
        <th>Clinic Name</th>
        <th>Date</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>

    </thead>

    <tbody>

      <?php
      

      while ($row = sqlFetchArray($res)) {
        $imgURL = '../doctor_details/uploads/' . $row['image'];
      ?>

        <tr>

          <th><?php echo $row['id']; ?></th>

          <th><?php echo $row['fname']; ?></th>
          <th><?php echo $row['lname']; ?></th>
          <th><?php echo $row['speciality']; ?></th>
          <th><?php echo $row['clinic_name']; ?></th>
          <th><?php echo $row['date']; ?></th>
          <th><img src="<?php echo $imgURL; ?> " width="50px" ;></th>
          <th><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
            <button class="btn btn-danger" onclick="delete_details(<?php echo $row['id']; ?>)">Delete</button>
            <!-- <a class="btn btn-danger" href="doctor_details.php?id=<?php echo $row['id']; ?>">Delete</a> -->
            <!-- <a class="btn btn-success" href="email.php?id=<?php echo $row['id']; ?>">Email</a></th> -->
        </tr> <?php }



              ?>
    </tbody>

  </table>

</div>

<script>
  $("#datepicker").datepicker({
    dateFormat: 'dd-mm-yy'
  });
  
// });
  
  // $("#fname").autocomplete({
  //   source: "autoComplete.php"
  // });
  // $('#fname').keyup(function(){  
  //          var query = $(this).val();  
  //          if(query != '')  
  //          {  
  //               $.ajax({  
  //                    url:"autoComplete.php",  
  //                    method:"POST",  
  //                    data:{query:query},  
  //                    success:function(data)  
  //                    {  
  //                         $('#fname').fadeIn();  
  //                         $('#nameList').html(data);  
  //                    }  
  //               });  
  //          }  
  //     });  
  //     $( "#fname" ).autocomplete({
  //       source:"autoComplete.php"
  //     });

  $('#fname').autocomplete({
      source: "autoComplete.php",
      minLength: 1,
      select: function(event, ui)
      {
        $('#fname').val(ui.item.value);
      }
    }).data('ui-autocomplete')._renderItem = function(ul, item){
      return $("<li class='ui-autocomplete-row'></li>")
        .data("item.autocomplete", item)
        .append(item.label)
        .appendTo(ul);
    };
  
  $("#table").dataTable();


  // $('.fname').select2({
  //   placeholder: 'Select a First  Name',
  //   ajax: {
  //     url: 'get.php',
  //     dataType: 'json',
  //     type: 'GET',
  //     delay: 250,
  //     data: function(params) {
  //       var query = {
  //         search: params.term,
  //         type: 'public'
  //       }
  //       return query;
  //     },
  //     processResults: function(data) {
  //       console.log(data)
  //       return {
  //         // results: data.items
  //         results: $.map(data, function(obj) {
  //       return { id: obj.id, text: obj.fname };
  //     })
  //       };
  //     },
  //     cache: true
  //   }
  // });


  function email() {
    $.ajax({
      type: 'POST',
      url: 'email.php',
      dataType: 'POST'
    });
  }
  $(document).ready(function() {

    $('.js-example-basic-multiple').select2();
    $("#submit").click(function() {
      // $("#myform").on('submit',(function(e) {
      // console.log("submit");
      // e.preventDefault();
      // var fname = $('#fname').val();
      // // console.log(fname);
      // var lname = $('#lname').val();
      // var speciality = $('#speciality').val();
      // var clinic_name = $('#clinic_name').val();
      // var date = $('#datepicker').val();
      // var image = $('#image')[0].files[0];
      var form = $('#myform')[0];
      var formData = new FormData(form);

      // formData.append('image', image);

      $.ajax({
        type: 'POST',
        url: 'insert.php',
        // data: {
        //   fname: fname,
        //   lname: lname,
        //   speciality: speciality,
        //   clinic_name: clinic_name,
        //   date: date,
        //   image: image
        // },

        data: formData,
        contentType: false,
        //  cache: false,
        processData: false,
        success: function(data) {
          alert(data)
          console.log(data);
        }
      });
    });

  })

  function delete_details(id) {

    if (confirm("Are you sure you want to delete this?")) {


      $.ajax({
        type: 'POST',
        url: 'delete.php',
        data: {
          id: id
        },
        dataType: 'JSON',
        success: (data) => {
          console.log(data)


        }

      });

      location.reload();
    }
  }
</script>