<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";


$u_id=3;
$db = connect_pg_heroku();

$page_data = json_decode(file_get_contents("php://input"));
$status = $page_data->task_status;
/* Change query to prioritize the ones with due dates on top, and then the others on the bottom */
$query = "SELECT tasks.id as id,title,due_date,task_status.description as status
FROM tasks
LEFT JOIN task_status
ON tasks.status=task_status.id  WHERE 
";
if ($status != '0') {
    $query.=" status='$status' ";
} else {
    $query.=" status<4 ";
}
$query.=" ORDER BY due_date,id ASC;";
$results = pg_query($db, $query);


$ret_arr=array();
while ($row = pg_fetch_assoc($results)) {
    $ret_arr[]=$row;
    
}


print_r(json_encode($ret_arr));
