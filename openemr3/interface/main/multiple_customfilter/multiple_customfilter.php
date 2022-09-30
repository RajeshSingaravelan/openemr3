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

                        <label class="form-label">FromDate</label>
                        <input type="text" class="form-control" name="from_date" id="from_date" required>
                    </div>
                    <div class="form-group">
                        <div class="mb-3 firstname">
                            <label class="form-label">To Date</label>
                            <input type="text" class="form-control" name="to_date" id="to_date" required>
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



            </table>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.fname').select2();

            $(".f_name").select2();


            fill_datatable();

            $("#from_date").datepicker({

                dateFormat: 'yy-mm-dd',
                // autoclose: true
            });
            $("#to_date").datepicker({

                dateFormat: 'yy-mm-dd',
                // autoclose: true
            });

            function fill_datatable(start_date = '', end_date = '', gender = '') {
                var dataTable = $('#table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "searching": false,
                    "ajax": {
                        url: "multiplefetch.php",
                        type: "POST",
                        data: {
                            start_date: start_date,
                            end_date: end_date,
                            gender: gender
                        }
                    }
                });
            }

            $('#filter').click(function() {
                var start_date = $('#from_date').val();
                var end_date = $('#to_date').val();
                var gender = $('#gender').val();
                console.log(gender);

                if (start_date != '' && end_date != '' && gender != '') {
                    $('#table').DataTable().destroy();
                    fill_datatable(start_date, end_date, gender);
                } else {
                    alert('Select  filter option');
                    $('#table').DataTable().destroy();
                    fill_datatable();
                }
            });
        });



        $("#datepicker").datepicker({
            dateFormat: 'dd-mm-yy'
        });
    </script>