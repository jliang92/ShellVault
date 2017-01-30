<?php

session_start();
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/time.php";

function connect_vb_mysql() {
    $f_con = new \mysqli("192.168.1.120", "jacksql", "R00t", "todolist");
    if ($f_con->connect_error) {
        die('Mysql Connection failed: ' . $f_con->connect_error);
    }
    return $f_con;
}

$mysql_query = "SELECT log_id,start_day,time_in,stop_day,time_out ,time_log_status,pay_status FROM time_log;";
$mysql_db = connect_vb_mysql();
$mysql_result = $mysql_db->query($mysql_query);

$pg_db = connect_pg_heroku();
while ($mysql_entry = $mysql_result->fetch_assoc()) {
    $log_id = $mysql_entry["log_id"];
    $start_date = $mysql_entry["start_day"];
    $time_in = $mysql_entry["time_in"];
    $end_date = $mysql_entry["stop_day"];
    $time_out = $mysql_entry["time_out"];
    $log_status = $mysql_entry["time_log_status"];
    $pay_status = $mysql_entry["pay_status"];
    $l_status = 1;
    $p_status = 1;
    if ($log_status == "COMPLETE") {
        $l_status = 2;
    }
    if ($pay_status == "PAID") {
        $p_status = 2;
    }
    $time_diff = time_diff($time_in, $time_out);
    $hours = $time_diff["hours"];
    $minutes = $time_diff["minutes"];
    $seconds = $time_diff["seconds"];
    $fields = "INSERT INTO time_log (start_date,time_in,end_date,time_out,user_id,log_status,hours,minutes,seconds,archive_status) ";
    $values = " VALUES('$start_date','$time_in','$end_date','$time_out','3','$l_status','$hours','$minutes','$seconds','$p_status');";
    $insert_query = $fields . $values;
    echo "<br><br><br><br>";
    print_r($mysql_entry);
    echo "<br>$insert_query";
    pg_query($insert_query);
}
