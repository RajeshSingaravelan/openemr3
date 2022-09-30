<?php


require_once("../../globals.php");
// require 'ssp.class.php'; 
// use OpenEMR\Common\Csrf\CsrfUtils;
// use OpenEMR\Common\Logging\EventAuditLogger;
// use OpenEMR\Core\Header;
// use OpenEMR\OeUI\OemrUI;


if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    // echo $name;
    $fname = implode(',', $_POST['fname']);

    $firstname = $_POST['firstname'];
    $date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['date'])));
    $gender = $_POST['gender'];
    $sql = "INSERT INTO form_sample(name,fname,firstname,date,gender) VALUES ('$name','$fname','$firstname','$date','$gender')";
    // echo $sql;
    $result = sqlStatement($sql);
    if ($result == TRUE) {

        echo "New record created successfully.";
    } else {

        echo "Error:";
    }
}


$sql = "select * from form_sample";
$query = sqlStatement($sql);
// echo $query;





if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM form_sample WHERE id=$id";
    $result = sqlStatement($sql);

    if ($result == TRUE) {
        header('Location:sample.php');
        // echo "Record deleted successfully."; 

    } else {


        echo "Error:";
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "update from form_sample where id=$id";
        $res = sqlStatement($sql);
        echo $res;
    }
}


$res = "SELECT id, fname FROM form_doctor_details";
$rows = sqlStatement($res);








?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" rel="stylesheet" />


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script> -->






<div class="container">
    <div class="title">
        <title>ADDING</title>
        <form action="" method="POST">
            <label>Name:</label>
            <input type="text" id="name" class="form-control" name="name">


            <div class="mb-3">
                <label class="form-label"> Name List</label>
                <select class="fname form-control" name="fname[]" multiple="multiple">
                    <!-- <option value="one">Select</option> -->
                    <?php
                    $fname_row = sqlStatement("SELECT * FROM form_doctor_details");
                    $i = 0;
                    while ($fname_res = sqlFetchArray($fname_row)) {
                    ?>
                        <option value="<?= $fname_res["fname"]; ?>"><?= $fname_res["fname"]; ?></option>
                    <?php
                        $i++;
                    }
                    ?>
                    <!-- <?php foreach ($rows as $row) : ?>
                        <option value="<?= $row['id'] ?>"><?= $row['fname'] ?></option>
                    <?php endforeach; ?> -->
                </select>
            </div>

            <div class="mb-3 age">
                <label class="form-label"> First Name </label>
                <select class="f_name form-control" name="firstname">
                    <?php $first_row = sqlStatement("SELECT * FROM form_doctor_details");
                    while ($first_res = sqlFetchArray($first_row)) {
                    ?>
                        <option value="<?= $first_res["fname"]; ?>"><?= $first_res["fname"]; ?></option>
                    <?php } ?>
                </select>
            </div>


            <div class="mb-3 Date">
                <label class="form-label">Date</label>
                <input type="text" class="form-control" name="date" id="datepicker" required>

            </div>
            <div class="mb-3 Gender">
        <label class="form-label"> Gender</label>
        <input type="radio" name="gender" value="male" checked> Male
        <input type="radio" name="gender" value="female" checked> Female
      </div>
            <button class="btn btn-success" name="submit" value="submit">Submit</button>
        </form>
    </div>



    <!-- <div class="col-sm-2">
<input type="text" name="From" id="From" class="form-control" placeholder="select From Date"/>
</div>

<div class="col-sm-2">
<input type="text" name="to" id="to" class="form-control" placeholder="select To Date"/>
</div> -->
    <!-- <div class="col-sm-8">
<input type="button" name="range" id="range" value="search" class="btn btn-success"/>
</div> -->

    <div id="report">
        <!-- <table border="0" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <td>Minimum Date:</td>
                <td><input type="text" name="From" id="From" class="form-control" placeholder="select From Date"/></td>
            </tr>
            <tr>
                <td>Maximum Date:</td>
                <td><input type="text" name="to" id="to" class="form-control" placeholder="select To Date"/></td>
            </tr>
        </tbody>
    </table> -->

        <!-- <div class="mb-3 age">
        <div class="form-group">
            <label class="form-label"> Name </label>
            <select class="name form-control " name="name" id="name">
                <option value="">Select</option>
                <?php $first_row = sqlStatement("SELECT * FROM form_sample");
                while ($first_res = sqlFetchArray($first_row)) {
                ?>

                    <option value="<?= $first_res["name"]; ?>"><?= $first_res["name"]; ?></option>
                <?php } ?>
            </select>


        </div>
               

        <div class="form-group" align="center">
            <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>
        </div>

        </div> -->

        <div class="container box">
  
   <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
     <div class="form-group">
     <label class="form-label">  Name </label>
      <select class="name form-control " name="name" id="Sample_name">
                <option value="">Select</option>
                <?php $first_row = sqlStatement("SELECT * FROM form_sample");
                while ($first_res = sqlFetchArray($first_row)) {
                ?>

                    <option value="<?= $first_res["name"]; ?>"><?= $first_res["name"]; ?></option>
                <?php } ?>
            </select>
     </div>
     <div class="form-group">
     <div class="mb-3 firstname">
                <label class="form-label"> First Name </label>
                <select class="firstname form-control" name="firstname" id="firstname">
                <option value="">Select</option>
                    <?php $first_row = sqlStatement("SELECT * FROM form_doctor_details");
                    while ($first_res = sqlFetchArray($first_row)) {
                    ?>
                        <option value="<?= $first_res["fname"]; ?>"><?= $first_res["fname"]; ?></option>
                    <?php } ?>
                </select>
            </div>
     </div>
     <div class="form-group">
     <div class="mb-3 gender">
                <label class="form-label"> Gender </label>
                <select class="gender form-control" name="gender" id="gender">
                <option value="">Select</option>
                   <option value="male">Male</option>
                   <option value="female">Female</option>
                </select>
            </div>
     </div>
   
     <div class="form-group" align="center">
      <button type="button" name="filter" id="filter" class="btn btn-info">Filter</button>
     </div>
    </div>
    <div class="col-md-4"></div>
   </div>
       

        <table class="table table-striped result" id="table">

            <thead>

                <tr>

                    <th>ID</th>

                    <th id="tabname">Name</th>
                    <th id="tabname">Name List</th>
                    <th id="tabname">First Name</th>
                    <th id="tabname">Date</th>
                    <th id="tabname">Gender</th>
                    <th>Delete</th>
                    <th>Edit</th>
                    
                </tr>

            </thead>

            <!-- <tbody>

            <?php


            while ($data = sqlFetchArray($query)) {

            ?>

                <tr>

                    <td><?php echo $data['id']; ?></td>

                    <td><?php echo $data['name']; ?></td>
                    <td><?php echo $data['fname']; ?></td>

                    <th><a class="btn btn-info" href="update.php?id=<?php echo $data['id']; ?>">Edit</a></th>
                    <th> <button class="btn btn-danger" href="sample.php?id=(<?php echo $data['id']; ?>)">Delete</button></th>

                </tr> <?php }



                        ?>
        </tbody> -->

        </table>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.fname').select2();

        $(".f_name").select2();


        fill_datatable();

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

        // table.api().rows().invalidate().draw();

        // $('#From, #to').change(function () {
        //         table.draw();
        //     });



        // $('#name').bind("keyup change", function(){
        //     table.draw();
        // });


        function fill_datatable(name = '',firstname='',gender='') {
            var dataTable = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "searching": false,
                "ajax": {
                    url: "fetch.php",
                    type: "POST",
                    data: {
                        name: name,firstname:firstname,gender:gender
                    }
                }
            });
        }

        $('#filter').click(function() {
        var name = $('#Sample_name').val();
      console.log(name);
      var firstname = $('#firstname').val();
      console.log(firstname);
      var gender = $('#gender').val();
      console.log(gender);

        if (name != '' && firstname!='' && gender!='') {
            $('#table').DataTable().destroy();
            fill_datatable(name,firstname,gender);
        } else {
            alert('Select  filter option');
            $('#table').DataTable().destroy();
            fill_datatable();
        }
    });
    });


    //  $('.dateFilter').datepicker({
    //    dateFormat: "yy-mm-dd"
    //  });

    // $("#From").datepicker({
    //   dateFormat: 'yy-mm-dd'
    // }

    // );
    // 		$("#to").datepicker(
    //       {
    //         dateFormat: 'yy-mm-dd'
    //       }
    //     );


    // $('#range').click(function(){
    // 	var From = $('#From').val();
    // console.log(From);
    // 	var to = $('#to').val();
    // console.log(to);
    // 	//check conditions
    // 	if(From != '' && to != '')
    // 	{
    // 		// call ajax using range.php file
    // 		$.ajax({
    // 			url:"report_sample.php",
    // 			method:"POST",
    // 			data:{From:From, to:to},
    // 			success:function(data)
    // 			{
    // 				$('#report').html(data);
    // 			}
    // 		});
    // 	}
    // 	else
    // 	{
    // 		alert("Please Select the Date");
    // 	}
    // });
   

    $("#datepicker").datepicker({
        dateFormat: 'dd-mm-yy'
    });



    //  var table= $("#table").dataTable({
    //     // dom: 'Bfrtip',
    //     // buttons: [
    //     //     'copy', 'csv', 'excel', 'pdf', 'print'
    //     //   ],
    //         "searching": false,
    //         "processing": true,
    //         "serverSide": true,

    //         "ajax": 
    //         {
    //         "url":"fetch.php",
    //         "data": function ( d ) {
    //       return $.extend( {}, d, { 


    //            "filter_option":$("#name").val()
    //         } );
    //     }
    //        }




    //     });


    /* column filtering */
    // $('#table #tabname').each(function () {
    //         var title = $(this).text();
    //         // console.log(title);
    //         $(this).html(title+' <input type="text" class="col-search-input" placeholder="Search ' + title + '" />');
    //     });

    //     table.api().columns().every(function () {
    //         var table = this;
    //         $('input', this.header()).on('keyup change', function () {
    //             if (table.search() !== this.value) {
    //             	   table.search(this.value).draw();
    //             }
    //         });
    //     });


    // $.fn.dataTable.ext.search.push(
    // function (settings, data, dataIndex) {
    //     var min = $('#From').datepicker("getDate");
    //     var max = $('#to').datepicker("getDate");
    //     var startDate = new Date(data[4]);
    //     if (min == null && max == null) { return true; }
    //     if (min == null && startDate <= max) { return true;}
    //     if(max == null && startDate >= min) {return true;}
    //     if (startDate <= max && startDate >= min) { return true; }
    //     return false;
    // }
    // );
    // $("#From").datepicker({ onSelect: function () { table.api().row().invalidate().draw(); }, changeMonth: true, changeYear: true });
    //     $("#to").datepicker({ onSelect: function () { table.api().row().invalidate().draw(); }, changeMonth: true, changeYear: true });
</script>