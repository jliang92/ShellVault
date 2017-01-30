<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";

$page_data=json_decode(file_get_contents("php://input"));
$log_ids=$page_data->log_ids;

/*data being sent to this script is comma seperated so can split via comma*/
echo $log_ids;