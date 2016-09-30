<?php

require_once './_db-class.php';
$DB = new _Database("localhost", "testdb", "testuser", "testuser");

if(isset($_POST['getData'])){
    $_VALUE = $_POST['getData'];
    $_QUERY = $_POST['query'];
    if($_VALUE == 'FETCH_ALL'){
        $arrData = $DB->_dataView($_QUERY);
        echo json_encode($arrData);
    }
}