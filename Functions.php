<?php


function db_connect(){
    $dbServerName = 'EANW-3235';
    $dbInfo = array('Database'=>'EANW');
    $db = sqlsrv_connect($dbServerName, $dbInfo);
    if($db === false) {
        echo '<h1>Connection Failed. See below.</h1>';
        echo '<pre>';
        die(print_r(sqlsrv_errors(), true));
    }
    return $db;
}

function db_disconnect(){
    if(isset($result)) {
        sqlsrv_free_stmt($result);
    }
    if(isset($db)) {
        sqlsrv_close($db);
    }
}

function InputValidate($val,$name){
    if (!(isset($val) && strlen($val))) {
            die("The \"$name\" field appears to be blank.  Try again.");
    }
}

function makeArrayFromTable($table, $query = 1) {
    // Create variables
    $list = array();
    $sql = $query == 1 ? "SELECT * FROM $table" : $query;
    
    // Pull results from database
    $db = db_connect();
    if(!$result = sqlsrv_query($db,$sql)) {
        die("There was an error running the $table query");
    }
    db_disconnect();
    
    // Populate array with the results and return the list
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
        $list[$row['0']] = $row['1'];
    }
    return $list;
}














/*
function OptionList($dbtoken,$field) {
    $sql = "SELECT * 
              FROM $field";
    if(!$result = sqlsrv_query($dbtoken,$sql)) {
        die('There was an error running the query');
    }
    
    $list = array();
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
        $list[] = '<option>' . $row[0] . '</option>';
    }
    return $list;
}


function optionList($database, $val=''){
    $db = db_connect();
    $list = array();
    $sql = "SELECT * FROM $database";
    if(!$result = sqlsrv_query($db, $sql)){
        die('Query Problems with ' . $database);
    }
    if(strlen($val)) {
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
            $list[] = '<option value="' . $row[0] . '">' . $row[1] . '</option>';
        }
    } else {
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
            $list[] = '<option>' . $row[0] . '</option>';
        }
    }
    db_disconnect();
    return $list;
}

function opList($table){
    $db = db_connect();
    $list = array();
    $sql = "SELECT * FROM $table";
    if(!$result = sqlsrv_query($db, $sql)){
        die('Query Problems with ' . $$table);
    }
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
        $list[] = '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
    db_disconnect();
    return $list;
}

function optionListTest($database, $name, $val=''){
    $db = db_connect();
    $list = array();
    $sql = "SELECT * FROM $database";
    if(!$result = sqlsrv_query($db, $sql)){
        die('Query Problems');
    }
    
    $list .= '<select name="' . $name . '" id="' . $name . '" . ' . $en . '>';
    
    if(strlen($val)) {
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
            $list .= '<option value="' . $row[0] . '">' . $row[1] . '</option>';
        }
    } else {
        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
            $list .= '<option>' . $row[0] . '</option>';
        }
    }
    $list .= '</select>';
    db_disconnect();
    return $list;
}

function activePcOptionList(){
    $optionList = array();
        $db = db_connect();
        $sql = "SELECT asset_tag FROM computers WHERE is_deployed=1";
        if(!$result=sqlsrv_query($db,$sql)) {
            die('There was an error with the query');
        }
        while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC)){
            $optionList[] = '<option>' . $row[0] . '</option>';
        }
        db_disconnect();
        return $optionList;
}
*/


?>