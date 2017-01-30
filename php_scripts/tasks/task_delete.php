<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";


$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
/*will only mark them as deleted*/
$delete_query="UPDATE tasks SET status='4' WHERE id='$id';";
$db = connect_pg_heroku();
$success=pg_query($db,$delete_query);
if(!$success){
    echo "fail";
}else{
    echo "success";
}