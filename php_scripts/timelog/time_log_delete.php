<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";

$page_data = json_decode(file_get_contents("php://input"));


$log_id = $page_data->log_id;
//echo $log_id;
$db = connect_pg_heroku();
$query=("UPDATE time_log SET log_status='3' WHERE time_log_id=$log_id");
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

