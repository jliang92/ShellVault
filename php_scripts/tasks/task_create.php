<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/time.php";

$date_created = currentDate();


$data = json_decode(file_get_contents("php://input"));
$title = $data->title;
$description = $data->description;
$due_date = $data->due_date;



$conn = connect_pg_heroku();

$fields = "INSERT INTO tasks (title,description,date_created";
$values = "VALUES('$title','$description','$date_created'";


if (!empty($due_date)) {
    $fields.=",due_date";
    $values.=",'$due_date'";
}
$query = $fields . ")" . $values . ");";
//echo $query;
$success = pg_query($conn, $query);
if (!$success) {
    /* There was an error */
    echo "fail";
} else {
    echo "success";
}


