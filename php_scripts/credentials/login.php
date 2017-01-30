<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
$db = connect_pg_heroku();


$data = json_decode(file_get_contents("php://input"));
$uname = $data->user;
$pwd = $data->pass;
$status_arr = array();

$check = "SELECT password FROM users WHERE username='$uname';";
$result = pg_query($db, $check);
if (!is_null($result)) {
    $fet = pg_fetch_assoc($result);
    $pass = $fet["password"];
    if ($pass == $pwd) {
        $status_arr["status"] = 1;
        $status_arr["response_message"] = "SUCCESS";

        session_start();
        $_SESSION['is_auth'] = TRUE;
        $_SESSION['user'] = $uname;
    } else {
        $status_arr["status"] = 0;
        $message = " FAIL :  Incorrect password";
    }
} else {
    $status_arr["status"] = 0;
    $message = " FAIL : User does not exist ";
}

print_r(json_encode($status_arr));
