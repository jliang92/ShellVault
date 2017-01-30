<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * First param is a string consisting of the directory's address and name of file
 * Second param is the data, it can be regular string data, int data or json data. Json data must be encoded beforehand.
 */

function overwrite_file($file_name, $data) {

    $fp = fopen($file_name, 'w');
    fwrite($fp, $data);
    fclose($fp);
}

function read_decoded_json_file($file_name) {
    if (file_exists($file_name)) {
        return json_decode(file_get_contents($file_name));
    }
    return null;
}
