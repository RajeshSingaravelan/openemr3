<?php


require_once("../../globals.php");




$sql = "select * from form_doctor_details";
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





 <div class="container" mt-5>
 <!-- <input type="text" name="daterange"  /> -->
 <!-- <input type="button" name="range" id="range" value="search" class="btn btn-success"/> -->
</div>

<div class="col-sm-2 mt-4">
<input type="text" name="From" id="From" class="form-control" placeholder="select From Date"/>
</div>

<div class="col-sm-2 mt-4">
<input type="text" name="to" id="to" class="form-control" placeholder="select To Date"/>
</div>

<div class="col-sm-8 mt-4">
<input type="button" name="range" id="range" value="search" class="btn btn-success"/>
<input type="button" name="filter" id="filter" value="filter" class="btn btn-success"/>
<button class="btn btn-success" onclick="email()"> Email</button>
</div>


<div id="report">

<table class="table table-striped result mt-4 " id="table">

    <thead>

      <tr>

        <th>ID</th>

        <th>First Name</th>
        <th>Last Name</th>
        <th>Speciality</th>
        <th>Clinic Name</th>
        <th>Date</th>
        <th>Image</th>
        
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
         
        </tr> <?php }



              ?>
    </tbody>

  </table>

      </div>

<script>
$(document).ready(function () {
 
 $('.dateFilter').datepicker({
   dateFormat: "yy-mm-dd"
 });

$("#From").datepicker({
  dateFormat: 'yy-mm-dd'
}
 
);




		$("#to").datepicker(
      {
        dateFormat: 'yy-mm-dd'
      }
    );
  
    $('#range').click(function(){
		var From = $('#From').val();
    console.log(From);
		var to = $('#to').val();
    console.log(to);
		//check conditions
		if(From != '' && to != '')
		{
			// call ajax using range.php file
			$.ajax({
				url:"get_range.php",
				method:"POST",
				data:{From:From, to:to},
				success:function(data)
				{
					$('#report').html(data);
				}
			});
		}
		else
		{
			alert("Please Select the Date");
		}
	});


$('#filter').click(function(){
		var From = $('#From').val();
    console.log(From);
		var to = $('#to').val();
    console.log(to);
		//check conditions
		if(From != '' && to != '')
		{
			// call ajax using range.php file
			$.ajax({
				url:"export_range.php",
				method:"POST",
				data:{From:From, to:to},
				success:function(data)
				{
          var downloadLink = document.createElement("a");
          var fileData = ['\ufeff'+data];

          var blobObject = new Blob(fileData,{
             type: "text/csv;charset=utf-8;"
           });

          var url = URL.createObjectURL(blobObject);
          downloadLink.href = url;
          downloadLink.download = "report_gen.csv";

          /*
           * Actually download CSV
           */
          document.body.appendChild(downloadLink);
          downloadLink.click();
          document.body.removeChild(downloadLink);

				}
			});
		}
		else
		{
			alert("Please Select the Date");
		}
	});


  // $('#range').click(function(){
    $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    var start_date=start.format('YYYY-MM-DD');
    console.log(start_date);
    var end_date=end.format('YYYY-MM-DD');
    console.log(end_date);
    // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
 
    $.ajax({
      url:"get_range.php",
      method:"post",
      data:{from_date:start_date,to_date:end_date},
      success:function(data)
      {
        console.log(data);
        $("#report").html(data);
      }
    })
  });
});



function email() {
  // console.log("email")
    // $.ajax({
    //   type: 'POST',
    //   url: 'report_email.php',
    //   dataType: 'POST'
    // });

    var From = $('#From').val();
    console.log(From);
		var to = $('#to').val();
    console.log(to);
		//check conditions
		if(From != '' && to != '')
		{
			// call ajax using range.php file
			$.ajax({
				url:"report_email.php",
				method:"POST",
				data:{From:From, to:to},
				success:function(data)
				{
         

				}
			});
		}
		else
		{
			alert("Please Select the Date");
		}

  }
</script>