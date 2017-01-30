<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* This is to say that the entry is to be marked as paid, consider taking the array or invoking 1 at a time, probably take as array */

/*
 * Concept is to take an array of ids and then mark them as archived
 */

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
try {
    $page_data = json_decode(file_get_contents("php://input"));
    $log_ids = $page_data->log_ids;

    /* data being sent to this script is comma seperated so can split via comma */
    echo $log_ids;
} catch (Exception $e) {
    echo $e->getMessage();
}