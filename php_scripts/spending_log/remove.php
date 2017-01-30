<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
$db = connect_pg_heroku();

$data = json_decode(file_get_contents("php://input"));
$entry_id=$data->id;

$query=("DELETE FROM spending_log WHERE id=$entry_id");
$response=  pg_query($db,$query);
$status=array();

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
}
print_r(json_encode($status));