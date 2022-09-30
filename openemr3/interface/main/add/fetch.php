<?php


require_once("../../globals.php");


// $db=array(
//     'host'=>'localhost',
//     'user'=>'root',
//     'pass'=>'root',
//     'db'=>'openemr'
// );


// $table = 'form_sample';


// $primaryKey = 'id'; 

// $columns = array( 
//     array( 'db' => 'id', 'dt' => 0 ), 
//     array( 'db' => 'name',  'dt' => 1 ), 
//     array( 'db' => 'fname',      'dt' => 2 ), 
//     array( 'db' => 'firstname',      'dt' => 3 ), 
//     array( 'db' => 'date',      'dt' => 4 ),
//     array( 
//         'db'        => 'id', 
//         'dt'        => 5, 
//         'formatter' => function( $d, $row ) { 
//             return ' 
//                 <a href="update.php?id='.$d.'">Edit</a>&nbsp; 
//                 <a href="sample.php?id='.$d.'">Delete</a> 
//             '; 
//         } 
//     ) 
// ); 
// $searchFilter = array(); 

// if(!empty($_GET['search_keywords'])){ 
//     $searchFilter['search'] = array( 
//         'name' => $_GET['search_keywords'], 
//         'fname' => $_GET['search_keywords'], 
//         'firstname' => $_GET['search_keywords'], 
//         'date' => $_GET['search_keywords'] 
//     ); 
// } 

// if(!empty($_GET['filter_option'])){ 
//     $searchFilter['filter'] = array( 
//         'name' => $_GET['filter_option'] 
//     ); 
// } 
// require 'ssp.class.php'; 

// echo json_encode( 
//     SSP::simple( $_GET, $db, $table, $primaryKey, $columns, $searchFilter ) 
// );


$column = array('ID', 'Name', 'FirstName', 'Date','Gender');

$query = "
SELECT * FROM form_sample ";

if(isset($_POST['name'] ,$_POST['firstname'],$_POST['gender'] ) && $_POST['name'] != '' &&  $_POST['firstname'] != '' && $_POST['gender'])
{
 $query .= '
 WHERE name = "'.$_POST['name'].'" AND firstname="'.$_POST['firstname'].'"  AND gender="'.$_POST['gender'].'" ';
}


if(isset($_POST['order']))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id ASC ';
}


$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}


$statement = sqlStatement($query);
/*pageination*/
$number_filter_row = $statement->rowCount();
/**********/
$statement = sqlStatement($query . $query1);
// $result = sqlFetchArray($statement);

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
 $sub_array[] = $row['gender'];
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