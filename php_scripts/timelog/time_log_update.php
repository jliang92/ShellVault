<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";

$page_data = json_decode(file_get_contents("php://input"));
$log_id = $page_data->log_id;
$notes = $page_data->notes;

if(is_null($notes)){
    $notes="";
}

$db = connect_pg_heroku();
$query=("UPDATE time_log SET notes='$notes' WHERE time_log_id='$log_id'");
$response = pg_query($db,$query);

$status_arr = array();
if (!$response) {
    $status_arr["status"] = "FAIL";
} else if ($response) {
    $status_arr["status"] = "SUCCESS";
} else {
    $status_arr["status"] = "ERROR";
}

print_r(json_encode($status_arr));

