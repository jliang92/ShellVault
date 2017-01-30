<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
$db = connect_pg_heroku();

$data = json_decode(file_get_contents("php://input"));
$year_month = $data->year_month;
$contents = explode("-", $year_month);
$year = $contents[0];
$month = $contents[1];
$query = "SELECT * FROM spending_log_daily WHERE EXTRACT(YEAR FROM date_stamp)= '$year' AND EXTRACT(MONTH FROM date_stamp) = '$month' ;";
$result = pg_query($db,$query);
$days_data=array();
while($day=  pg_fetch_assoc($result)){
    $days[]=$day;
}
print_r(json_encode($days));
