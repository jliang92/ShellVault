<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function connect_pg_heroku() {
    $connection_string="";
   $db = pg_connect($connection_string);
    if (!$db) {
        echo "Database connection error.";
        die();
    }
    return $db;
}

//Not Finished
function init_db_tables() {


    /* Table for storing website,username and passwords */
    $create_vault_log = "CREATE TABLE entry("
            . "id int PRIMARY KEY AUTO_INCREMENT,"
            . "purpose varchar(255),"
            . "source varchar(255) NOT NULL,"
            . "email varchar(255) NOT NULL,"
            . "uname varchar(255) NOT NULL,"
            . "pword varchar(255) NOT NULL);";
   

    /* table for spending log records */
    $create_spending_log = "CREATE spending_log ("
            . "id int PRIMARY KEY AUTO_INCREMENT,"
            . "date_stamp date NOT NULL,"
            . "cost decimal(10,2) NOT NULL,"
            . "description TEXT NOT NULL,"
            . "spending_type int NOT NULL);";
   
    /* table for what type of spending transaction EX: food,clothing etc */
    $create_spending_type = "CREATE TABLE spending_type("
            . "id int PRIMARY KEY AUTO_INCREMENT,"
            . "name VARCHAR(45) NOT NULL);";
    
}


////////////////////////////////////////

