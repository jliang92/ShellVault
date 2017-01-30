<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once filter_input(INPUT_SERVER,'DOCUMENT_ROOT' )."/config/database.php";
$db=  connect_pg_heroku();

$data = json_decode(file_get_contents("php://input")); 
$s=$data->source;
$u=$data->username;
$p=$data->password;
$pu=$data->purpose;
$e=$data->email;// if on the email is poorly formatted on the front end, this script will fail
$query=("INSERT INTO vault_log (purpose,source,email,uname,pword)VALUES('$pu','$s','$e','$u','$p');");
$response=pg_query($db,$query);


if($response){
    echo "SUCCESS";
}else if(!$response){
    echo "FAIL";
}else{
    echo "ERROR $response";
}

