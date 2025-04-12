<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'mh_hotel';

    $conn = mysqli_connect($host, $username, $password, $db);
    if(!$conn){
        die("Cannot Connect to Database : ".mysqli_connect_error());
    }
?>