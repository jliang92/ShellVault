<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";

$data=json_decode(file_get_contents("php://input"));
$task_id=$data->id;

$read_one_query="SELECT tasks.id as id,title,due_date,task_status.description as status,tasks.description as task_description,resolution,date_created,notes
FROM tasks
LEFT JOIN task_status
ON tasks.status=task_status.id 
WHERE tasks.id='$task_id';";
$pg_db=  connect_pg_heroku();
$result=  pg_query($pg_db,$read_one_query);
$result_fetch=  pg_fetch_assoc($result);
$task_arr[] = array(
    "id" => $result_fetch["id"],
    "title" => $result_fetch["title"],
    "description" => $result_fetch["task_description"],
    "status" => $result_fetch["status"],
    "due_date"=>$result_fetch["due_date"],
    "date_created"=>$result_fetch["date_created"],
    "resolution"=>$result_fetch["resolution"],
    "notes"=>$result_fetch["notes"]
    
);
print_r(json_encode($task_arr));