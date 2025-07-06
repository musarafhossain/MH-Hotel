<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'hotel';

    $conn = mysqli_connect($host, $username, $password, $db);
    if(!$conn){
        die("Cannot Connect to Database : ".mysqli_connect_error());
    }

    function selectAll($table){
        $conn = $GLOBALS['conn'];
        $res = mysqli_query($conn, "SELECT * FROM $table");
        return $res;
    }

    function filteration($data){
        if (!is_array($data)) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $data = strip_tags($data);
            return $data;
        }
    
        $filtered = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $filtered[$key] = filteration($value);  // recursive call for nested arrays
            } else {
                $value = trim($value);
                $value = stripslashes($value);
                $value = htmlspecialchars($value);
                $value = strip_tags($value);
                $filtered[$key] = $value;
            }
        }
    
        return $filtered;
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
    
    function insert($sql, $values, $datatypes){
        $conn = $GLOBALS['conn'];
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Insert");
            }
        } else {
            die("Query cannot be prepared - Insert");
        }
    }

    function delete($sql, $values, $datatypes){
        $conn = $GLOBALS['conn'];
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_affected_rows($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            } else {
                mysqli_stmt_close($stmt);
                die("Query cannot be executed - Delete");
            }
        } else {
            die("Query cannot be prepared - Delete");
        }
    }
?>