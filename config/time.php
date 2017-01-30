
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
date_default_timezone_set('America/New_York');
$d = date('l jS \of F Y h:i:s A');

/*
 * l=Monday 
 * jS=25th 
 * F=April 
 * Y=2016 
 * h:i:s=10:54:53
 * A=AM */

function getYear() {
    return date('Y');
}

function getMonth() {
    return date('F');
}

function getDayOfMonth() {
    return date('jS');
}

function getDayOfWeek() {
    return date('l');
}

function getDayOfYear() {
    $today = getdate();
    return $today["yday"];
}

function getHours() {
    $today = getdate();
    return $today["hours"];
}

function getMinutes() {
    return date('i');
}

function getSeconds() {
    return date('s');
}

function AmPm() {
    return date('A');
}

function currentDate() {
    $today = getdate();
    $date = $today["year"] . "-" . $today["mon"] . "-" . $today["mday"];

    return $date;
}

function time24hr() {
    $now=  getdate();
    return $now["hours"] . ":" . $now["minutes"] . ":" . $now["seconds"];
}

/* need to subtract 12 hrs from h */

function time12hr() {
    return date('h:i:s A');
}

/*returns the time difference structured as an array */
function time_diff($start, $stop) {
    $start_times = explode(":", $start);
    $start_hour = $start_times[0];
    $start_minute = $start_times[1];
    $start_second = $start_times[2];

    $stop_times = explode(":", $stop);
    $stop_hour = $stop_times[0];
    $stop_minute = $stop_times[1];
    $stop_second = $stop_times[2];
    
    if ($stop_second < $start_second) {
        $stop_second+=60;
        $stop_minute--;
    }
    if ($stop_minute < $start_minute) {
        $stop_minute+=60;
        $stop_hour--;
    }
    if ($stop_hour < $start_hour) {
        $stop_hour+=24;
    }
    
    $time_diff['hours']=$stop_hour - $start_hour;
    $time_diff['minutes']=$stop_minute - $start_minute;
    $time_diff['seconds']=$stop_second - $start_second;
    
    return $time_diff;
}

/*
 * Assumes $time is of format HH:MM:SS
 * Function formats the arguments to convert seconds and minutes.
 */
function format_time($time){
    
    $time_arr=explode(":", $time);
    $hours=$time_arr[0];
    $minutes=$time_arr[1];
    $seconds=$time_arr[2];
    
    if($seconds>=60){
        $uncounted_minutes = intval($seconds / 60);
        $seconds-=($uncounted_minutes * 60);
        $minutes+=$uncounted_minutes;
    }
    
    if($minutes>=60){
        $uncounted_hours= intval($minutes/60);
        $minutes-=($uncounted_hours*60);
        $hours+=$uncounted_hours;
    }
    
    $time_result['hours']=$hours;
    $time_result['minutes']=$minutes;
    $time_result['seconds']=$seconds;
    
    return $time_result;
}

function get_Tomorrow_yyyy_mm_dd(){
    $date= new DateTime('tomorrow');
    return $date->format('Y-m-d');
   
}
