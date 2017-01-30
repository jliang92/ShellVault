<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . "/config/database.php";
$db = connect_pg_heroku();
$query =("SELECT * FROM vault_log ORDER BY id DESC;");
$result=pg_query($db,$query);


$entry_arr = array();
while ($row = pg_fetch_assoc($result)) {
    $entry_arr[] = $row;
}
print_r(json_encode($entry_arr));
