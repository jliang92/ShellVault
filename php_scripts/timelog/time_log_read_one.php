<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
include_once $root . "/config/database.php";

$page_data = json_decode(file_get_contents("php://input"));
$log_id = $page_data->log_id;


$db = connect_pg_heroku();

$query = ("SELECT *  FROM public_time_log WHERE time_log_id='$log_id';");
$result = pg_query($db, $query);

$entry_arr = array();

$res_fetched = pg_fetch_assoc($result);
$entry_arr["id"] = $res_fetched["time_log_id"];
$entry_arr["start_date"] =$res_fetched["start_date"];
$entry_arr["time_in"] =$res_fetched["time_in"];
$entry_arr["end_date"] =$res_fetched["end_date"];
$entry_arr["time_out"] =$res_fetched["time_out"];
$entry_arr["log_status"] =$res_fetched["log_status"];
$entry_arr["hours"] =$res_fetched["hours"];
$entry_arr["minutes"] =$res_fetched["minutes"];
$entry_arr["seconds"] =$res_fetched["seconds"];
$entry_arr["notes"] = $res_fetched["notes"];
$entry_arr["status_id"] = $res_fetched["id"];
$entry_arr["status_name"] = $res_fetched["name"];
$entry_arr["query"]=$query;


print_r(json_encode($entry_arr));

