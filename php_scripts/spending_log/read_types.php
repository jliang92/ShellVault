<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');


include_once $root . "/config/database.php";

$db = connect_pg_heroku();


$query = "SELECT * FROM  spending_type;";
$types_set = pg_query($db, $query);
$type_arr = array();

while ($type = pg_fetch_assoc($types_set)) {
    $type_arr[] = $type;
}

$json_encoded_arr = json_encode($type_arr);


print_r($json_encoded_arr);


