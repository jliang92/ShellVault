<?php

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/time.php";

$u_id = 3;

$query = ("SELECT time_log_id,start_date,time_in,end_date,time_out ,hours,minutes,seconds,notes  FROM time_log  WHERE user_id='$u_id' AND log_status='2' AND archive_status='1' ORDER BY time_log_id DESC;");

$db = connect_pg_heroku();
$result = pg_query($db, $query);
$data = "Log_Id,Start_date,Time_in,End_date,Time_out,Hours,Minutes,Seconds,Notes" . "\n";

while ($row = pg_fetch_assoc($result)) {
    $data .= $row['time_log_id'] . "," . $row['start_date'] . "," . $row['time_in'] . "," . $row["end_date"] . "," . $row['time_out'] . "," . $row["hours"] . "," . $row["minutes"] . "," . $row["seconds"] . "," . $row["notes"] . "\n";
}



header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="timelog.csv"');
echo $data;
exit();

