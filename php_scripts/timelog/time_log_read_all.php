<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";



$db = connect_pg_heroku();
$query="SELECT * FROM public_time_log WHERE log_status<3;";
$resultSet=pg_query($db,$query);
$returnArray=array();
while($resultSetFetch=  pg_fetch_assoc($resultSet)){
    $returnArray[]=$resultSetFetch;
}

print_r(json_encode($returnArray));











