<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'mh_hotel';

    $conn = mysqli_connect($host, $username, $password, $db);
    if(!$conn){
        die("Cannot Connect to Database : ".mysqli_connect_error());
    }

    function filteration($data){
        foreach ($data as $key => $value) {
            $data[$value] = trim($value);
            $data[$value] = stripslashes($value);
            $data[$value] = htmlspecialchars($value);
            $data[$value] = strip_tags($value);
            return $data;
        }
    }

    function select($sql, $values, $datatypes){
        $conn = $GLOBALS['conn'];
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Select");
            }
        } else {
            die("Query cannot be prepared - Select");
        }
    }
    
    function update($sql, $values, $datatypes){
        $conn = $GLOBALS['conn'];
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Update");
            }
        } else {
            die("Query cannot be prepared - Update");
        }
    }
?>