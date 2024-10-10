<?php

    error_reporting(E_ALL);
    ini_set("display_errors",1);

    $hostname = "127.0.0.1";
    $username = "thush";
    $password ="thush";
    $db_name = "practicaldb";

    $connection = mysqli_connect($hostname, $username, $password, $db_name);

    if(mysqli_connect_errno()){
        echo "mysql connection error : " . mysqli_connect_error();
    }


?>