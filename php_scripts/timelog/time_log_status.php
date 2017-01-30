<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
include_once $root . "/config/database.php";
$log_arr[] = array();

try {
    $db = connect_pg_heroku();
    $status_query = "SELECT id,log_status FROM public_time_log WHERE log_status < 3 ORDER BY time_log_id DESC LIMIT 1;";
    $result = pg_query($db,$status_query);
    $result_fetched = pg_fetch_assoc($result);
    if (is_null($result_fetched) == true) {
        $log_arr["id"] = 0;
        $log_arr["log_status"] = 0;
    } else {
        $log_arr["id"] = $result_fetched["id"];
        $log_arr["log_status"] = $result_fetched["log_status"];
    }
    $fp = fopen($root . '/assets/offlineFiles/timelog_status.json', 'w');
    fwrite($fp, json_encode($result_fetched));
    fclose($fp);
} catch (Exception $e) {
    $log_arr["log_status"] = 4;
    $log_arr["error_message"] = $e->getMessage();
}


print_r(json_encode($log_arr));
