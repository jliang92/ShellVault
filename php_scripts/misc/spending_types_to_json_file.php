<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
include_once $root . "/config/database.php";

$db = connect_pg_heroku();

$query="SELECT * FROM spending_type;";
$result=pg_query($db,$query);

$arr=array();
while($row=$result->fetch_assoc()){
    $arr[]=$row;
}

$file_name="spending_types";
$fp = fopen("$root/assets/offlineFiles/$file_name.json", 'w');
fwrite($fp, json_encode($arr));
fclose($fp);
