<?php


require_once("../../globals.php");

$column = array('ID', 'Name', 'FirstName', 'Date' );

$query = "SELECT * FROM form_sample WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'date BETWEEN "'.$_POST["from_date"].'" AND "'.$_POST["to_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (id LIKE "%'.$_POST["search"]["value"].'%" 
  OR name LIKE "%'.$_POST["search"]["value"].'%" 
  OR firstname LIKE "%'.$_POST["search"]["value"].'%" 
  OR date LIKE "%'.$_POST["search"]["value"].'%")
 ';
}

if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}


$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}


$statement = sqlStatement($query);
$number_filter_row = $statement->rowCount();
$statement = sqlStatement($query . $query1);

$data = array();

while($row = sqlFetchArray($statement))
{
    $id=$row['id'];
 $sub_array = array();
 $sub_array[] = $row['id'];
 $sub_array[] = $row['name'];
 $sub_array[] = $row['fname'];
 $sub_array[] = $row['firstname'];
 $sub_array[] = $row['date'];
 $sub_array[] = '<a href="sample.php?id='.$id.'" class="btn btn-sm-danger">Delete</a>';
 $sub_array[] = '<a href="update.php?id='.$id.'" class="btn btn-sm-danger">Edit</a>';
 $data[] = $sub_array;
}

function count_all_data()
{
 $query = "SELECT * FROM form_sample";
 $statement = sqlStatement($query);

 return $statement->rowCount();
}

$output = array(
    "draw"       =>  intval($_POST["draw"]),
    "recordsTotal"   =>  count_all_data(),
    "recordsFiltered"  =>  $number_filter_row,
    "data"       =>  $data
   );
   
   echo json_encode($output);
?>