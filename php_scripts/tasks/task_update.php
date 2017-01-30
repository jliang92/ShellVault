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
$title = $data->title;
$description = $data->description;
$resolution = $data->resolution;
$notes = $data->notes;
$due_date=$data->due_date;
$status=$data->status;



$update_query="UPDATE tasks SET title='$title',description='$description',resolution='$resolution',notes='$notes' ";
        
if($status=="INCOMPLETE"){$update_query.= ", status='1' ";}
if($status=="COMPLETED"){$update_query.= ", status='3' ";}


if(!empty($due_date)){
    $update_query.=",due_date='$due_date' ";
}
$update_query.= " WHERE id='$id';";
//echo $update_query;
$db = connect_pg_heroku();
$success=pg_query($db,$update_query);
//echo $update_query;
if(!$success){
    /*False is returned so something went wrong*/
    echo "failed";
}else{
    echo "success";
}