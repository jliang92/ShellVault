<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
$db = connect_pg_heroku();

$data = json_decode(file_get_contents("php://input"));
$date_stamp = $data->date_stamp; //will probably have to split and reformat the date since the html is mm/dd/yyyy but db is yyyy-mm-dd


$type = $data->transaction_type;
$cost = $data->cost;
$description = $data->description;
$status = array();
$query = "INSERT INTO spending_log (date_stamp,cost,description,spending_type) VALUES('$date_stamp', '$cost', '$description', '$type');";
$response = pg_query($db, $query);

if ($response) {
    $status["status_code"] = 1;
    $status["status_message"] = "SUCCESS";
} else if (!$response) {
    $status["status_code"] = 0;
    $status["status_message"] = "FAIL";
    $status["query"]=$query;
} else {
    $status["status_code"] = 2;
    $status["status_message"] = "ERROR";
    $status["query"]=$query;
}

print_r(json_encode($status));
