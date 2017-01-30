<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
$authorization = array();
try {
    if ($_SESSION['is_auth'] == TRUE) {
        $authorization["status_code"] = 1;
        $authorization["status_message"] = "Logged In";
    } else {
        $authorization["status_code"] = 0;
        $authorization["status_message"] = "Not Logged In";
    }
} catch (Exception $e) {
    $authorization["status_code"] = 0;
    $authorization["status_message"] = "Not Logged In";
}
print_r(json_encode($authorization));
