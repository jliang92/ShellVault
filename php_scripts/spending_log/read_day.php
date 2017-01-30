<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
$db = connect_pg_heroku();

$data = json_decode(file_get_contents("php://input"));
$date_stamp=$data->date;
$query= "SELECT * FROM public_spending_log WHERE date_stamp='$date_stamp';";
$result=  pg_query($db,$query);
$transactions=array();
while($transaction=  pg_fetch_assoc($result)){
    $transactions[]=$transaction;
}
print_r(json_encode($transactions));