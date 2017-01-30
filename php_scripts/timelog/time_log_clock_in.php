<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/time.php";

$date = currentDate();
$time = time24hr();


$db = connect_pg_heroku();
$query = ("INSERT INTO time_log (start_date,time_in) VALUES('$date','$time')");
$response = pg_query($db, $query);
$status_arr = array();

if ($response) {
    $status_arr["response_message"] = "SUCCESS";
    $status_arr["status_code"] = 1;
} else if (!$response) {
    $status_arr["response_message"] = "FAIL";
    $status_arr["status_code"] = 0;
} else {
    $status_arr["response_message"] = "ERROR";
    $status_arr["status_code"] = 2;
}

$status_arr["query"] = $query;
print_r(json_encode($status_arr));

