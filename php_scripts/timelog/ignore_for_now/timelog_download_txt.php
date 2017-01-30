<?php

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/time.php";

$u_id = 3;
$summarized_query="SELECT  sum( hours) as hours, sum(minutes) as minutes, sum(seconds) as seconds
  FROM public.time_log WHERE log_status='2' AND archive_status='1' AND user_id='$u_id';
";/*This expects something like Total Hours 4 Minutes 4 Seconds 4*/


$query = ("SELECT start_date,sum(hours) as hours,sum(minutes) as minutes,sum(seconds) as seconds"
        . " FROM time_log"
        . " WHERE user_id='$u_id' AND log_status='2' AND archive_status='1' GROUP BY start_date ORDER BY start_date ASC;");

$db = connect_pg_heroku();

$total_result=  pg_query($db,$summarized_query);
$total_result_fetch=  pg_fetch_assoc($total_result);

$db_time=$total_result_fetch['hours'].":".$total_result_fetch['minutes'].":".$total_result_fetch['seconds'];

$formatted_time=  format_time($db_time);



$result = pg_query($db, $query);
$data = "Time Recorded : ".$formatted_time["hours"]." Hour(s) ".$formatted_time["minutes"]." Minute(s) ". $formatted_time["seconds"]." Second(s) \r\n";

while ($row = pg_fetch_assoc($result)) {
    $start_date=$row["start_date"];
    $time=$row["hours"].":".$row["minutes"].":".$row["seconds"];
    $formatted=format_time($time);
    $data.="\r\n \r\n \r\n".$row["start_date"]."\r\n".$formatted["hours"]." Hour(s) ".$formatted["minutes"]." Minute(s) ".$formatted["seconds"]." Second(s)\r\n";

    $query_get_notes="SELECT notes FROM time_log WHERE user_id='$u_id' AND log_status='2' AND archive_status='1' AND start_date='$start_date';";
}






header('Content-Type: text/plain');
header('Content-Disposition: attachement; filename="timelog.txt"');

echo $data;




exit();

