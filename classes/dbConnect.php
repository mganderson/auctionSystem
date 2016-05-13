<?php

/**
 * Created by PhpStorm.
 * User: michaelanderson
 * Date: 3/6/16
 * Time: 2:12 PM
 */
require '../config.php';
if (!isset($conn)){
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully <br/>";

}

