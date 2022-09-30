<?php


require_once("../../globals.php");





$column = array('ID', 'Name', 'FirstName', 'Date', 'Gender');

$query = "
SELECT * FROM form_sample ";

if (isset($_POST['start_date'], $_POST['end_date'], $_POST['gender']) && $_POST['start_date'] != '' &&  $_POST['end_date'] != '' && $_POST['gender']) {
    $query .= '
    WHERE date  BETWEEN  "' . $_POST["start_date"] . '" AND "' . $_POST["end_date"] . '"  AND  gender= "' . $_POST["gender"] . '"';
}


if (isset($_POST['order'])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY id ASC ';
}


$query1 = '';

if ($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}


$statement = sqlStatement($query);
$number_filter_row = $statement->rowCount();
$statement = sqlStatement($query . $query1);
// $result = sqlFetchArray($statement);

$data = array();

while ($row = sqlFetchArray($statement)) {
    $id = $row['id'];
    $sub_array = array();
    $sub_array[] = $row['id'];
    $sub_array[] = $row['name'];
    $sub_array[] = $row['fname'];
    $sub_array[] = $row['firstname'];
    $sub_array[] = $row['date'];
    $sub_array[] = $row['gender'];
    $sub_array[] = '<a href="sample.php?id=' . $id . '" class="btn btn-sm-danger">Delete</a>';
    $sub_array[] = '<a href="update.php?id=' . $id . '" class="btn btn-sm-danger">Edit</a>';
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
