<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
$db = connect_pg_heroku();

$query="SELECT * FROM spending_log_monthly";
$result=  pg_query($db,$query);
$months=array();
while($month=  pg_fetch_assoc($result)){
    $months[]=$month;
}
print_r(json_encode($months));