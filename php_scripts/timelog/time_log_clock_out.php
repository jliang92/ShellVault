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

$start_time_query = "SELECT time_log_id,time_in FROM public_time_log WHERE log_status='1' ORDER BY time_log_id DESC LIMIT 1;";
$db = connect_pg_heroku();
$result1 = pg_query($db, $start_time_query);
$result1_fetch = pg_fetch_assoc($result1);

$log_id = $result1_fetch["time_log_id"];
$time_in = $result1_fetch["time_in"];


$duration = time_diff($time_in, $time);
$hours = $duration["hours"];
$minutes = $duration["minutes"];
$seconds = $duration["seconds"];


$update_query = "UPDATE time_log SET end_date='$date' ,time_out='$time',log_status='2',hours='$hours',minutes='$minutes',seconds='$seconds' WHERE time_log_id='$log_id';";

$response = pg_query($db, $update_query);

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
$status_arr["query1"] = $update_query;

$status_arr["query2"] = $update_query;
print_r(json_encode($status_arr));



